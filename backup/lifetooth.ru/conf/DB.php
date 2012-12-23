<?php
namespace site\conf;

use core\classes\DB\adapter\adapter;

class DB {
    
    public static $conf = array(
            adapter::USER => 'lifetooth',
            adapter::PWD => '0*(YP()ADFyh234203709ys',
            adapter::HOST => '127.0.0.1',
            adapter::NAME => 'lifetooth',
            adapter::CHARSET => 'utf8'
        );

}

?>