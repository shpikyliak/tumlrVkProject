<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../classes/saveToken.php";

class saveTokenTest extends \PHPUnit_Framework_TestCase {

    public  function  test_saveToken()
    {

            $this -> assertNotFalse(saveToken('f2ad25eb4e781c6bf8617e255ca5d0c297bff3c55b27688cdf698d9a00651898aa8840555489f4519dde3'));
    }


}
