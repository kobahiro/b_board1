<?php

function getDb(){
    $dsn = 'mysql:dbname=b_board; host=127.0.0.1';
    $usr ='guest';
    $passwd='guest';

    try{
        //DB接続管理
        $db = new PDO($dsn, $usr, $passwd);
        //エラーの通知方法：例外を発生
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->exec('SET NAMES utf8');

    //DB接続error
    }catch(PDOException $e){
        die("error:{$e->getMessage()}");
    }
    return $db;
}