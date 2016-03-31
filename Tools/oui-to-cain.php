<?php
//download to:
// http://standards-oui.ieee.org/oui/oui.txt
// https://git.fedorahosted.org/cgit/hwdata.git/plain/oui.txt

$oui_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'oui.txt';


$mem_db = new PDO('sqlite::memory:');
$mem_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$mem_db->exec("CREATE TABLE oui (id INTEGER PRIMARY KEY, info TEXT)");

$lines = file($oui_file);
$insert = 'INSERT INTO oui (info) VALUES (:info)';
foreach ($lines as $line) {
	if (strpos($line, '(base 16)') !== false){
		$line = trim($line);

		$stmt = $mem_db->prepare($insert);
		$stmt->bindParam(':info', $line, SQLITE3_TEXT);
		$stmt->execute();
	}
}


$content = '';
$result = $mem_db->query('SELECT info FROM oui ORDER BY info ASC');
foreach ($result as $row) {
	$content .= "  {$row['info']}\r\n";
}

file_put_contents("{$oui_file}.cain", $content);
echo "[*] File: {$oui_file}.cain";
