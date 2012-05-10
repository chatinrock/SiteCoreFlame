<?php
namespace site\conf;

use core\classes\DB\adapter\adapter;

class DB {
    
    public static $conf = [
            adapter::USER => 'user',
            adapter::PWD => 'pwd',
            adapter::HOST => '127.0.0.1',
            adapter::NAME => 'dbname',
            adapter::CHARSET => 'utf8'
        ];

}

?>