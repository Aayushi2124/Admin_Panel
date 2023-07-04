<?php
session_start();

include_once "db_connect.php";

if(isset($_POST['register'])){
    $accesstype=$_POST['accesstype'];
    $email_id = [];
    $query="select Email_ID from user";
    $result=mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $email_id[]=$row['Email_ID'];
    }
    
    if(in_array($_POST['email_ID'],$email_id)){
        $_SESSION['error']='<font color="red">Email Id Already exists.</font>';
        header("location: ./index.php");
    } else {
        if($_POST['password']==$_POST['c_password']){
            
            $pswd=md5($_POST['password']);
           
            $insert_query = "insert into user values(null,'$_POST[full_name]','$_POST[email_ID]',$_POST[contact_no],'$_POST[dob]','$pswd','')";
            
            $insert_result = mysqli_query($conn,$insert_query);
 
            $id=mysqli_insert_id($conn);
            $access_query = "insert into user_type(user_id,access_id) values ('$id','$accesstype')";
            $access_result =mysqli_query($conn,$access_query);
            if(!$access_result){
                $_SESSION['error']='<font color="red">Form is not submitted, Please try again.</font>';
                header("location: ./index.php");
            } else {
                $_SESSION['email']=$_POST['email_ID'];
                ?><script type="text/javascript">
        alert("Registration successfully..You may login now.")
        window.location.href = "login.php";
    </script>
    <?php
            }
    
        } else {
            $_SESSION['error']='<font color="red">Confirm password not match</font>';
            header("location: ./index.php");
        }
    }
    
} else {
    $_SESSION['error']='<font color="red">Try Again !!</font>';
		header("location: ./index.php");
}
?>