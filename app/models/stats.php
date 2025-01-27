<?php
$json = file_get_contents(INSTALL_ROOT . 'data/stats.json');

header("Content-type: application/json; charset=UTF-8");
header("Content-Length: " . strlen($json));
echo $json;
exit;