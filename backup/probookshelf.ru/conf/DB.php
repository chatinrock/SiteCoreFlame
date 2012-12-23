<?php
namespace site\conf;

use core\classes\DB\adapter\adapter;

class DB {
    
    public static $conf = [
            adapter::USER => 'probookshelf',
            adapter::PWD => '()*AZY&sfshdf098347yr',
            adapter::HOST => '127.0.0.1',
            adapter::NAME => 'probookshelf',
            adapter::CHARSET => 'utf8'
        ];

}