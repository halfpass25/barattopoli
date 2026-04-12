<?php 
// Inclusione header condiviso
$this->view("barattopoli/header", $data);

// Se ci sono messaggi di errore, mostriamoli
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<div class="signup-wrapper container">
    <div class="signup-card card">
        <h2 class="text-center">Registrazione</h2>

        <?php if($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Registrati</button>
        </form>

        <p class="text-center mt-10">
            Hai già un account? <a href="<?= ROOT ?>login">Accedi</a>
        </p>
    </div>
</div>

<?php 
// Inclusione footer condiviso
$this->view("barattopoli/footer");
?>