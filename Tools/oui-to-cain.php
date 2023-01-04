<?php

//download url:
// https://standards-oui.ieee.org/oui/oui.txt
// https://github.com/vcrhonek/hwdata/blob/master/oui.txt
$oui_download_url = 'https://standards-oui.ieee.org/oui/oui.txt';

if (!file_exists('oui.original')) {
    echo "[+] Downloading updated oui.txt...\n";
    $remote_file = file_get_contents($oui_download_url);
    file_put_contents('oui.original', $remote_file);
}


echo "[+] Processing oui.txt...\n";
@unlink('oui.txt');

$flag   = '(base 16)';
$total  = 0;
$output = [];
$index  = [];
foreach (file('oui.original') as $line) {
    if (strpos($line, $flag) !== false){
        $parts = explode($flag, $line);
        $id    = mb_strtoupper(trim($parts[0]));
        if (!in_array($id, $index, true)) {
            $total++;
            $index[] = $id;
            $output[] = $line;
            //$output[] = str_replace(['.', ','], '', $line);
        }
    }
}

sort($output);
$output[] = '';

file_put_contents('oui.txt', implode("\n", $output));
unlink('oui.original');

echo "[+] Processing complete!\n";
echo "[*] File: oui.txt - Lines: {$total}\n";
echo "[!] Replace Cain original oui.txt with new file!\n";
