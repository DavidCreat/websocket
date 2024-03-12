<?php
$host = 'localhost';
$port = 3306;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $host, $port);
socket_listen($socket);

echo "Servidor escuchando en $host:$port\n";

$clients = array();

do {
    $newSocket = socket_accept($socket);

    $color = getRandomColor();
    socket_write($newSocket, $color, strlen($color));

    foreach ($clients as $client) {
        $messageToSend = "¡Nuevo usuario!|" . $color;
        socket_write($client['socket'], $messageToSend, strlen($messageToSend));
    }

    $clients[] = array('socket' => $newSocket, 'color' => $color);

} while (true);

socket_close($socket);

function getRandomColor() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
