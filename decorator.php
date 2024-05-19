<?php
require 'view.php'

abstract class userdecorator implements view()
{
    private $ht;
    private $ht1;
    public function __construct()
    {
        $ht = "<html>";
        $ht1="</html>";
    }

    abstract function view();



}



?>