<?php
session_start();

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('class.get_tweets.php');


/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

$connection = new get_tweets(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$content = '<button><a href = "/clearsessions.php">Log Out</a></button>';
include('html.inc');
if(!isset($_SESSION['tweetsArray']))
{
$connection->getEm('',0);
}


if($_SESSION['done'] == 1){ 
//if getEm is done getting all tweets
$connection->showTweets();


}
$connection->showFooter();

