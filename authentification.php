
<?php
require_once('conf/connexion.php');
if (isset($_GET['deconnecter'])) {
    session_destroy();
    $_SESSION = [];
    exit;
}
$erreur = '';
if (isset($_POST['btnSeConnecter']) && !isset($_SESSION['utilisateur'])) {
    $mel = trim($_POST['mel']);
    $motdepasse = $_POST['motdepasse'];
    $stmt = $connexion->prepare(
        "SELECT * FROM utilisateur 
         WHERE mel = :mel AND motdepasse = :motdepasse"
    );
    $stmt->bindValue(':mel', $mel);
    $stmt->bindValue(':motdepasse', $motdepasse);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['utilisateur'] = $user;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>
<div class="container mt-4">
<?php if (isset($_SESSION['utilisateur'])): 
    $user = $_SESSION['utilisateur'];
?>
    <div class="card p-3">
        <h5>
            Bonjour <?= htmlentities(utf8_encode($user['prenom'].' '.$user['nom'])) ?> !
        </h5>
        <p><strong>Email :</strong> <?= htmlentities(utf8_encode($user['mel'])) ?></p>
        <p><strong>Adresse :</strong> <?= htmlentities(utf8_encode($user['adresse'])) ?></p>
        <p><strong>Ville :</strong> <?= htmlentities(utf8_encode($user['ville'])) ?></p>
        <p><strong>Code postal :</strong> <?= htmlentities(utf8_encode($user['codepostal'])) ?></p>
        <p><strong>Profil :</strong> <?= htmlentities(utf8_encode($user['profil'])) ?></p>
        <a href="?deconnecter=1" class="btn btn-danger">
            Se déconnecter
        </a>
    </div>
<?php else: ?>
    <form method="post">
        <div class="mb-3">
            <label>identifiant :</label>
            <input type="email" name="mel" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe :</label>
            <input type="password" name="motdepasse" required>
        </div>
        <?php if ($erreur): ?>
            <p style="color:red;">
                <?= htmlentities(utf8_encode($erreur)) ?>

            </p>
            
        <?php endif; ?>
        <button type="submit" name="btnSeConnecter" class="btn btn-primary">
            Se connecter
        </button>
    </form>
<?php endif; ?>
