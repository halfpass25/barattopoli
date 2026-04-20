<?php $this->view("commons/header", $data); ?>

<?php
// Se ci sono messaggi di errore, mostriamoli
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<div class="signup-wrapper container"> <!-- riuso stesso layout per SIGNUP -->
    <div class="signup-card card">
        <h2 class="text-center">Login</h2>

        <?php if($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Accedi</button>
        </form>

        <p class="text-center mt-10">
            Non hai un account? <a href="<?= ROOT ?>signup">Registrati</a>
        </p>
    </div>
</div>

<?php $this->view("commons/footer", $data); ?>