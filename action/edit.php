<?php
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
include_once "../db_connect.php";


if (isset($_REQUEST['edit'])) {
    $id = $_REQUEST['edit'];

    $query = "SELECT * FROM user WHERE Id = $id";
    $result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
} else {
    $message = 'Data Not Found.';
    echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="index.php";</script>';
    //print_r($row);
}


    if (isset($_POST['Update_Data'])) {
        $Full_Name = $_POST['Full_name'];
        $Email_Id = $_POST['Email_Id'];
        $Contact_No = $_POST['Contact_No'];
        $Dob = $_POST['Dob'];
        

        $query = "select * from user where Email_ID = '$Email_Id'";
        $result = mysqli_query($conn, $query);
        $num_exists_row = mysqli_num_rows($result);
        
        $email = $row['Email_ID'];
    
        if ($num_exists_row > 0) {
            
            if ($email !== $Email_Id) {
                $message = 'Email ID already exists.';
                echo '<script type="text/javascript">alert("' . $message . '");</script>';
                echo '<script type="text/javascript"> window.location.href="edit.php?edit="' . $id . ';</script>';
            } else {  
            
          
                
                if (isset($_FILES['file_upload'])) {
                    $username = $id . "_" . $Full_Name;
    
                    $file_ext = strtolower(end(explode('.', $_FILES['file_upload']['name'])));
                    $typeof_files = ['png', 'jpeg', 'jpg',''];
    
                    $new_name = $username . "." . $file_ext;

                    
    
                    $target_path = '../Profile_image/' . basename($new_name);
                    

                    if (!file_exists($new_name)) {
                        if (!(in_array($file_ext, $typeof_files))) {
                            $message = 'Invalid file type. Only JPG, JPEG and PNG types are accepted.';
                            echo '<script type="text/javascript">alert("' . $message . '");</script>';
                        } elseif ($file_size >= 500000) {
                            $message = 'Size must be less than 500KB.';
                            echo '<script type="text/javascript">alert("' . $message . '");</script>';
                        } elseif (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_path)) {
                            $message = 'Image Uploaded Successfully.';
                            echo '<script type="text/javascript">alert("' . $message . '");
                            window.location.href="../viewuser.php";</script>';;
    
                            $query = "UPDATE user Set Full_Name = '$Full_Name', Email_ID='$Email_Id', Contact_No='$Contact_No', Dob='$Dob', image='$new_name'  Where Id = $id";
                            $result = mysqli_query($conn, $query);
                            if (!$result) {
                                $message = 'Record is Not Updated. Please Try Again';
                                echo '<script type="text/javascript">alert("' . $message . '");
                                window.location.href="../viewuser.php";</script>';
                            } else {
                                $message = 'Record is Updated.';
                                echo '<script type="text/javascript">alert("' . $message . '");</script>';
                                echo '<script type="text/javascript"> window.location.href="edit.php?edit="' . $id . ';</script>';
                            }
                        } else {
                            echo "File Not Uploaded";
                        }
                    } else {
                        echo " File Already Exists.";
                    }
                }
            }
        } 
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <style>
        form, h2 {
            margin: 0px 100px;
        }

        form input {
            margin: 10px;
        }

        form input[type="submit"], form a {
            
            text-decoration: none;
            color: white;
            border: 2px solid #71b7e6;
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            padding: 10px 15px;
            margin: 10px;
        
        }
    </style>
</head>

<body>
    <?php
include_once "../header.php";

    ?>

    <h2>Update Data Of User</h2>

    <form method="post" action="" enctype="multipart/form-data">
        ID :
        <input type="number" name="Id" value="<?php echo $row['Id'] ?>" disabled> <br>
        Full Name :
        <input type="text" name="Full_name" value="<?php echo $row['Full_Name'] ?>"><br>
        Email ID:
        <input type="email" name="Email_Id" value="<?php echo $row['Email_ID'] ?>"><br>
        Contact No. :
        <input type="text" name="Contact_No" value="<?php echo $row['Contact_No'] ?>"><br>
        Date of Birth :
        <input type="date" name="Dob" value="<?php echo $row['Dob'] ?>"><br>
        Upload Your Image Here:
        <input type="file" name="file_upload"><br>
        <input type="submit" value="Update Data" name="Update_Data">
        <a href="../viewuser.php">Back to user data</a>
    </form>

</body>

</html>