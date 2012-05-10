<?php
namespace site\conf;

use core\classes\DB\adapter\adapter;

class DB {
    
    public static $conf = [
            adapter::USER => 'seoforbeginners',
            adapter::PWD => 'dftdft',
            adapter::HOST => '127.0.0.1',
            adapter::NAME => 'seoforbeginners',  
            adapter::CHARSET => 'utf8'
        ];

}

?>