<?php


ob_start();
echo "hello world";
$output = ob_get_clean();


include __DIR__ . "/../template/layout.html.php";
