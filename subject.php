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
    <title>Subject Section</title>
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
    <h2>Subject Section</h2>
    <form action="" method="post">
        <label for="subject">Add new Subject:</label>
        <input type="text" placeholder="Add Subject" name="subject">
        <input type="submit" name="add_subject" value="Add Subject">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_subject'])) {
        $subject = $_POST['subject'];
        $insert_sub_query = "insert into subjects (subjects) value ('$subject')";
        $result = mysqli_query($conn, $insert_sub_query);
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Subject is not added..")
                window.location.href = "subject.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM subjects WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Subject:</label>
            <input type="text" name="update_subject" value="<?php echo $row['subjects'] ?>">
            <input type="submit" name="edit_subject" value="Update">
        </form>
    <?php
        if (isset($_POST['edit_subject'])) {
            $sub = $_POST['update_subject'];
            $edit_query = "update subjects set subjects='$sub' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:subject.php");
            } else {
                $message = 'subject not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query="DELETE FROM subjects WHERE id = $id";
        $result = mysqli_query($conn, $query);
   
        if(!$result){
           $message = 'Record is not deleted. Please Try agin.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
   
        } else {
           $message = 'Record is Deleted Successwfully.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="subject.php";</script>';
   
        }
    }


    $query = "select * from subjects";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Subjects</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <td>ID</td>
            <td>Subject Name</td>
            <td>Action</td>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['subjects']; ?></td>
                    <td>
                        <button><a href='subject.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button><a href='subject.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
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