<?php 

$title = "Recuperar contrassenya | xaviwebdeveloper";
require_once("includes-login/header.php"); 
require_once("connexio_mysqli.php");

   if(isset($_POST['recoverypass'])) {
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $queryEmailExists = "SELECT * FROM session_login WHERE email = '$email'";
      $stmtEmailExists = $conn->query($queryEmailExists);
      $result = $stmtEmailExists->num_rows;

      if($result < 1) {
         $error = "No existeix aquest email a la base de dades!";
      }else{
         $user = $stmtEmailExists->fetch_assoc();
         $email = $user['email'];
         $token = $user['token'];
         $name = $user['name'];

         $messageSendEmail = "T'hem enviat un email al teu compte per tal d'actualitzar la teva contrassenya.";

         $toUser = $email;
         $subject = "Recuperació de contrassenya - xavideveloper.com";
         $message = "Hola " . $name . ". Clica al seguent enllaç per tal d'actualitzar la teva contrassenya: http://xavideveloper.com/login/new_pass.php?email=" . $email . '&token=' . $token;
         mail($toUser,$subject,$message);
      }
   }

?>


<body class="class-body">

<?php require_once("nav_login.php");?>

<!------------------------- MISSATGE ERROR SI NO EXISTEIX EMAIL A LA BASE DE DADES ------------------------->

   <?php if(isset($error)) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <?php echo $error; ?>
            <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!----------------------------- MISSATGE REGISTREOK ------------------------->

   <?php if(isset($messageSendEmail)) : ?>
      <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
         <?php echo $messageSendEmail; ?>
            <button type="button" class="btn-close" id="x-alert" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!-------------------------------------------------------------------------->

   <div class="d-flex justify-content-center container-vh">

      <div class="flex-sm-row align-self-center p-3">

      <div class="d-flex justify-content-center mb-3">
         <p class="color-grey pt-5">Escriu el teu email per tal de recuperar la teva contrassenya.</p>
      </div>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form">

         <div class="input-group">
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
         </div>

         <div>
            <button type="submit" name="recoverypass" class="btn bg-green-color d-block w-100"><span>Recuperar contrassenya</span></button>
         </div>
                
      </form>

      </div>
   </div>

<?php require_once("includes-login/footer.php"); ?>

</body>
