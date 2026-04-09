<?php

Class abstractController
{
    /*
    Classe base per tutti i controller. Contiene:
    - caricamento view
    - caricamento modello
    - gestione sessione e sicurezza (back button, pagine sensibili)
    *
    NOTA DIDATTICA:
    Questo controller fa più cose di quante dovrebbe in un framework “vero”.
    È volutamente semplice e diretto per mostrare il flusso.
    */

    public function __construct()
    {
        // Avvia sessione se non già avviata
        // NOTA DIDATTICA:
        // In un framework reale, la sessione verrebbe gestita altrove
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Impedisce al browser di usare pagine cache
        // NOTA DIDATTICA:
        // Headers impostati qui funzionano, ma in un framework serio
        // potresti avere middleware o controller filters dedicati
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    // ============================================================
    // Metodo per controllare se l'utente è loggato
    // ============================================================
    protected function requireLogin()
    {
        // Se l'utente non è loggato, redirect immediato
        // NOTA DIDATTICA:
        // Questo è un guard minimale: non gestisce autorizzazioni o ruoli,
        // e interrompe l'esecuzione con die. È intenzionale, serve a far vedere
        // che il controller “chiude la porta” se necessario.
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . ROOT . "login");
            die;
        }
    }

    // ============================================================
    // Metodo per caricare e mostrare una view
    // ============================================================
    protected function view($view, $data = [])
    {
        $viewFile = "app/views/" . $view . ".php";

        // NOTA DIDATTICA:
        // $data viene passato, ma non “spacchettato” automaticamente
        // Il lettore deve capire che la view conosce i dati per convenzione
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            // NOTA DIDATTICA:
            // Include 404 direttamente: mostra come gestire un errore in modo brutale
            include "app/views/barattopoli/_404.php";
        }
    }

    // ============================================================
    // Metodo per caricare e istanziare un modello
    // ============================================================
    protected function loadModel($model)
    {
        $modelFile = "app/models/" . $model . ".php";

        // NOTA DIDATTICA:
        // Convenzione: nome file = nome classe
        // Se il file non esiste, ritorna false
        // Serve a far vedere come il controller interagisce con i modelli
        if (file_exists($modelFile)) {
            include $modelFile;
            return new $model();
        }

        return false;
    }
}
