<?php

Class dummy_Logout extends abstractController
{
    // ============================================================
    // Metodo per fare il logout dell'utente
    // ============================================================
    public function index()
    {
        // Carichiamo il modello User (può contenere metodi legati all'autenticazione)
        $user = $this->loadModel("user");

        // Chiamiamo il metodo logout del modello, che distrugge la sessione
        $user->logout();

        // ========================================================
        // VERO redirect al login tramite front controller
        // ========================================================
        // Questo fa sì che il browser faccia una nuova richiesta HTTP
        // e ripassi per Router → LoginController → view
       {
        if (isset($_SESSION['user_id'])) {
            session_destroy();
        }
        header("Location: " . ROOT . "dummy_login");
        die;
    }

        /*
        Nota didattica: non usiamo $this->view() qui, perché sarebbe solo un include
        e il browser resterebbe con l'URL /logout/logout. Così invece l'URL è coerente
        e il ciclo MVC completo viene rispettato.
        */
    }
}
