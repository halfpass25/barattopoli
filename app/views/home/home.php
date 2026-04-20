<?php $this->view("commons/header", $data); ?>

<?php
$name = $user['name'] ?? 'Utente';
?>

<!-- MODIFICA RICHIESTA: navbar completamente riordinata -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top px-3">

    <div class="collapse navbar-collapse d-flex justify-content-between align-items-center w-100">

        <!-- SINISTRA: avatar + nome -->
        <div class="d-flex align-items-center">

            <img class="rounded-circle mr-2" 
                 src="<?= ASSETS ?>img/av.png" 
                 style="width:45px;height:45px;"><!-- MODIFICA RICHIESTA -->

            <span class="user-name"><!-- MODIFICA RICHIESTA -->
                Ciao <?= htmlspecialchars($name) ?>!
            </span>
        </div>

        <!-- CENTRO: logo -->
        <div>
            <img class="logo" 
               src="<?= ASSETS ?>img/barattopoli_banner_400_x_114.png"
               style="width:400px;height:114px"><!-- MODIFICA RICHIESTA -->
        </div>

        <!-- DESTRA: ricerca + links -->
        <div class="d-flex align-items-center">

            <!-- MODIFICA RICHIESTA: search più piccola e distanziata -->
            <input type="text"
                   class="form-control mr-4 search-box"
                   placeholder="Ricerca oggetti...">

            <ul class="navbar-nav align-items-center">

                <li class="nav-item">
                    <a class="nav-link nav-action" href="<?= ROOT ?>upload">
                        Carica Oggetti
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-action" href="<?= ROOT ?>proposte_baratti">
                        Proposte Baratti
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-action logout-link" href="<?= ROOT ?>logout">
                        ESCI
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<div style="margin-top:120px;"></div>

<div class="home-container">

    <hr>

    <div class="objects-section">

        <?php if (!empty($objects)) : ?>

            <div class="row g-3">

                <?php foreach ($objects as $obj) : ?>

                    <div class="col-12 col-md-4">

                        <div class="card item-card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($obj['title']) ?>
                                </h5>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else : ?>

            <p>Nessun oggetto disponibile al momento.</p>

        <?php endif; ?>

    </div>

</div>

<?php $this->view("commons/footer", $data); ?>