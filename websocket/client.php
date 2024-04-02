<?php

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_connect($sock, '127.0.0.1', 10000) === false) {
    echo "socket_connect() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
}

do {
    echo "se creo una nueva sesion: ";
    $stdin = fopen('php://stdin', 'r');
    $msg = trim(fgets($stdin));
    socket_write($sock, $msg, strlen($msg));
    sleep(1);

} while (true);
