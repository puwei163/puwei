<?php
header ( 'Content-Type: text/html;charset=utf-8' );
echo '<pre>';
$srt="品牌LOGO@file";
$str = "状态@radio|1=是&0=否";

preg_match('/(.*)@([a-z]*)\|?(.*)/',$srt,$com);
var_dump($com);



