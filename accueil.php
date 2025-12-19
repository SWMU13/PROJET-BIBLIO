<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Biblio-Drive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-9 bg-warning">
            <?php include "entete.html"; ?>
        </div>
        <div class="col-3 bg-warning text-center">
            <img src="./images/hero.jpg" class="img-fluid" alt="Hero">
        </div>
        <div class="col-9 bg-warning">
            <?php
            if (isset($_GET["recherche"])) {
                include "recherche.php";
            }
            elseif (isset($_GET["nolivre"])) {
                include "detail.php";
            }
            else {
                require_once 'conf/connexion.php';
                $stmt = $connexion->prepare("SELECT photo FROM livre ORDER BY dateajout DESC LIMIT 3");
                $stmt->execute();
                $livres = $stmt->fetchAll(PDO::FETCH_OBJ);
                if (count($livres) === 3) {
            ?>
            <div id="demo" class="carousel slide" data-bs-ride="carousel">  
                <div class="carousel-indicators">
                    <button data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner text-center">
                    <?php foreach ($livres as $index => $livre): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="./images/<?= $livre->photo ?>"
                                 class="d-block mx-auto"
                                 style="width:25%">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="col-3 bg-success">
            <?php include "authentification.php"; ?>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
