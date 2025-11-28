



<?php
require_once('conf/connexion.php');

if(!isset($_POST['btnEnvoyer'])) 

{/* L'entrée btnEnvoyer est vide = le formulaire n'a pas été posté, on affiche le formulaire */

    echo '

    <form action="" method="post">
     
     <br> <br> <br> <br>  <br> <br>  &nbsp    &nbsp    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp     identifiant  <br> 
     
      &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   <input type="text" name="txtid"><br>

     <br> <br> <br> <br>    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp       Mot de passe :   <br>   
      
      &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   <input type="text" name="txtmdp"><br>

     <br> <br> &nbsp    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp   <input type="submit" name="btnenvoyer" value="Connexion" > 

    </form>';

}

else 

/* L'utilisateur a cliqué sur Envoyer, l'entrée btnEnvoyer <> vide, on traite le formulaire */

{    echo "Bonjour : ".$_POST["txtid"]."<br>";

     echo "Votre mél est : ".$_POST["txtMdp"]; 

}

?>
