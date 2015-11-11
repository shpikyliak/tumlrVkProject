<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once __DIR__."/../vendor/autoload.php";
require_once 'getCurl.php';
session_start();

function uploadImg ($photosPost)
{

    $dotenv = new \Dotenv\Dotenv(__DIR__.'/../');
    $dotenv->load();
    $token = $_ENV['VK_ACCESS_TOKEN'];
    $user_uid = $_ENV['USER_UID'];
    $vk = \getjump\Vk\Core::getInstance()->apiVersion('5.5')->setToken($token);
    $url = 'https://api.vk.com/method/photos.getWallUploadServer?group_id=101646894&v=5.5&access_token=' . $token;
    $request = get_curl($url);
    $data = json_decode($request);
    $link = $data->response->upload_url;
    $photo = explode('/||/', $photosPost);
    $group_id = '101646894';
    $postParams = array();
    $index = 0;
    for ($i = 1; $i < count($photo); $i++) {
        $extention = explode(".", basename($photo[$i]));
        
        if ($extention[1] == 'gif') {
            echo 'You can\'t upload GIF';
            die();
        }
            $index++;

            $path = __DIR__."/../images/" . basename($photo[$i]);
            file_put_contents($path, file_get_contents($photo[$i]));
            $postParams["file" . $index] = "@" . $path;


    }

    if ($index < 7) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        $response = curl_exec($ch);
        $photoParams = json_decode($response);
        $photo = $photoParams->photo;
        $server = $photoParams->server;
        $url = 'https://api.vk.com/method/photos.saveWallPhoto?group_id='.$group_id.'&v=5.5&photo=' . $photo . '&server=' . $server . '&hash=' . $photoParams->hash . '&access_token=' . $token;
        $an = get_curl($url);
        $save = json_decode($an)->response;
        $attachments = "";
        for ($i = 0; $i < count($save); $i++) {
            $attachments = $attachments . "photo" . $user_uid . "_" . $save[$i]->id . ',';
        }
        $url = 'https://api.vk.com/method/wall.post?owner_id=-'.$group_id.'&from_group=1&attachments=' . $attachments . '&access_token=' . $token;
        $an = get_curl($url);
        if (!isset(\GuzzleHttp\json_decode($an)->response)) {
            echo "Unknown error";
            return false;
        } else
        {

            echo "Images is successfully uploaded";
            return true;
        }


    } else {
        echo "ERROR! You upload more than 6 images OR all your pics are GIFs !";
        return false;
    }

}
uploadImg( $_POST['images']);