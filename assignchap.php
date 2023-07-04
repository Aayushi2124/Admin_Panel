<?php
session_start();

if (empty($_SESSION['id'])) {
    header("Location: login.php");
}

include_once "header.php";
include_once "db_connect.php"
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
    <h2>Assign Chapter to subject Section</h2>
    <form action="" method="post">
        <label for="select_subject">select Subject:</label>
        <select name="subjectname">
            <?php
            $query = "SELECT * FROM subjects";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['subjects'];
                $id = $row['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <label for="select_Chapter">select chapter:</label>
        <select name="chaptername">
            <?php
            $query = "SELECT * FROM chapters";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['chapter'];
                $id = $row['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>
        <input type="submit" name="submitchap" value="Add Chapter">
    </form>

    <?php
    $query = "SELECT chapter_subject.*, chapters.chapter As chap_name, subjects.subjects AS sub_name
    FROM `chapter_subject` 
    JOIN chapters ON chapters.id = chapter_subject.chapt_id 
    JOIN subjects ON subjects.id = chapter_subject.sub_id";
    
    $result = mysqli_query($conn, $query);

    ?>

    <h3>Subjects</h3>
    <table align="center" style="width: 1100px;">
        <tr>
            <th>ID</th>
            <th>Chapter name</th>
            <th>Subject name</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // print_r($row);
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['chap_name']; ?></td>
                    <td><?php echo $row['sub_name']; ?></td>

                </tr><?php
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
    <br>
        <a href="homepage.php">Back to Homepage</a>

        <?php
        if (isset($_POST['submitchap'])) {

            $chapter_name = $_POST['chaptername'];
            $subject_name = $_POST['subjectname'];
            // print_r($_POST);
            // die();

            $assign_chap_query = "insert into chapter_subject (chapt_id, sub_id) values ('$chapter_name', '$subject_name')";
            // print_r($assign_chap_query);
            // die();
            $result = mysqli_query($conn, $assign_chap_query);
            if ($result) {
                $message = 'Chapter is assign to subjects.';
                echo '<script type="text/javascript">alert("' . $message . '");
           window.location.href="assignchap.php";</script>';
            } else {
            }
        }
        ?>
</body>

</html>