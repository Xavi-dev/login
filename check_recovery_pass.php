<?php 

require_once("connection_mysqli.php");

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
            $pwUpdate = "Updated password.";
            header("Location: new_pass.php?pw_update=".$pwUpdate);
            exit();
         }

     }else{
        $pwError = "Passwords are not equal!";
        header("Location: new_pass.php?pw_error=".$pwError);
        exit();
     }
}
    
?>
