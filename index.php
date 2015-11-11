<?php

require_once "vendor/autoload.php";
require_once "classes/tumblrParser.php";
require_once 'classes/getCurl.php';
session_start();
$dotenv = new \Dotenv\Dotenv('.');
$dotenv->load();
$token = $_ENV['VK_ACCESS_TOKEN'];
$user_uid = $_ENV['USER_UID'];
$url = 'https://api.vk.com/method/users.get?access_token=' . $token;
$response = json_decode(get_curl($url));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parser</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</head>
<body>
<form method="get" class="text-center">
    <input type="text" placeholder="Type blog name" name="name">
    <button type="submit" class="btn">Send</button>
</form>
<button id="sendImg" style="float: left;margin-left: 10px;" class="btn-primary">Send images</button>
<br>
<br>
<?php if (isset($response->error) || ($user_uid != $response->response[0]->uid)) { ?>
    <a target="_blank"
       href="https://oauth.vk.com/authorize?client_id=5065182&display=popup&redirect_uri=https://oauth.vk.com/blank.html&scope=photos,wall,offline&response_type=token">GET
        VK access token</a>
    <form method="post" action="classes/saveToken.php">
        <input type="text" placeholder="Insert access token" name="access_token">
        <button type="submit" class="btn">SAVE</button>
    </form>
<?php
}

if (isset($_GET['name'])) {
    $blog = new \classes\tumblrParser();
    $images = $blog->getPictures($_GET['name']);

}


?>


</body>
</html>
