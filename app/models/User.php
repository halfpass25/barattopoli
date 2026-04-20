<?php 
class User 
{
    /* Non è necessario passare l'array $_POST come argomento alla funzione login() in quanto da PHP 5.4 in poi, è una super_global disponibile ovunque e non può essere ri-dichiarata
    */

    function login()
    {

        // Instanzia l'oggetto Database una sola volta, con un Singleton.
        //Qui non serve l'include della classe database perché già "required" da index.php
        $DB = database::getInstance();

        // Svuota la variabile di sessione che trasporta gli eventuali error-code
        $_SESSION['error'] = "";

        // Se Username e Password sono state fornite nel form
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            // Metti i valori passati in un array associativo
            $arr['username'] = $_POST['username'];
            $arr['password'] = $_POST['password'];

            // Imposta la query SQL con modalità prepared statement
            $query = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";

            // Esegue la query
            $data = $DB->fetchAll($query, $arr);
            //var_dump ($data);
            //exit;

            if(is_array($data) && count($data) > 0)
            {
                // Login riuscito, settiamo le variabili di sessione
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
                $_SESSION['user_id']  = $data[0]->id;
                
                return true; //indicherà al controller di Login che l'utente è stato 
                //correttamente autenticato

            }
            else
            {
                $_SESSION['error'] = "Nome utente o Password errati!";
            }
        }
        else
        {
            $_SESSION['error'] = "Inserite sia Username che Password";
        }
    }

    function signup($POST)
    {
        $DB = database::getInstance();

        $_SESSION['error'] = "";
        if(isset($POST['username']) && isset($POST['password']) && isset($POST['email']))
        {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];
            $arr['email'] = $POST['email'];
            $arr['url_address'] = get_random_string_max(60);
            $arr['date'] = date("Y-m-d H:i:s");

            $query = "INSERT INTO users (username,password,email,url_address,date) VALUES (:username,:password,:email,:url_address,:date)";
            $data = $DB->write($query, $arr);

            if($data)
            {
                // MODIFICA RICHIESTA: non settare sessione, solo redirect al login
                // Questo previene il redirect loop
                header("Location:". ROOT . "login");
                die;
            }
            else
            {
                $_SESSION['error'] = "Impossibile completare la registrazione.";
            }
        }
        else
        {
            $_SESSION['error'] = "Inserisci username, email e password";
        }
    }

    function check_logged_in()
    {
        $DB = Database::getInstance();
        if(isset($_SESSION['user_url']))
        {
            $arr['user_url'] = $_SESSION['user_url'];
            $query = "SELECT * FROM users WHERE url_address = :user_url LIMIT 1";
            $data = $DB->fetchAll($query, $arr);
            if(is_array($data) && count($data) > 0)
            {
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
                return true;
            }
        }
        return false;
    }

    function logout()
    {
        unset($_SESSION['user_name']);
        unset($_SESSION['user_url']);
        session_destroy();

        header("Location:". ROOT . "login");
        die;
    }

}