<?php 
session_start();
if (empty($_SESSION['id'])){
    header("Location: login.php");
} 
include_once"header.php";
?>
<style>
    
    table {
        border: 1px solid black;
        border-spacing: 0;
    }

    th,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    button {
        padding: 10px 10px;
        margin: 5px;
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        border: none;
        border-radius: 5px;
        font-size: 17px;
    }

    button a{
            text-decoration: none;
            color: white;
            
        }

    button:hover {
        background: black;
        color: white;
    }
</style>
<?php
include "db_connect.php";
$query = "select * from user";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
    ?>
            <h1 align="center">User Data</h1>
            <table align="center" style="width: 1100px;">
                <tr>
                    <?php
                    $row = mysqli_fetch_assoc($result);
                    foreach ($row as $column => $value) {
                        if ($column == 'Password') {
                            continue;
                        } else {
                            echo "<th> ".strtoupper($column). "</th>";
                        }
                    }
                    ?>
                    <th>Action</th>
                </tr>
                <tr>
                <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Full_Name']; ?></td>
                    <td><?php echo $row['Email_ID']; ?></td>
                    <td><?php echo $row['Contact_No']; ?></td>
                    <td><?php echo $row['Dob']; ?></td>
                    <td> <?php
                if ($row['image']) {
                    $image_path = '../task_2/Profile_image/' . $row['image'];
                    echo '<img src="' . $image_path . '" width="200">';
                } else {
                    echo 'No image available';
                }
                ?></td>
                    <td>
                        <button><a href='action/edit.php?edit=<?php echo $row["Id"] ?>'>Edit</a></button>
                        <button><a href='action/delete.php?delete=<?php echo $row["Id"] ?>'>Delete</a></button>
                        <button><a href='action/view.php?view=<?php echo $row["Id"] ?>'>View</a></button>
                    </td>
                </tr>
                <?php
                while($row=mysqli_fetch_assoc($result)){

                ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Full_Name']; ?></td>
                    <td><?php echo $row['Email_ID']; ?></td>
                    <td><?php echo $row['Contact_No']; ?></td>
                    <td><?php echo $row['Dob']; ?></td>
                    <td><?php
                if ($row['image']) {
                    $image_path = '../task_2/Profile_image/' . $row['image'];
                    echo '<img src="' . $image_path . '" width="200" alt="Profile Image">';
                } else {
                    echo 'No image available';
                }
                ?></td>
                    <td>
                        <button><a href='action/edit.php?edit=<?php echo $row["Id"] ?>'>Edit</a></button>
                        <button><a href='action/delete.php?delete=<?php echo $row["Id"] ?>'>Delete</a></button>
                        <button><a href='action/view.php?view=<?php echo $row["Id"] ?>'>View</a></button>
                    </td>
                </tr>
        <?php }
        } else {
                    $message = 'Row Data Not Found.';
        echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="index.php";</script>';
                }
        ?>
            </table><br> <center>
        <a href="homepage.php">Back to home</a>
           </center>
