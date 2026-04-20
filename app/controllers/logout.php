<?php

class Logout extends abstractController
{
    public function index(): void
    {
        session_start();

        // pulizia sessione
        $_SESSION = [];

        // distrugge sessione lato server
        session_destroy();

        // come buona pratica, eliminiamo anche i cookie sessione
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // redirect al login
        header("Location: " . ROOT . "auth/login");
        exit;
    }
}
