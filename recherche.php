<?php
require_once('conf/connexion.php');

if (isset($_GET['recherche'])) {

    $recherche = $_GET['recherche'];
    $rep = "%$recherche%";

    $sql = "SELECT livre.nolivre, livre.titre, auteur.nom
            FROM auteur
            INNER JOIN livre ON livre.noauteur = auteur.noauteur
            WHERE auteur.nom LIKE :rep";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':rep', $rep, PDO::PARAM_STR);
    $stmt->execute();

    echo "<h2>Résultats pour l'auteur : " .  htmlspecialchars($recherche) . "</h2>";
    

    if ($stmt->rowCount() === 0) {
        echo "<p>Aucun livre trouvé.</p>";
        exit;
    }

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        
        echo '<p>
                <a href="livre.php?livre=' . htmlspecialchars($row->nolivre). '">' 
                . $row->titre . 
                '</a>
              </p>';
    }
}

 include "detail.php ";
?>
