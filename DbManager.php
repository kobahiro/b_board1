<?php
/**
 * Created by PhpStorm.
 * User: kobahiro
 * Date: 2016/12/27
 * Time: 17:36
 */
function getDb(){
    $dsn = 'mysql:dbname=b_board; host=127.0.0.1';
    $usr ='guest';
    $passwd='guest';
    $type = 'charset=utf8';

    try{
        //DB接続管理 文字エンコーディングはutf8
        $db = new PDO($dsn, $usr, $passwd);
        //エラーの通知方法：例外を発生
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->exec('SET NAMES utf8');
        /*$stt = $db->prepare('select * from post');
        $stt->execute();
        while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
            print $row['name'];
        }
        //接続を切断
        $db = NULL;
        */
    //DB接続error
    }catch(PDOException $e){
        die("error:{$e->getMessage()}");
    }
    return $db;
}