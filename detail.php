

<?php
require_once('conf/connexion.php');
$rer=$livre 
$stmt = $connexion->prepare("SELECT * FROM livre where nolivre like :rer");
$stmt->setFetchMode(':rer',$rer,PDO::FETCH_OBJ);
$stmt -> execute();


echo $stmt->titre. $stmt->detail.;
?>