<?php 

require_once("connexio_mysqli.php");

session_start();

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if($_POST['newPw'] === $_POST['repeatPw']) {
         $pw = mysqli_real_escape_string($conn,$_POST['newPw']);
         $newPw = sha1($pw);

         $email = mysqli_real_escape_string($conn,$_POST['email']);
         $token = mysqli_real_escape_string($conn,$_POST['token']);

         $query = "UPDATE session_login SET pw = '$newPw', token = '$token' WHERE email = '$email'";
         $stmt = $conn->query($query);

         if($stmt > 0) {
            $pwUpdate = "Contrassenya actualitzada.";
            header("Location: new_pass.php?pw_update=".$pwUpdate);
            exit();
         }

     }else{
        $pwError = "Les contrassenyes no coincideixen!";
        header("Location: new_pass.php?pw_error=".$pwError);
        exit();
     }
}
    
?>
