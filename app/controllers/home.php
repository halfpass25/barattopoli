<?php

class Home extends abstractController
{
    public function index()
    {
        // controllo login PRIMA di tutto
        if (!isset($_SESSION['user_id'])) {
            header('Location: /barattopoli/login');
            exit;
        }

        // costruisco user da sessione reale
        $user = [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'url' => $_SESSION['user_url']
        ];

        // Render della view
        $this->view("home/home", ['user' => $user]);
    }
}