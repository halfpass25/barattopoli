<?php

// Avvia la sessione PHP se non esiste.
// Serve per gestire lo stato dell'utente (login/logout).
// È messo qui perché index.php è il primo file eseguito
// e la sessione deve essere disponibile ovunque.
if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

 // Impedisce al browser di usare pagine cache
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");


// ===============================
// Bootstrap dell'applicazione
// ===============================

// Carica il file di configurazione globale
// (costanti, parametri di connessione, ecc.)
require "app/core/config.php";


// Carica funzioni di utilità generiche.
// Qui finiscono helper riutilizzabili, non logica di business.
require "app/core/functions.php";


// Carica la classe responsabile dell'accesso al database.
// Centralizza la connessione e l'uso del DB.
require "app/core/database.php";


// Carica la classe base astratta per i controller.
// Serve a condividere comportamenti comuni tra i controller concreti.
require "app/core/abstractController.php";


// Carica il Router, che deciderà quale controller e metodo eseguire
// in base alla URL richiesta.
require "app/core/router.php";


// ===============================
// Avvio dell'applicazione
// ===============================

// Istanzia il Router.
// Nel costruttore (o subito dopo) partirà il meccanismo
// di analisi della URL e di instradamento della richiesta.
$app = new Router();


// Da questo momento il controllo passa al Router,
// che gestirà l'intero ciclo della richiesta HTTP.
