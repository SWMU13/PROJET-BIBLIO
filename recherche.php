


<center>
<?php
require_once('conf/connexion.php');
if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
    $rep = "%$recherche%";
    $sql = "SELECT *
            FROM auteur
            INNER JOIN livre ON livre.noauteur = auteur.noauteur
            WHERE auteur.nom LIKE :rep";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':rep', $rep, PDO::PARAM_STR);
    $stmt->execute();
    echo "<h2>Résultats pour l'auteur : " .  htmlentities(utf8_encode($recherche)). "</h2>";
    if ($stmt->rowCount() === 0) {
        echo "<p>Aucun livre trouvé.</p>";
        exit;
    }
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo '<p> <a href="accueil.php?nolivre=' .htmlentities(utf8_encode($row->nolivre)). '">'. htmlentities(utf8_encode($row->titre)) . '</a> </p>';
    }
}
    

?>    
</center>