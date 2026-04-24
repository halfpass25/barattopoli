<?php

class Upload extends AbstractController {

    public function index()
    {
        $data['page_title'] = "Carica Oggetti";

        // Andrea: se esiste un errore in sessione lo copio in una variabile locale e lo invio alla view
        $data['error'] = $_SESSION['error'] ?? null;

        // Andrea: pulisco la sessione per evitare riapparizioni indesiderate dell'eventuale errore trasportato
        unset($_SESSION['error']);

        // visualizza il form per il caricamento degli oggetti da scambiare
        $this->view("upload", $data);
    }

    public function store() 
    {
        $userId = $_SESSION['user_id'];

        $name = trim($_POST['obj_name'] ?? '');
        $category = trim($_POST['obj_category'] ?? '');
        $sizeColor = trim($_POST['obj_size_color'] ?? '');
        $description = trim($_POST['obj_description'] ?? '');

        // VALIDAZIONE MINIMA LATO SERVER SOLO PER $name e $category
        if ($name === '' || $category === '') {
            $_SESSION['error'] = "Nome e categoria sono obbligatori.";
            header("Location: " . ROOT . "upload"); //questo farà rieseguire il metodo Index in questo controller
            exit;
        }

        $imageName = null;

        if (isset($_FILES['obj_picture']) && $_FILES['obj_picture']['error'] === 0) {

            $imageName = uniqid() . '_' . $_FILES['obj_picture']['name'];

            $uploadDir = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            move_uploaded_file(
                $_FILES['obj_picture']['tmp_name'],
                $uploadDir . $imageName
            );
        }

        $db = Database::getInstance();

        $db->write("
            INSERT INTO objects 
            (user_id_FK, obj_name, obj_category, obj_size_color, obj_picture, obj_description, obj_status)
            VALUES (?, ?, ?, ?, ?, ?, 'available')
        ", [
            $userId,
            $name,
            $category,
            $sizeColor,
            $imageName,
            $description
        ]);

        header("Location: " . ROOT . "home");
        exit;
    }
}