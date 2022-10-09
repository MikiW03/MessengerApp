<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Messenger</title>
</head>

<body>

    <?php
    require('./vendor/autoload.php');

    session_start();

    if (isset($_POST) && isset($_POST['receiver'])) {
        $_SESSION["receiver"] = strip_tags($_POST["receiver"]);
    }

    if (!isset($_SESSION['sender']) || !isset($_SESSION['receiver'])) {
        header('Location:' . "login.php");
    }

    $activeUser = $_SESSION["sender"];
    $receiver = $_SESSION["receiver"];


    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    $dbAddress = $_ENV["DB_ADDRESS"];
    $dbUser = $_ENV["DB_USER"];
    $dbPassword = $_ENV["DB_PASSWORD"];
    $dbName = $_ENV["DB_NAME"];
    ?>

    <div class="content">
        <header class="header con-header">
            <p id="go-back" class="go-back">
                ⬅️
            </p>
            <div class="wrapper">
                <img src="avatar.png" alt="avatar">
                <p class="username"><?= ucwords($receiver) ?></p>
            </div>

        </header>
        <main class="messages" id="messages">
            <?php

            if ($_POST && isset($_POST['message'])) {
                if ($_POST['message']) {
                    $message = strip_tags($_POST['message']);
                    $date = date('Y-m-d H:i:s');

                    $mysqli = new mysqli($dbAddress, $dbUser, $dbPassword, $dbName);
                    $stmt = $mysqli->prepare("INSERT INTO messages (date, sender, receiver, content) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $date, $activeUser, $receiver, $message);
                    $stmt->execute();
                }

                header('Location:' . $_SERVER['PHP_SELF']);
            }

            ?>

            <?php
            $mysqli = new mysqli($dbAddress, $dbUser, $dbPassword, $dbName);

            $result = $mysqli->query("SELECT * FROM messages");
            $messages = $result->fetch_all(MYSQLI_ASSOC);

            foreach ($messages as $message) {
                if (((strtolower($message["receiver"]) == strtolower($activeUser)) || (strtolower($message["sender"]) == strtolower($activeUser))) && ((strtolower($message["receiver"]) == strtolower($receiver)) || (strtolower($message["sender"]) == strtolower($receiver)))) {
            ?>

                    <div class="message <?= strtolower($message["sender"]) === strtolower($activeUser) ? 'message-sent' : 'message-received' ?>">
                        <p class="message-date"><?= date("d-m-Y H:i:s", strtotime($message['date'])) ?></p>
                        <div class="message-content"><?= nl2br($message['content']) ?></div>
                    </div>

            <?php
                }
            }
            ?>

        </main>
        <form action="" method="POST" class="bottom-bar">
            <textarea name="message" class="message-input" id="message-input" placeholder="Aa"></textarea>
            <button class="message-submit" id="message-submit"><img src="send.png" alt="send button" class="submit-icon"></button>
        </form>

        <script>
            const field = document.querySelector("#message-input");
            const button = document.querySelector("#message-submit");
            const goBack = document.querySelector("#go-back");
            const messageContent = document.querySelectorAll(".message-content");
            const messages = document.querySelector(".messages");

            window.addEventListener("load", () => {
                if (messages.offsetHeight > window.innerHeight)
                    window.scrollTo(0, messages.scrollHeight);
            })

            field.focus()

            field.addEventListener("keyup", (event) => {
                if (event.keyCode == 13 && !event.shiftKey) {
                    event.preventDefault();
                    button.click()
                }
            })

            goBack.addEventListener("click", (event) => {
                window.location.href = "index.php"
            });

            Array.from(messageContent).forEach(message => {
                message.addEventListener("click", (event) => {
                    event.target.previousElementSibling.classList.toggle("visible")
                })
            });


            // setInterval(() => {
            //     window.location.reload()
            // }, 1000)
        </script>
    </div>
</body>

</html>