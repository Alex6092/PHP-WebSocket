<?php
    require "vendor/autoload.php"; 

    use \cboden\ratchet\app;
    require "class/ChatServer.php";

    $app = new Ratchet\App('127.0.0.1', 8080);
    $app->route('/chat', new ChatServer, ['*']);
    $app->run();

?>