<?php
if(!defined('FACILE')) {die('Sorry direct access to this file not allowed');}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=htmlentities($title);?></title>
    <meta name="description" content="<?=htmlentities($meta_description);?>">
    <meta name="keywords" content="<?=htmlentities($meta_keywords);?>">
    <?=link_to_asset('css',['css/styles.css']);?>
</head>
<body>

