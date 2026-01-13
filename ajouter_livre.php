





<?php
session_start();
include 'entete.php';

if (isset($_SESSION['user']) && $_SESSION['user']['profil'] === 'admin') {


require_once('conf/connexion.php');
?>

<center>
        <?php

$sql = "SELECT * FROM auteur ORDER BY nom";
$stmt = $connexion->prepare($sql);
$stmt->execute();
$auteurs = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['ajouter'])) {

    $titre     = $_POST['titre'];
    $isbn13    = $_POST['isbn13'];
    $annee     = $_POST['annee'];
    $detail    = $_POST['detail'];
    $photo     = $_POST['photo'];
    $noauteur  = $_POST['noauteur'];
    $dateajout = date('Y-m-d');

    $sqlInsert = "INSERT INTO livre
                  ( noauteur , titre, isbn13, anneeparution, detail,dateajout, photo)
                  VALUES
                  ( :noauteur, :titre, :isbn13, :annee, :detail,:dateajout ,:photo)";
    $stmtInsert = $connexion->prepare($sqlInsert);
    $stmtInsert->execute([
        ':titre'     => $titre,
        ':isbn13'    => $isbn13,
        ':annee'     => $annee,
        ':detail'    => $detail,
        ':photo'     => $photo,
        ':dateajout' => $dateajout,
        ':noauteur'  => $noauteur
    ]);
    $message = "Livre ajouté avec succès";
}
?>

<div class=bg-warning>

<h2 class="text-center text-danger">Ajouter un livre</h2>
<?php if (isset($message)): ?>
    <div class="alert alert-success text-center">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>
<form method="post" class="mx-auto" style="width:50%;">
    <div >
        <label>Auteur :</label>
        <select name="noauteur" class="form-control" required>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= $auteur->noauteur ?>">
                    <?= $auteur->prenom . " " . $auteur->nom ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-2">
        <label>Titre :</label>
        <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>ISBN13 :</label>
        <input type="text" name="isbn13" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Année de parution :</label>
        <input type="text" name="annee" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Résumé :</label>
        <textarea name="detail" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <label>Image :</label>
        <input type="text" name="photo" class="form-control" placeholder="nomimage.jpg">
    </div>
    <div class="text-center">
        <button type="submit" name="ajouter" class="btn btn-secondary">
            Ajouter
        </button>
    </div>
</form>
</center>
<?php } ?>