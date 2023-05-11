<?php
  $user = json_decode($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <?php include "head.html"; ?>

  <body>
    <div class="container">
      <h2 class="mb-3">Autenticação com Égide</h2>

      <div class="card card-body">
        <code>
          <?php echo json_encode($user) ?>
        </code>
      </div>
  
    </div>
  </body>
</html>
