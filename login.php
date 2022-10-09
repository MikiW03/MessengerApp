<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST) && isset($_POST['sender'])) {
        session_start();
        $_SESSION['sender'] = strip_tags($_POST['sender']);

        header('Location:' . "index.php");
    }

    ?>

    <main class="content login-content">
        <form action="" method="POST" class="login-form">
            <label for="sender">Your nickname</label>
            <input type="text" id="sender" name="sender">
            <button class="submit-btn">Enter</button>
        </form>
    </main>
</body>

</html>