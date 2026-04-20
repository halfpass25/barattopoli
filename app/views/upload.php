<?php $this->view("commons/header", $data); ?>

<!-- views/upload.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Upload Oggetto</title>
</head>
<body>

<div class="container mt-5"> <!-- MODIFICA RICHIESTA -->

    <div class="row justify-content-center"> <!-- MODIFICA RICHIESTA -->

        <div class="col-md-6 col-lg-4"> <!-- MODIFICA RICHIESTA -->

            <h2 class="text-center mb-4">Carica un oggetto</h2> <!-- MODIFICA RICHIESTA -->

            <form action="upload/store" method="POST" enctype="multipart/form-data">

                <label>Nome oggetto:</label><br>
                <input type="text" name="obj_name" class="form-control" required> <!-- MODIFICA RICHIESTA -->
                <br>

                <label>Categoria:</label><br>
                <input type="text" name="obj_category" class="form-control" required> <!-- MODIFICA RICHIESTA -->
                <br>

                <label>Taglia-numero / Colore / Dimensioni:</label><br>
                <input type="text" name="obj_size_color" class="form-control" required> <!-- MODIFICA RICHIESTA -->
                <br>

                <label>Descrizione:</label><br>
                <textarea name="obj_description" class="form-control"></textarea> <!-- MODIFICA RICHIESTA -->
                <br>

                <label>Immagine:</label><br>
                <input type="file" name="obj_picture" class="form-control" accept="image/*"> <!-- MODIFICA RICHIESTA -->
                <br>

                <button type="submit" class="btn btn-primary w-100">Carica</button> <!-- MODIFICA RICHIESTA -->

            </form>

        </div>

    </div>

</div>

</body>
</html>

<?php $this->view("commons/footer", $data); ?>