<?php $this->view("commons/header", $data); ?>

<!-- views/upload.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Upload Oggetto</title>
</head>
<body>

<div class="container mt-5"> 

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-4"> 

            <?php if (!empty($data['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $data['error'] ?>
                </div>
            <?php endif; ?>

            <h2 class="text-center mb-4">Carica un oggetto</h2> 

            <form action="upload/store" method="POST" enctype="multipart/form-data">

                <label>Nome oggetto:</label><br>
                <input type="text" name="obj_name" class="form-control" required>
                <br>

                <label>Categoria:</label><br>
                <input type="text" name="obj_category" class="form-control" required>
                <br>

                <label>Taglia-numero / Colore / Dimensioni:</label><br>
                <input type="text" name="obj_size_color" class="form-control" required>

                <br>

                <label>Descrizione:</label><br>
                <textarea name="obj_description" class="form-control"></textarea> 
                <br>

                <label>Immagine:</label><br>
                <input type="file" name="obj_picture" class="form-control" accept="image/*"> 
                <br>

                <button type="submit" class="btn btn-primary w-100">Carica</button> 

            </form>

        </div>

    </div>

</div>

</body>
</html>

<?php $this->view("commons/footer", $data); ?>