<?php
if(!defined('FACILE')) {die('Sorry direct access to this file not allowed');}

echo get_facile_ascii_art();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=htmlentities($title);?></title>
    <meta name="description" contents="<?=htmlentities($meta_description);?>">
    <meta name="keywords"    contents="<?=htmlentities($meta_keywords);?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="http://sharif.co/favicon.ico">
    <?=link_to_asset('css',['css/styles.css']); ?>
</head>
<body>
<div class="wrapper center-text">