<?php
/**
 * Created by PhpStorm.
 * User: kobahiro
 * Date: 2017/01/10
 * Time: 17:28
 */

function e($str, $charset = 'UTF-8'){
    return htmlspecialchars($str, ENT_QUOTES, $charset);
}
