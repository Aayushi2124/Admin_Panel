<?php
session_start();

if (empty($_SESSION['id'])) {
    header("Location: login.php");
}

include_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standard Section</title>
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

        button a {
            text-decoration: none;
            color: white;

        }

        button:hover {
            background: black;
            color: white;
        }
    </style>
</head>


<body>
    <h2>Standard Section</h2>
    <form action="" method="post">
        <label for="standard">Add new Standard:</label>
        <input type="text" placeholder="Add Standard" name="standard">
        <input type="submit" name="add_standard" value="Add Standard">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_standard'])) {
        $std = $_POST['standard'];
        $insert_std_query = "insert into standards (std_name) value ('$std')";
        $result = mysqli_query($conn, $insert_std_query);
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Standard is not added..")
                window.location.href = "standard.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM standards WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Standard:</label>
            <input type="text" name="update_standard" value="<?php echo $row['std_name'] ?>">
            <input type="submit" name="edit_standard" value="Update">
        </form>
    <?php
        if (isset($_POST['edit_standard'])) {
            $std = $_POST['update_standard'];
            $edit_query = "update standards set std_name='$std' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:standard.php");
            } else {
                $message = 'standard not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="standard.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query="DELETE FROM standards WHERE id = $id";
        $result = mysqli_query($conn, $query);
   
        if(!$result){
           $message = 'Record is not deleted. Please Try agin.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="standard.php?edit=<?php echo $row["id"]";</script>';
   
        } else {
           $message = 'Record is Deleted Successwfully.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="standard.php";</script>';
   
        }
    }


    $query = "select * from standards";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Standards</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <td>ID</td>
            <td>Standard Name</td>
            <td>Action</td>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['std_name']; ?></td>
                    <td>
                        <button><a href='standard.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button><a href='standard.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
                    </td>
                <?php
            }
        } else {
                ?>
                <tr>
                    <td colspan="3"> No record Found</td>
                </tr>
            <?php
        }
            ?>
    </table>

    <a href="homepage.php">Back to Homepage</a>
</body>

</html>