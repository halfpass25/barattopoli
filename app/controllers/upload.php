<?php

class Upload extends AbstractController {

    public function index()
    {
        $data['page_title'] = "Carica Oggetti";

        // visualizza il form per il caricamento degli oggetti da scambiare
        $this->view("upload", $data);
    }

    public function store() {

        //session_start();

        $userId = $_SESSION['user_id'];

        $name = $_POST['obj_name'] ?? '';
        $category = $_POST['obj_category'] ?? '';
        $sizeColor = $_POST['obj_size_color'] ?? '';
        $description = $_POST['obj_description'] ?? '';

        $imageName = null;

        if (isset($_FILES['obj_picture']) && $_FILES['obj_picture']['error'] === 0) {

            $imageName = uniqid() . '_' . $_FILES['obj_picture']['name'];
            //echo "IMAGENAME= ".$imageName ;

            $uploadDir = __DIR__ . '/../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            move_uploaded_file(
                $_FILES['obj_picture']['tmp_name'],
                $uploadDir . $imageName
            );
            }

        // QUI uso la vostra classe Database
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