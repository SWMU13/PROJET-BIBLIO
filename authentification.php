



<?php
require_once('conf/connexion.php');

(isset($_POST['btnenvoyer']));

    echo '

    <form action="" method="post">
     
     <br> <br> <br> <br>  <br> <br>  &nbsp    &nbsp    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp     identifiant: <br> 
     
      &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   <input type="text" name="txtid"><br>

     <br> <br> <br> <br>    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp       Mot de passe :   <br>   
      
      &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   <input type="text" name="txtmdp"><br>

     <br> <br> &nbsp    &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp &nbsp   &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp   <input type="submit" name="btnenvoyer" value="Connexion" > 

    </form>';
    


       
?>
