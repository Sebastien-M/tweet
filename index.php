<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <title>Tweet</title>
    </head>
    <body>
        <?php
        include_once './Tweet.php';
        if (isset($_POST['pseudo'])) {
            $postname = htmlspecialchars($_POST['pseudo']);
            $postmessage = htmlspecialchars($_POST['textarea']);
            $avatar = "https://unsplash.it/300/300/?random";
            $retweets = rand(0, 1000);
            $likes = rand(0, 1000);
            $date = date("j/ n/ Y");
            $tweet = new Tweet($postname, $postmessage, $avatar, $retweets, $likes, $date);
            $tweet->newTweet($postname, $postmessage, $avatar, $retweets, $likes, $date);
        }
        ?>
        <header>
            <h1>Ugly Tweet</h1>
        </header>

        <main>

            <div class="newTweet">
                <form id="tweetsen" action="" method="POST">
                    <h3 id="new_title">New tweet</h3>
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" type="text" name="pseudo">
                    <label for="message">Message</label>
                    <textarea name="textarea" rows="10" cols="50"></textarea>
                    <input type="submit" value="Send Tweet">
                </form>
            </div>
            <div class="feed">
                <?php
                displayTweets();
                ?>
            </div>
        </main>

    </body>
</html>