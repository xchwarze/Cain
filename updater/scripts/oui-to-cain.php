#!/usr/bin/env php
<?php
/**
 * OUI Processor CLI
 * Extracts and sorts unique "(base 16)" entries from an IEEE OUI file,
 * and saves the output to 'oui.txt' either alongside the input file (if provided)
 * or in the current working directory.
 */

define('OUI_DOWNLOAD_URL', 'https://standards-oui.ieee.org/oui/oui.txt');

$usage = "Usage: php oui_processor.php [path/to/oui.txt]\n";

// Banner
echo "=== OUI Processor CLI ===\n";
echo "Extracts and sorts unique (base 16) entries from an IEEE OUI file.\n\n";

$inputPath = $argv[1] ?? null;
$lines = [];

// Determine lines to process
if ($inputPath && file_exists($inputPath)) {
    echo "[*] Reading from local file: {$inputPath}\n";
    $lines = file($inputPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // Set output directory to the same directory as input file
    $outputDir = dirname(realpath($inputPath));
} else {
    echo "[*] Downloading OUI data from " . OUI_DOWNLOAD_URL . "...\n";
    $data = @file_get_contents(OUI_DOWNLOAD_URL);
    if ($data === false) {
        fwrite(STDERR, "Error: Failed to download OUI file.\n{$usage}");
        exit(1);
    }
    $lines = explode("\n", $data);
    // Set output directory to current working directory
    $outputDir = getcwd();
}

echo "[*] Processing lines...\n";
$flag  = '(base 16)';
$found = [];
foreach ($lines as $line) {
    if (strpos($line, $flag) !== false) {
        $id = strtoupper(trim(explode($flag, $line)[0]));
        if (!isset($found[$id])) {
            $found[$id] = $line;
        }
    }
}

$output = array_values($found);
sort($output, SORT_STRING);
$output[] = ''; // trailing newline

// Determine full path for output file
$outputFile = $outputDir . DIRECTORY_SEPARATOR . 'oui.txt';
echo "[*] Saving output to: {$outputFile}\n";

// Write to oui.txt
file_put_contents($outputFile, implode("\n", $output));

$count = count($output) - 1; // exclude empty line
echo "[+] Processing complete! {$count} unique entries written to {$outputFile}\n";
