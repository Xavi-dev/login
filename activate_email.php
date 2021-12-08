<?php 
 
require_once("connexio_mysqli.php");

session_start();

   if(isset($_GET['email']) AND isset($_GET['token'])) {
      $email = mysqli_real_escape_string($conn,$_GET['email']);
      $token = mysqli_real_escape_string($conn,$_GET['token']);

      $query = "SELECT * FROM session_login WHERE email = '$email' AND token = '$token' AND estat = '0'";
      $queryResult = $conn->query($query);
      $rows = $queryResult->num_rows;

      if($rows === 0) {
         $errorIsActive = "Error. Compte ja actiu, o url incorrecte!";
         header("Location: index-login.php?errorIsActive= . '$errorIsActive'");
      }else{
         $queryActive = "UPDATE session_login SET estat = '1' WHERE email = '$email'";
         $queryResultActive = $conn->query($queryActive);
         $accountActive = "El teu compte ha estat activat.";
         header("Location: index-login.php?accountActive=" . $accountActive);
      }
   }else{
      echo "Error. L'url no és correcte!";
   }
