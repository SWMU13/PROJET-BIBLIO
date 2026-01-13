


<?php
session_start();
require_once('conf/connexion.php');
include 'entete.php';

if (isset($_SESSION['user']) && $_SESSION['user']['profil'] === 'admin') {
$message = '';
if (isset($_POST['creer'])) {
    
    $mel      = trim($_POST['mel']);
    $mdp      = trim($_POST['mdp']);
    $nom      = trim($_POST['nom']);
    $prenom   = trim($_POST['prenom']);
    $adresse  = trim($_POST['adresse']);
    $ville    = trim($_POST['ville']);
    $codepostal = trim($_POST['codepostal']);

   
    if (empty($mel) || empty($mdp) || empty($nom) || empty($prenom)) {
        $message = "Les champs Mel, Mot de passe, Nom et Prénom sont obligatoires.";
    } else {
      
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

      
        $sql = "INSERT INTO utilisateur
    (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil)
    VALUES
    (:mel, :mdp, :nom, :prenom, :adresse, :ville, :codepostal, :profil)";

        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':mel' => $mel,
            ':mdp' => $mdp_hash,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':codepostal' => $codepostal,
            ':profil' => 'client'


        ]);

        $message = "Membre créé avec succès.";
    }
}
?>
<div class= bg-warning>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Créer un membre</h4>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-info text-center">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Mel</label>
                            <input type="email" name="mel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="mdp" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ville</label>
                                <input type="text" name="ville" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Code postal</label>
                                <input type="text" name="codepostal" class="form-control">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="creer" class="btn btn-primary">
                                Créer le membre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php } ?>