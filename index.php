<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <style>
        /* MAIN */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Helvetica Neue", Helvetica, Arial;
        }

        :root {
            --main-clr: #b5d0e0;
            --first-msg-clr: #f8d701;
            --second-msg-clr: #fffdf5;
            --content-width: 500px;
        }

        body {
            display: grid;
            justify-items: center;
        }

        .content {
            width: min(100vw, var(--content-width));
            min-height: 100vh;
            background: url("bg.png") no-repeat center center fixed;
            background-size: cover;
        }

        /* HEADER */

        .header {
            position: fixed;
            width: min(100vw, var(--content-width));
            height: 50px;
            top: 0;
            background-color: var(--main-clr);
            box-shadow: 0px 1px 2px .5px rgba(0, 0, 0, .3);

            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .username {
            font-weight: 700;
        }

        /* MAIN */

        .messages {
            margin: 50px 0;
            padding: .5rem;
            overflow: scroll;

            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .message {
            width: 100%;

            display: grid;
        }

        .message-content {
            width: fit-content;
            max-width: 80%;
            padding: .5rem 1rem;
            border-radius: 20px;
        }

        .message-sent>.message-content {
            justify-self: flex-end;
            background-color: var(--first-msg-clr);
        }

        .message-received>.message-content {
            justify-self: flex-start;
            background-color: var(--second-msg-clr);
        }

        /* BOTTOM BAR */

        .bottom-bar {
            position: fixed;
            bottom: 0;
            width: min(100vw, var(--content-width));
            height: 50px;
            background-color: var(--main-clr);
            box-shadow: 0px 1px 2px .5px rgba(0, 0, 0, .3);
            padding: 5px 1rem;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .message-input {
            resize: none;
            border: 0;
            width: 88%;
            border-radius: 100vmax;
            padding: .2rem 1rem;
            line-height: 16px;
        }

        .message-submit {
            width: 10%;
            aspect-ratio: 1;
            border: 0;
            border-radius: 50%;
            background-color: inherit;
        }

        .message-submit:hover,
        .message-submit:focus {
            background-color: white;
        }

        .message-submit:active {
            background-color: lightgray;
        }

        .submit-icon {
            max-height: 100%;
        }
    </style>
</head>

<body>
    <div class="content">

        <header class="header">
            <img src="avatar.png" alt="avatar">
            <p class="username">John Doe</p>
        </header>
        <main class="messages">
            <div class="message message-sent">
                <div class="message-content">test message</div>
            </div>
            <div class="message message-sent">
                <div class="message-content">test message</div>
            </div>
            <div class="message message-sent">
                <div class="message-content">test message</div>
            </div>
            <div class="message message-received">
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quae at quam architecto. Dolorum quaerat modi sint quas amet earum, officiis rem tempore quia incidunt eos tenetur hic maiores architecto.</div>
            </div>
            <div class="message message-sent">
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quae at quam architecto. Dolorum quaerat modi sint quas amet earum, officiis rem tempore quia incidunt eos tenetur hic maiores architecto.</div>
            </div>
            <div class="message message-received">
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quae at quam architecto. Dolorum quaerat modi sint quas amet earum, officiis rem tempore quia incidunt eos tenetur hic maiores architecto.</div>
            </div>
            <div class="message message-received">
                <div class="message-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quae at quam architecto. Dolorum quaerat modi sint quas amet earum, officiis rem tempore quia incidunt eos tenetur hic maiores architecto.</div>
            </div>

        </main>
        <div class="bottom-bar">
            <textarea name="message" class="message-input" placeholder="Aa"></textarea>
            <button class="message-submit"><img src="send.png" alt="send button" class="submit-icon"></button>
        </div>
    </div>
</body>

</html>