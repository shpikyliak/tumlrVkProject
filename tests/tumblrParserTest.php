<?php
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../classes/tumblrParser.php";

class TumblrParserTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider provider
     */
    public  function  testGetPicture($blogName)
    {
        $test = new \classes\tumblrParser();

        $this -> assertNotEmpty($test-> getPictures($blogName));
    }
    public function provider()
    {
        return array(
            array('komanda'),
            array('xxddxxx111qq_____qq3322')
        );
    }
}
