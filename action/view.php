<?php
session_start();
if (empty($_SESSION['id'])){
   header("Location: login.php");
} 

include_once "../db_connect.php";
include_once "../header.php";


if (isset($_REQUEST['view'])) {
   $id = $_REQUEST['view'];
   $image = $row['image'];
   $filename = $_FILES['file_upload']['name'];

   $query = "SELECt * FROM user WHERE id = $id";
   $result = mysqli_query($conn, $query);

   if (!$result) {
      $message = 'Data Not Found.';
      echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="../viewuser.php";</script>';
   } else {
      $row = mysqli_fetch_assoc($result);
      // print_r($row);
      ?>

      <h2 style="font-size: 40px;">
         <center>Data Of User</center>
      </h2>
   <?php
      echo "<form method='post'> <fieldset>";
      ?>
      
      <?php
      foreach ($row as $column => $value) {
         
         if ($value === $row['image']) {
            $image_path = '../Profile_image/' . $row['image'];
            echo 'Your Image: <br> <img src="' . $image_path . '" height="200" alt="Profile Image"><br>';
            continue;
            
         } else {
            echo strtoupper($column) . " : ";

            echo "<input style='margin: 10px;' type='text' value = '" . strtoupper($value) . "' disabled> <br>";
         }
      }
      
   }

   echo "</fieldset></form>";

   ?>
   <a href="../viewuser.php">Back to home</a>
<?php

}


?>