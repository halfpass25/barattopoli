<?php

// includiamo lo User model perché la nostra applicazione, nella sua semplicità
// non fa uso di un AutoLoader
require_once __DIR__ . '/../models/User.php';

class Login extends abstractController
{
    
    public function index()
    {
        $data['page_title'] = "LOGIN";

        // Se il form è stato inviato
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Istanziamo lo User Model e gestiamo il risultato del login
            $user = new User();

            // se lo UserModel ha potuto autenticare le credenziali dell'utente...
            if ($user->login()) { 
                /* il controller LOGIN termina la propria esecuzione e restituisce una
                RESPONSE HTTP di redirect che provoca una nuova REQUEST verso la pagina "home".

                Questo punto è fondamentale: non esiste alcuna chiamata diretta tra controller.
                Il flusso è sempre regolato dal paradigma REQUEST/RESPONSE di HTTP.

                Il sistema non passa mai da controller a controller: passa sempre da REQUEST a RESPONSE.
                */
                header("Location: " . ROOT . "home"); 
                exit; // 
            }

            // Se login fallisce, l'errore è già in $_SESSION['error']
            $data['error'] = $_SESSION['error'] ?? "";
        }

        // Render della view
        $this->view("auth/login", $data);
    }
}