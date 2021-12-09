<?php

$title = "User registration";
require_once("includes-login/header.php"); 
require_once("connection_mysqli.php");

   if(isset($_POST['registration'])){
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
           $error = $user . " already exists. Choose another one.";
        }else{
           $query = "INSERT INTO session_login (name,email,user,pw,token) VALUES ('$name','$email','$user','$pwEncrypt','$token')";  
           $stmtUserInsert = $conn->query($query);
        if($stmtUserInsert > 0) {
           $registrationOk = "You have registered correctly. An email has been sent to confirm your account.";
           $toUser = $email;
           $subject = "Registration confirmation";
           $message = "Hi " . $name . ". To confirm your registration and activate your account click on the following link: https://your-domain-name/login/activate_email.php?email=" . $email . '&token=' . $token;
           mail($toUser,$subject,$message);
        }else{
           $error = "Error. There has been an error registering.";
        }
    }
}

?>

<body class="class-body">

<?php require_once("nav_login.php"); ?>
   
   
<?php if(isset($error)) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <span><?php echo $error; ?></span> 
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>
   
<?php if(isset($registrationOk)) : ?>
      <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
         <span><?php echo $registrationOk; ?></span> 
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>


<div class="d-flex justify-content-center container-vh"> 
  
   <div class="align-self-center container-form p-3">

      <div class="d-flex justify-content-center mb-3">
         <img src="img/user_session_2.svg" alt="">
      </div>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="userform" class="form">

         <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
         </div>

         <div class="input-group mb-3">
            <input type="text" class="form-control" name="email" placeholder="Email" required>
         </div>
        
         <div class="input-group mb-3">
            <input type="text" class="form-control" name="user" placeholder="User" required>
         </div> 

         <div class="input-group mb-3">
            <input type="password" class="form-control" name="pw" placeholder="Password" required>
         </div>

         <button type="submit" name="registration" class="btn bg-green-color d-block w-100"><span>Register</span></button>
         <a href="index_login.php">Already registered? Log in</a>
      
      </form>  

   </div>
</div>

  <?php require_once("includes-login/footer.php"); ?>

</body>
</html>
