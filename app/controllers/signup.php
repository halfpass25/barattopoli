<?php

require_once __DIR__ . '/../models/User.php';

class Signup extends abstractController
{
    /**
     * Controller per la gestione della registrazione utenti.
     * Evita redirect loop pulendo sessione e controllando correttamente.
     */
    public function index()
    {
        $data['page_title'] = "SIGNUP";

        // Se il form è stato inviato
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pulizia e sanificazione dei dati
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $email    = trim($_POST['email'] ?? '');

            // Validazione campi obbligatori
            if (!$username || !$password || !$email) {
                $_SESSION['error'] = "Inserisci username, email e password.";
            } else {
                // Interazione con il modello utente
                $user = new User();
                
                // Passiamo i dati e catturiamo eventuali errori
                $signupSuccess = $user->signup([
                    'username' => $username,
                    'password' => $password,
                    'email'    => $email
                ]);

                if ($signupSuccess) {
                    // Puliamo eventuali sessioni residue
                    unset($_SESSION['user_url']);
                    unset($_SESSION['user_name']);

                    // Reindirizziamo al login senza loop
                    header("Location: " . ROOT . "login");
                    exit;
                } else {
                    $data['error'] = $_SESSION['error'] ?? "Errore durante la registrazione.";
                }
            }
        }

        // Render della view SIGNUP
        $this->view("barattopoli/signup", $data);
    }
}