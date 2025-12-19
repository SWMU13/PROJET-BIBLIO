
<?php
if (isset($_GET['deconnecter'])) {
  session_destroy();
  $_SESSION = [];}
if (isset($_SESSION['utilisateur'])): 
  $user = $_SESSION['utilisateur']; ?>
   <center>
  <div class="card p-3">
      <h5>Bonjour <?= htmlentities(utf8_encode($user['prenom'] . ' ' . $user['nom'])) ?> !</h5>
      <p><strong>Adresse :</strong> <?= htmlentities(utf8_encode($user['adresse'])) ?></p>
      <p><strong>Code postal :</strong> <?= htmlentities(utf8_encode($user['codepostal'])) ?></p>
      <p><strong>Ville :</strong> <?= htmlentities(utf8_encode($user['ville'])) ?></p>
      <a href="?deconnecter=1" class="btn btn-danger">Se déconnecter</a>
  </div>
<?php else: ?>
  <form action="" method="get">
      <div class="mb-3 mt-3">
          <label for="identifiant" class="form-label">Identifiant:</label>
          <input type="text"  id="identifiant" placeholder="Nom Prénom" name="identifiant" required>
      </div>
      <div class="mb-3">
          <label for="mdp" class="form-label">Mot de passe:</label>
          <input type="password"  id="mdp" placeholder="Mot de passe" name="mdp" required>
      </div>
      <button class="btn btn-default" type="submit">
      </center>
  </form>
<?php endif; ?>
</div>




