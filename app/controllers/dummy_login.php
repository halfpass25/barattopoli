<?php

class dummy_login extends abstractController
{
    /**
     * Controller temporaneo per la gestione del login.
     * Attualmente mostra solo una vista dummy.
     *
     * TODO (area di progettazione futura):
     *
     * - Gestione della richiesta POST con dati di autenticazione
     * - Validazione di base dei campi ricevuti (presenza, formato, ecc.)
     * - Interazione con il modello utente per verifica credenziali
     * - Gestione esito autenticazione (successo / fallimento)
     * - Inizializzazione della sessione utente autenticato
     * - Eventuale reindirizzamento verso area riservata
     * - Gestione messaggi di errore verso la vista
     * - Eventuale protezione contro accessi ripetuti o non autorizzati
     *
     * Nota:
     * Questa versione rimane volutamente minimale per consentire
     * una successiva implementazione incrementale delle funzionalità.
     */
    public function index()
    {
        $data['page_title'] = "Login (dummy)";

        $this->view("barattopoli/login_dummy", $data);
    }
}

