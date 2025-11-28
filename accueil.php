<!DOCTYPE html>
<html lang="fr">
 <head>
     <title>Biblio-Drive</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <body>
    <div class="row row-cols-2">

      <div class="col-9 bg-warning">
       <?php
           include "entete.html";
        ?>
                    <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                    <div class="navbar-header">
                    <a class="navbar-brand" href="#">Auteur</a>
                    </div>

                 <form class="navbar-form navbar-left" action="recherche.php">
                <div class="input-group">
                 <input type="text" class="form-control" placeholder="Rechercher dans le catalogue(saisie du nom de l'auteur)"name="recherche">
                <div class="input-group-btn">
               <button class="btn btn-default" type="submit">
                 <i class="glyphicon glyphicon-search"></i>
                </button>
               </div>
             </div>
            </form>
            </div>
            </nav>
          </div>
            <?php include "recherche.php"; ?>
             

    </div>
        
       <div  class="col-3 bg-warning ">
         <img src="./images/hero.jpg"  style="width:100%" >

        </div>

        <div class="col-9 bg-warning">
         <div id="demo" class="carousel slide" data-bs-ride="carousel">
          <!-- Indicators/dots -->
         <div class="carousel-indicators">
          <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
         </div> 
         <?php
            require_once('conf/connexion.php');
            $stmt = $connexion->prepare("SELECT * FROM livre ORDER BY dateajout DESC LIMIT 3");
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt -> execute();
            $livre1 = $stmt->fetch();
            $livre2 = $stmt->fetch();
            $livre3 = $stmt->fetch();
           
           ?>
           <!-- The slideshow/carousel -->
           <div class="carousel-inner">
            <div class="carousel-item active">
                 <img src="./images/<?php echo $livre1->photo?>" class="d-block" style="width:25%">
              <div class="carousel-caption">
              </div>
              </div>
                 <div class="carousel-item">
                    <img src="./images/<?php echo $livre2->photo?>"  style="width:25%">
                   <div class="carousel-caption">
                  </div> 
                </div>
                <div class="carousel-item">
                <img src="./images/<?php echo $livre3->photo?>" style="width:25%">
               <div class="carousel-caption">
            </div>  
          </div>
          </div>
         <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
         </button>
         </div>
         </div>

         <div class="col-3 bg-success">
                <?php include "authentification.php ";?>
            </div>
            </div> 
         </div>
       
    </div>
</html>
