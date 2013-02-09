<?php
namespace site\conf;

use core\classes\DB\adapter\adapter;

class DB {
    
    public static $conf = [
            adapter::USER => 'xenglishx',
            adapter::PWD => 'SLDuf09w837rywoehfr2083#%3537oAIUyshdf897qw234',
            adapter::HOST => 'localhost',
            adapter::PORT => '3306',
            adapter::NAME => 'xenglishx',
            adapter::CHARSET => 'utf8',
            adapter::SOCKET => '/var/run/mysqld/mysqld.sock'
        ];

}