<?php

class dummy_Signup extends abstractController
{
    /**
     * Controller temporaneo per la gestione della registrazione utenti.
     * Attualmente espone solo una vista dummy.
     *
     * TODO (area di progettazione futura):
     *
     * - Gestione della richiesta POST con dati di registrazione
     * - Validazione dei campi obbligatori (nome, email, password, ecc.)
     * - Verifica unicità di identificativi (es. email già registrata)
     * - Normalizzazione e sanificazione dei dati ricevuti
     * - Interazione con il modello utente per creazione nuovo account
     * - Gestione esito registrazione (successo / errore)
     * - Eventuale inizializzazione automatica della sessione utente
     * - Reindirizzamento verso area riservata o pagina di conferma
     * - Preparazione messaggi di feedback verso la vista
     *
     * Nota:
     * Le voci verranno marcate progressivamente come completate,
     * ad esempio:
     *
     * // [DONE] Validazione dei campi obbligatori
     * // [✔] Creazione nuovo account
     *
     * Questo approccio consente di mantenere allineate progettazione
     * e implementazione durante lo sviluppo incrementale.
     */
    public function index()
    {
        $data['page_title'] = "Signup (dummy)";

        $this->view("barattopoli/signup_dummy", $data);
    }
}

