
 <div class="w3-container">

  <h5> La Bibliothéque de Moulinsart est ferméé au public jusqu'à nouvel ordre.Mais il vous est possible de réserver et retirer vos livres via notre service Biblio Drive  </h5>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">menbre</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarAdmin">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="accueil.php">
              accueil
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    
</dive>


<?php
session_start();
 
require_once 'conf/connexion.php';


$mel = $_SESSION['user']['mel'];

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_GET['nolivre'])) {
    $nolivre = (int) $_GET['nolivre'];
    $_SESSION['panier'][$nolivre] = 1;
}

if (isset($_GET['annuler'])) {
    $nolivre = (int) $_GET['annuler'];
    unset($_SESSION['panier'][$nolivre]);
}

$sql = "SELECT COUNT(*) 
        FROM emprunter 
        WHERE mel = :mel 
        AND dateretour IS NULL";
$stmt = $connexion->prepare($sql);
$stmt->execute([':mel' => $mel]);
$empruntsEnCours = (int) $stmt->fetchColumn();

if (isset($_GET['valider'])) {
    $nbPanier = count($_SESSION['panier']);

    if ($empruntsEnCours + $nbPanier > 5) {
        $erreur = "Vous ne pouvez pas avoir plus de 5 emprunts en cours.";
    } else {
        $sqlInsert = "INSERT INTO emprunter (mel, nolivre, dateemprunt)
                      VALUES (:mel, :nolivre, CURDATE())";
        $stmtInsert = $connexion->prepare($sqlInsert);
        foreach (array_keys($_SESSION['panier']) as $nolivre) {
            $stmtInsert->execute([
                ':mel' => $mel,
                ':nolivre' => $nolivre
            ]);
        }
        $_SESSION['panier'] = [];
        $success = "Panier validé. Emprunts enregistrés.";
        $empruntsEnCours += $nbPanier; 
    }
}


$livresPanier = [];
if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sqlLivres = "SELECT nolivre, titre, anneeparution FROM livre WHERE nolivre IN ($placeholders)";
    $stmtLivres = $connexion->prepare($sqlLivres);
    $stmtLivres->execute($ids);
    $livresPanier = $stmtLivres->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Votre panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body  class=  bg-warning>
<div class="container mt-4">
    <h2 class="text-success mb-3">Votre panier</h2>
    <p><small>(encore <?= 5 - $empruntsEnCours ?> réservation<?= (5 - $empruntsEnCours) > 1 ? 's possibles' : ' possible' ?>, <?= $empruntsEnCours ?> emprunt<?= $empruntsEnCours > 1 ? 's en cours' : ' en cours' ?>)</small></p>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?= htmlentities(utf8_encode(($erreur))) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?=htmlentities(utf8_encode(($success))) ?></div>
    <?php endif; ?>

    <?php if (empty($livresPanier)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <ul class="list-group mb-3">
            <?php foreach ($livresPanier as $livre): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlentities(utf8_encode(($livre->titre))) ?> (<?= htmlentities(utf8_encode(($livre->anneeparution))) ?>)
                    <a href="?annuler=<?= $livre->nolivre ?>" class="btn btn-sm btn-outline-danger">Annuler</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="?valider=1" class="btn btn-primary">Valider le panier</a>
    <?php endif; ?>
</div>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
