<?php

$host = "127.0.0.1";
$port = 10000;

set_time_limit(0);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("No se pudo crear el socket\n");

$result = socket_bind($socket, $host, $port) or die("No se pudo vincular al socket\n");

$result = socket_listen($socket, 3) or die("No se pudo establecer el escuchador del socket\n");

do {
    $spawn = socket_accept($socket) or die("No se pudo aceptar la conexión entrante\n");
    
    $randomIdentification = uniqid();

    echo "Nuevo cliente conectado. Identificación: $randomIdentification\n";
    
    socket_close($spawn);

} while (true);

socket_close($socket);

