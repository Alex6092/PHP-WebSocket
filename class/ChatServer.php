<?php

class ChatServer implements Ratchet\MessageComponentInterface 
{
    private $clients;

    public function __construct() 
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(Ratchet\ConnectionInterface $conn) 
    {
        $this->clients->attach($conn);
    }

    public function onMessage(Ratchet\ConnectionInterface $from, $message) 
    {
        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($message);
            }
        }
    }

    public function onClose(Ratchet\ConnectionInterface $conn) 
    {
        $this->clients->detach($conn);
    }

    public function onError(Ratchet\ConnectionInterface $conn, \Exception $e) 
    {
        $conn->close();
        echo("Error: {$e->getMessage()}\n");
    }
}

?>