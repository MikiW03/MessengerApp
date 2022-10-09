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
    require('./vendor/autoload.php');
    date_default_timezone_set('Europe/Warsaw');

    session_start();
    if (!isset($_SESSION['sender'])) {
        header('Location:' . "login.php");
    } else {
        if (!trim($_SESSION['sender']))
            header('Location:' . "login.php");
    }

    $activeUser = $_SESSION["sender"];

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    $dbAddress = $_ENV["DB_ADDRESS"];
    $dbUser = $_ENV["DB_USER"];
    $dbPassword = $_ENV["DB_PASSWORD"];
    $dbName = $_ENV["DB_NAME"];

    $mysqli = new mysqli($dbAddress, $dbUser, $dbPassword, $dbName);

    $stmt = $mysqli->prepare("SELECT sender, receiver FROM messages WHERE sender = ? OR receiver = ?");
    $stmt->bind_param("ss", $activeUser, $activeUser);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = $result->fetch_all(MYSQLI_ASSOC);

    $flattenUsers = [];
    array_walk_recursive($users, function ($item) use (&$flattenUsers) {
        $flattenUsers[] = ucwords(strtolower($item));
    });
    $uniqueUsers = array_unique($flattenUsers);
    $activeUserReceivers = array_filter($uniqueUsers, function ($user) use ($activeUser) {
        return strtolower($user) != strtolower($activeUser);
    });
    ?>

    <div class="content">
        <header class="header">
            <div class="wrapper">
                <img src="avatar.png" alt="avatar">
                <p class="username"><?= ucwords($activeUser) ?></p>
            </div>
            <p id="user-change" class="user-change">Change User</p>
        </header>
        <main class="receivers">
            <h2 class="page-title">Your Contacts</h2>
            <form action="conversation.php" method="POST" class="new-conversation">Create New Conversation With <input type="text" name="receiver"> <button>Start</button>
            </form>
            <?php
            if (count($activeUserReceivers) < 1) {
            ?>
                <div>You don't have any started conversations</div>
                <?php
            } else {
                foreach ($activeUserReceivers as $receiver) {

                ?>
                    <form action="conversation.php" method="POST" class="receiver">
                        <input type="hidden" name="receiver" value="<?= $receiver ?>">
                        <button><?= $receiver ?></button>
                    </form>
            <?php
                }
            }
            ?>
        </main>
    </div>

    <script>
        const userChange = document.querySelector("#user-change");
        const receivers = document.querySelectorAll(".receiver");

        userChange.addEventListener("click", (event) => {
            window.location.href = "login.php"
        });
    </script>
</body>

</html>