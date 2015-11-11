<?php
require_once __DIR__ ."/getCurl.php";
require_once __DIR__ . "/../vendor/autoload.php";

function saveToken($token)
{
    $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
    $tumblr = getenv('TUMBLR_ACCESS_TOKEN');
    $url = 'https://api.vk.com/method/users.get?access_token=' . $token;
    $response = json_decode(get_curl($url));
    if (!isset($response->error)) {
        $user_id = $response->response[0]->uid;
        $string = file_get_contents(__DIR__ . "/../.env");
        $envArr = explode("\n", $string);
        $envToken = explode('=', $envArr[0]);
        $envUID = explode('=', $envArr[1]);
        $envToken[1] = $token;
        $envUID[1] = $user_id;
        $string = $envToken[0] . '=' . $envToken[1] . "\n" . $envUID[0] . '=' . $envUID[1] . "\nTUMBLR_ACCESS_TOKEN=" . $tumblr;
        $fp = fopen(__DIR__ .'/../.env', 'w');
        fputs($fp, $string);
        fclose($fp);
        echo '<script>document.location.href = "http://localhost:8888";</script>';
        return true;
    } else {
        echo 'Error. Please check your access token<br>';
        echo '<a href="../index.php">Back</a>';
        return false;
    }
}

saveToken($_POST['access_token']);
