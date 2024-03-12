<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con Colores</title>
</head>
<body>
    <button onclick="ingresar()">Ingresar</button>
    <ul id="chat"></ul>

    <script>
        const socket = new WebSocket("ws://localhost:3306");

        socket.onopen = () => {
            console.log("Conexión WebSocket establecida.");
        };

        socket.onmessage = (event) => {
            const [message, color] = event.data.split('|');
            const chat = document.getElementById('chat');
            const li = document.createElement('li');
            li.style.color = color;
            li.textContent = message;
            chat.appendChild(li);
        };

        socket.onerror = (error) => {
            console.error(`Error en la conexión WebSocket: ${error}`);
        };

        socket.onclose = (event) => {
            if (event.wasClean) {
                console.log(`Conexión cerrada limpiamente, código=${event.code}, razón=${event.reason}`);
            } else {
                console.error(`Conexión abrupta, código=${event.code}`);
            }
        };

        function ingresar() {
            if (socket.readyState === WebSocket.OPEN) {
                const color = getRandomColor();
                const message = "¡Nuevo usuario!";
                socket.send(`${message}|${color}`);
            } else {
                console.error("La conexión WebSocket no está completamente establecida.");
            }
        }

        function getRandomColor() {
            return '#' + Math.floor(Math.random()*16777215).toString(16);
        }
    </script>
</body>
</html>
