<?php
$host = 'localhost';
$port = 3306;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

$color = socket_read($socket, 1024);
echo "Tu color: $color\n";

socket_close($socket);
?>
