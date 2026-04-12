<?php

// MODIFICA RICHIESTA: includo il model User
require_once __DIR__ . '/../models/User.php';

class Login extends abstractController
{
    
    public function index()
    {
        $data['page_title'] = "LOGIN";

        // Se il form è stato inviato
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // MODIFICA RICHIESTA: istanzio User e chiamo login()
            $user = new User();
            $user->login();

            // Se login fallisce, l'errore è già in $_SESSION['error']
            $data['error'] = $_SESSION['error'] ?? "";
        }

        // Render della view
        $this->view("barattopoli/login", $data);
    }
}

