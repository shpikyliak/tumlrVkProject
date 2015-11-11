<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../classes/uploadVkImg.php";

class uploadVkImgTest extends \PHPUnit_Framework_TestCase {

    public  function  test_uploadVkImg()
    {

        $this -> assertNotFalse(uploadImg('[object Object]/||/http://41.media.tumblr.com/589273c45f9cdc7f768869793341c609/tumblr_nrkfd5ePWL1tmeibwo1_1280.jpg/||/http://33.media.tumblr.com/122c50e38e08a2d7f42c0fb4420ce3b9/tumblr_nu1mnxmQwN1r4p08ko1_540.gif/||/http://38.media.tumblr.com/486044aceccdc183918cea97f28fee4a/tumblr_n70uykf1S71qfoa77o1_500.gif/||/http://41.media.tumblr.com/83d9b40e8748d48d1416efd6a74761bb/tumblr_nsb2lgg0hB1r4p08ko1_1280.jpg'));
    }


}
