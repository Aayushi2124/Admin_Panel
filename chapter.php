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
    <title>Chapter Section</title>
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
    <h2>Chapter Section</h2>
    <form action="" method="post">
        <label for="subject">Add new Chapter:</label>
        <input type="text" placeholder="Add Chapter" name="chapter">
        <input type="submit" name="add_chapter" value="Add chapter">
    </form>
    <?php

    include_once "db_connect.php";

    if (isset($_POST['add_chapter'])) {
        $chap = $_POST['chapter'];
        $insert_chap_query = "insert into chapters (sub_id, chapter) value (null, '$chap')";
        $result = mysqli_query($conn, $insert_chap_query);
        // print_r($result);
        // die();
        if (!$result) {
    ?>
            <script type="text/javascript">
                alert("Chapter is not added..")
                window.location.href = "chapter.php";
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM chapters WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <form action="" method="post">
            <label for="edit_subject">Update Chapter:</label>
            <input type="text" name="update_chapter" value="<?php echo $row['chapter'] ?>">
            <input type="submit" name="edit_chapter" value="Update">
        </form>
    <?php
        if (isset($_POST['edit_chapter'])) {
            $chap = $_POST['update_chapter'];
            $edit_query = "update chapters set chapter='$chap' where id=$id";
            $result = mysqli_query($conn, $edit_query);
            if ($result) {
                header("Location:chapter.php");
            } else {
                $message = 'chapter not updated.';
                echo '<script type="text/javascript">alert("' . $message . '");
        window.location.href="subject.php?edit=<?php echo $row["id"]";</script>';
            }
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query="DELETE FROM chapters WHERE id = $id";
        $result = mysqli_query($conn, $query);
   
        if(!$result){
           $message = 'Record is not deleted. Please Try agin.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="chapter.php?edit=<?php echo $row["id"]";</script>';
   
        } else {
           $message = 'Record is Deleted Successwfully.';
           echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="chapter.php";</script>';
   
        }
    }


    $query = "select * from chapters";
    $result = mysqli_query($conn, $query);
    ?>
    <h3>Chapters</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <td>ID</td>
            <td>Chapter Name</td>
            <td>Action</td>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['chapter']; ?></td>
                    <td>
                        <button><a href='chapter.php?edit=<?php echo $row["id"] ?>'>Edit</a></button>
                        <button><a href='chapter.php?delete=<?php echo $row["id"] ?>'>Delete</a></button>
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