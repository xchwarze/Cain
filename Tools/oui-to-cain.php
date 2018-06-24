<?php
//download url:
// http://standards-oui.ieee.org/oui/oui.txt
// https://github.com/vcrhonek/hwdata/blob/RHEL7/oui.txt
// https://github.com/vcrhonek/hwdata/blob/master/oui.txt

// Config
$oui_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "oui.txt.original";
$oui_download_url = "";



// Script...
if (!empty($oui_download_url)) {
	echo "[+] Downloading updated oui.txt...\n";
	$remote_file = file_get_contents($oui_download_url);
	file_put_contents("oui.txt.original", $remote_file);
	echo "[+] Download complete!\n";
}


echo "[+] Processing oui.txt...\n";
$total = 0;
$output = [];

foreach (file($oui_file) as $line) {
	if (strpos($line, "(base 16)") !== false){
		$total++;
		$output[] = $line;
	}
}

sort($output);
file_put_contents("oui.txt", implode("", $output));
echo "[+] Processing complete!\n";
echo "[*] File: oui.txt Lines: {$total}\n";
