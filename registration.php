<?php

$title = "Registre d'usuari | Xaviwebdeveloper";
require_once("includes-login/header.php"); 
require_once("connexio_mysqli.php");

   if(isset($_POST['registrar'])){
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $user = mysqli_real_escape_string($conn, $_POST['user']);
     $pw = mysqli_real_escape_string($conn, $_POST['pw']);
     $pwEncrypt = sha1($pw);
     $token = sha1(rand(0,1000));
     
     $sqlUser = "SELECT id FROM session_login WHERE user = '$user'";
     $stmtUser = $conn->query($sqlUser); 
     
     $files = $stmtUser->num_rows;
        if($files > 0) {
           $error = $user . " ja existeix. Elegeix-ne un altre.";
        }else{
           $query = "INSERT INTO session_login (name,email,user,pw,token) VALUES ('$name','$email','$user','$pwEncrypt','$token')";  
           $stmtUserInsert = $conn->query($query);
        if($stmtUserInsert > 0) {
           $registreOk = "Us heu registrat correctament. Si us plau, revisa el teu email, i clica a l'enllaç per tal d'activar el compte.";
           $toUser = $email;
           $subject = "Confirmació de registre - xavideveloper.com";
           $message = "Hola " . $name . ". Per tal de confirmar el registre i activar el teu compte clica al seguent enllaç: http://xavideveloper.com/login/activar_correu.php?email=" . $email . '&token=' . $token;
           mail($toUser,$subject,$message);
        }else{
           $error = "Error. Hi ha hagut un error al registrar-se.";
        }
    }
}

?>

<body class="class-body">

<?php require_once("nav_login.php");?>

<!----------------------------- MISSATGE ERROR ------------------------->

   <?php if(isset($error)) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <span><?php echo $error; ?></span> 
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!----------------------------- MISSATGE REGISTREOK ------------------------->

   <?php if(isset($registreOk)) : ?>
      <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
         <span><?php echo $registreOk; ?></span> 
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

<!-------------------------------------------------------------------------->

<div class="d-flex justify-content-center container-vh"> 
  
   <div class="align-self-center container-form p-3">

      <div class="d-flex justify-content-center mb-3">
         <img src="img/user_session_2.svg" alt="">
      </div>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="userform" class="form">

         <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nom" required>
         </div>

         <div class="input-group mb-3">
            <input type="text" class="form-control" name="email" placeholder="Email" required>
         </div>
        
         <div class="input-group mb-3">
            <input type="text" class="form-control" name="user" placeholder="Usuari" required>
         </div> 

         <div class="input-group mb-3">
            <input type="password" class="form-control" name="pw" placeholder="Contrassenya" required>
         </div>

         <button type="submit" name="registrar" class="btn bg-green-color d-block w-100"><span>Registra't</span></button>
         <a href="index-login.php">Ja està registrat/da? Accedeix.</a>
      
      </form>  

   </div>
</div>

  <?php require_once("includes-login/footer.php"); ?>

</body>
</html>
