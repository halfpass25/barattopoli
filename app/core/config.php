<?php
/**
 * ============================================
 * CONFIG.PHP – configurazione globale
 * ============================================
 *
 * Questo file contiene tutte le impostazioni
 * di base dell’applicazione.
 *
 * È volutamente:
 *  - semplice
 *  - procedurale
 *  - globale
 *
 * FrankenWork NON nasconde la configurazione
 * dietro classi, container o file magici.
 * Qui si vede tutto, subito.
 */

/**
 * ------------------------------------------------
 * Identità dell’applicazione
 * ------------------------------------------------
 */

/* Titolo dell'applicazione */
define('APP_TITLE', 'BARATTOPOLI');


/**
 * ------------------------------------------------
 * Configurazione Database
 * ------------------------------------------------
 *
 * In FrankenWork i parametri di connessione
 * sono definiti come costanti globali.
 *
 * È una scelta intenzionale:
 *  - niente .env
 *  - niente loader
 *  - niente astrazione
 *
 * Lo scopo è rendere visibile cosa serve
 * per parlare con un database.
 */

define('DB_TYPE', 'mysql');
define('DB_NAME', 'barattopoli');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');


/**
 * ------------------------------------------------
 * Configurazione HTTP / URL
 * ------------------------------------------------
 *
 * Qui costruiamo gli URL base dell’applicazione. Non è “robusto”, ma è chiaro.
 *
 * In un framework commerciale ci sarebbero:
 *  - ambienti (dev, staging, test, prod)
 *  - reverse proxy
 *  - HTTPS forzato
 */

/* Protocollo HTTP */
define('HTTP_TYPE', 'http');

/*
 * ROOT rappresenta la base assoluta dell’app.
 * Esempio:
 *   http://localhost/frankenwork/
 *
 * NOTA:
 * Usiamo $_SERVER['SERVER_NAME'] perché
 * FrankenWork vive in un ambiente semplice
 * e controllato (didattico).
 */
define(
    'ROOT',
     HTTP_TYPE . '://' . $_SERVER['SERVER_NAME'] . '/barattopoli/'
);

/* Percorso pubblico degli assets */
define('ASSETS', ROOT . 'public/assets/');


/**
 * ------------------------------------------------
 * DEBUG & gestione errori PHP
 * ------------------------------------------------
 *
 * DEBUG è una scelta ARCHITETTURALE, non solo una comodità.
 *
 * In FrankenWork:
 *  - se DEBUG è true, gli errori si vedono
 *  - se DEBUG è false, gli errori si nascondono
 *
 * Non c’è logging, non c’è fallback.
 * Gli errori servono a imparare.
 */

define('DEBUG', true);

if (DEBUG) {
    // Ambiente di sviluppo: errori visibili
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    // Ambiente "produzione": errori nascosti
    ini_set('display_errors', '0');
    error_reporting(0);
}

/* Fine CONFIG.PHP */
