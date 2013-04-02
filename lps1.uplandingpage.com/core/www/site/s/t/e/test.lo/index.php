<?php 
/*
Page generate automatically.
See:
tpl/distribution.php.tpl
core/www/logic/add.php
*/

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

// Form url 
$url = 'http://lps1.uplandingpage.com/s/t/e/test.lo/';

// If cookie exist then redirect user to page
if ( isset($_COOKIE['lpnum']) && !isset($_GET['clear'])){
    header('Location: '.$url.$_COOKIE['lpnum'].'/');
    exit;
}  

// Get uniq id
$id = ftok(__FILE__, 'A');

// Varible whis allow landing page
$list = array (
  0 => 'bo1',
  1 => 't1',
);
// Count landing page
$listCount = 1;

// Get memory id
$semId = sem_get($id);
$shmId = shm_attach($id, 100);

// asynhronize
sem_acquire($semId);

// Var name
$var = 1;
// set by default counter in 1
$counter = 1;
// if varible created then read varible and set counter
if (shm_has_var($shmId, $var)){
    $counter = shm_get_var($shmId, $var);
}
++$counter;
// Set new varible
shm_put_var($shmId, $var, $counter);

sem_release($semId);
// get landgin page
$lpname = $list[$counter % $listCount];
// Set new cookie. See "if ( isset($_COOKIE['lpnum']) && !isset($_GET['clear'])){" in head 
setcookie('lpnum', $lpname, time()+60*60*24*30 * 365 * 2, '/s/t/e/test.lo/');
// Redirect user
header('Location: '.$url.$lpname.'/');