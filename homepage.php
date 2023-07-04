<?php
session_start();
include_once "header.php";

if (empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        a {
            text-decoration: none;
            color: white;
            border: 2px solid #71b7e6;
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
            padding: 10px 15px;
            margin: 10px;
        }

        .btn {
            padding: 10px 15px;
            margin: 20px;
        }
    </style>
</head>

<body>

    <h1><?php echo "Hello " . $_SESSION['name']; ?></h1>
    <?php echo "Role : " . $_SESSION['access']; ?>

    <div class="container">


        <div class="btn">
            <a href="viewuser.php">View User</a>
        </div>

        <?php
        if ($_SESSION['access'] == 'Admin' || $_SESSION['access'] == 'Teacher') {
        ?>
            <div class="btn">
                <a href="adduser.php">Add User</a>
            </div>
            <div class="btn">
                <a href="subject.php">Subject Section</a>
            </div>
            <div class="btn">
                <a href="chapter.php">Chapter Section</a>
            </div>
            <div class="btn">
                <a href="standard.php">Standard Section</a>
            </div>
            <div class="btn">
                <a href="assign_sub.php">Assign Subject and Student</a>
            </div>

        <?php
        }

        if ($_SESSION['access'] == 'Admin') {
        ?>
            <div class="btn">
                <a href="assignchap.php">Assign Chapter to subject</a>
            </div>
        <?php
        }
        ?>

    </div>

</body>

</html>
<?php
