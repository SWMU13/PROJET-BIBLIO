<?php
require_once('conf/connexion.php');
if (!isset($_GET['nolivre'])) {
    return;
}
$livreID = intval($_GET['nolivre']); 
$sql = "SELECT *
        FROM livre
        INNER JOIN auteur ON livre.noauteur = auteur.noauteur
        WHERE livre.nolivre = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $livreID, PDO::PARAM_INT);
$stmt->execute();
$livre = $stmt->fetch(PDO::FETCH_OBJ);
?>
 <center><?php echo  "<h2>". htmlentities(utf8_encode($livre->titre)) .  "</h2>";?></center>
<img src="./images/<?php echo $livre->photo?>" class="d-block mx-auto"   style="width:25%">
<center><h2>Détails du livre</h2></center>
<?php
    echo"  <p> <h4> <strong>Description : </strong> ". htmlentities(utf8_encode($livre->detail))." </h4></p>"; 


    if (isset($_SESSION['user'])) {
        ?>
            <div class="text-center">
                <a href="panier.php?nolivre=<?= $livreID; ?>" 
                   class="btn btn-success">
                    Emprunter
                </a>
            </div>
        <?php
        } else {
        ?>
            <div class="text-center">
                <h5 class="text-danger">
                    Pour pouvoir réserver, vous devez posséder un compte et vous identifier.
                </h5>
            </div>
        <?php
        }
?>


