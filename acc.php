<!DOCTYPE html>
<html lang="fr">
 <head>
     <title>Biblio-Drive</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
 <body>
    <?php
    require_once('conf/connexion.php');
        $stmt = $connexion->prepare("SELECT * FROM livre ORDER BY dateajout DESC LIMIT 3");
        $livre = execute()
        $livre1 = $stmt->fetch(PDO::FETCH_OBJ);
        $livre2 = $stmt->fetch(PDO::FETCH_OBJ);
        $livre3 = $stmt->fetch(PDO::FETCH_OBJ);
?>
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
          <!-- Indicators/dots -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div> 
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./images/hamlet.jpg" alt="bon livre " class="d-block" style="width:25%">
            <div class="carousel-caption">
              <h3>bon livre </h3>
              <p>bon livre </p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="./images/1984.jpg"  style="width:25%">
            <div class="carousel-caption">
            </div> 
          </div>
          <div class="carousel-item">
            <img src="./images/Harry_Potter_et_la_Chambe_des_secrets.jpg"  style="width:25%">
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

      
</html>
