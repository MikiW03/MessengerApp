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
    if (isset($_POST) && isset($_POST['sender']) && isset($_POST['receiver'])) {
        session_start();
        $_SESSION['sender'] = $_POST['sender'];
        $_SESSION['receiver'] = $_POST['receiver'];

        header('Location:' . "index.php");
    }

    ?>

    <main class="content login-content">
        <form action="" method="POST" class="login-form">
            <label for="sender">Your nickname</label>
            <input type="text" id="sender" name="sender">
            <label for="receiver">Receiver nickname</label>
            <input type="text" id="receiver" name="receiver">
            <button class="submit-btn">Enter</button>
        </form>
    </main>
</body>

</html>