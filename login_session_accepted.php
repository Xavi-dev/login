<?php

$title = "Sessió iniciada | xavideveloper";
require_once("connexio_mysqli.php");
require_once("includes-login/header.php"); 

session_start();

   if(!isset($_SESSION['id'])) {
      header("Location: index-login.php");
   }

   $iduser = $_SESSION['id']; 

   $query = "SELECT id, user FROM session_login WHERE id ='$iduser'";
   $stmt = $conn->query($query);

   $row = $stmt->fetch_assoc(); 

?>

<body class="class-body">

<?php require_once("nav_login.php");?>

   <div class="d-flex justify-content-center container-vh">
      <div class="flex-sm-row align-self-center">

         <div>
            <h1 class="text-grey"><?php echo utf8_decode($row['user']) . " ha iniciat sessió."; ?></h1>
         </div>
            
         <div class="justify-content-center mb-2">
            <div class="d-flex justify-content-center">
               <a href="exit_session.php"><img src="img/icon_session_close.svg" class="icon-close-session mt-3 mb-2" alt=""></a>
            </div>

         <p class="text-center"><a href="exit_session.php" class="text-grey">Tancar sessió</a></p>
  
         </div>
      </div>
    
</body>
</html>
