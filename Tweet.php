<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tweet
 *
 * @author seb
 */
class Tweet {

    //put your code here
    private $pseudo;
    private $message;
    private $avatar;
    private $retweets;
    private $likes;
    private $date;
    private $tweetnum;

    function __construct($pseudo, $message, $avatar, $retweets, $likes, $date) {
        $this->pseudo = $pseudo;
        $this->message = $message;
        $this->avatar = $avatar;
        $this->retweets = $retweets;
        $this->likes = $likes;
        $this->date = $date;
        $this->tweetnum = rand(0, 1000000);
    }

    function newTweet() {
        if ($this->pseudo === "" || $this->message === "" || strlen($this->message) > 140) {
            
        } else {
            $inp = file_get_contents("tweets/tweets.json");
            $tempArray = json_decode($inp);
            $tempArray->{$this->tweetnum}["pseudo"] = $this->pseudo;
            $tempArray->{$this->tweetnum}["message"] = $this->message;
            $tempArray->{$this->tweetnum}["avatar"] = $this->avatar;
            $tempArray->{$this->tweetnum}["retweets"] = $this->retweets;
            $tempArray->{$this->tweetnum}["likes"] = $this->likes;
            $tempArray->{$this->tweetnum}["date"] = $this->date;
            $jsonData = json_encode($tempArray);
            file_put_contents('tweets/tweets.json', $jsonData);
        }
    }

    function deleteTweet() {
        if (isset($_POST['del'])) {
            $inp = file_get_contents("tweets/tweets.json");
            $tempArray = json_decode($inp);
            unset($tempArray->{$this->tweetnum});
            $jsonData = json_encode($tempArray);
            file_put_contents('tweets/tweets.json', $jsonData);
        }
    }

    //__________________________GETTERS_____________________

    function getPseudo() {
        return $this->pseudo;
    }

    function getMessage() {
        return $this->message;
    }

    function getAvatar() {
        return $this->avatar;
    }

    function getRetweets() {
        return $this->retweets;
    }

    function getLikes() {
        return $this->likes;
    }

    function getDate() {
        return $this->date;
    }

}

//_______________________________________________________________________
function displayTweets() {
    $file = file_get_contents("tweets/tweets.json");
    $json = json_decode($file, true);
    //var_dump($json["tweet01"]['pseudo']);
    foreach ($json as $key) {
        //echo $key['avatar'] . "<br/>";
        echo "<section class='tweet'>";
        echo "<div class='imgandname'>";
        echo "<span><img class='pic line' width='50' height='50' src='" . $key['avatar'] .
        "' alt='profile_pic'></span>";
        echo "<p class='name line'>" . $key['pseudo'] . "</p>";
        echo "</div>";
        echo "<p class='message'>" . $key['message'] . "</p>";
        echo "<p >Length: " . strlen($key['message']) . "</p>";
        echo "<div class='infos'>";
        echo "<p class='date'>Date : " . $key['date'] . "</p>";
        echo "<p class='retweets'>Retweets : " . $key['retweets'] . "</p>";
        echo "<p class='likes'>Likes : " . $key['likes'] . "</p>";
        echo "<form action='' method='POST'><input type='hidden'name='del' value='true'><input type='submit' value='Delete Tweet'></form>";
        echo "</div>";
        echo "</section>";
    }
}
