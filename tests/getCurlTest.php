<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../classes/getCurl.php";

class getCurlTest extends \PHPUnit_Framework_TestCase {
    public  function  test_get_curl()
    {

        $this -> assertNotEmpty(get_curl('http://google.com'));
    }
}