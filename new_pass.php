<?php 

$title = "Nova contrassenya | xavideveloper";
require_once("includes-login/header.php"); 
require_once("connexio_mysqli.php");

session_start();

   if(isset($_GET['email']) AND isset($_GET['token'])) {
      $email = mysqli_real_escape_string($conn,$_GET['email']);
      $token = mysqli_real_escape_string($conn,$_GET['token']);

      $query = "SELECT * FROM session_login WHERE email = '$email' AND token = '$token'";
      $stmt = $conn->query($query);
      $result = $stmt->num_rows;

      if($result < 1) {
         header("Location: index-login.php");
         exit();
      }
   }

?>

<body class="class-body">

<?php require_once("nav_login.php");?>

<!----------------------------- MISSATGE PASSWORD ERROR ------------------------->

   <?php if(isset($_GET['pw_error'])) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <?php echo $_GET['pw_error'];?>
            <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!----------------------------- MISSATGE PASSWORD ACTUALITZAT ------------------------->

   <?php if(isset($_GET['pw_update'])) : ?>
      <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
         <?php echo $_GET['pw_update']; ?>
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!-------------------------------------------------------------------------->

   <div class="d-flex justify-content-center container-vh">

      <div class="flex-sm-row align-self-center container-form p-3">

         <form action="recovery_pw_controller.php" method="POST" id="userform" class="form">

            <div class="input-group mb-3">
               <input type="password" class="form-control" name="newPw" placeholder="Nova Contrassenya" required>
            </div>

            <div class="input-group mb-3">
               <input type="password" class="form-control" name="repeatPw" placeholder="Confirma la contrassenya" required>
            </div>

            <div class="row">
               <div class="col-sm-12 mb-1">
                  <input type="hidden" name="email" value="<?= $email ?>">
                  <input type="hidden" name="token" value="<?= $token ?>">
                     <button type="submit" name="ingressar" class="btn bg-green-color d-block w-100"><span>Actualitzar</span></button>
                     <p class="mb-0 mt-1"><a href="index-login.php">Inici de sessió.</a></p>
                </div>
            </div>

         </form>
      </div>
   </div>

<?php require_once("includes-login/footer.php"); ?>

</body>
</html>

