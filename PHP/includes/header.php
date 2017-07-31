<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="keywords" content="<?=$pageKeywords?>" />
    <?=isset($pageDescription)?'<meta name="description" content="'.$pageDescription.'" />':''?>
	<title><?=$pageTitle?>: <?=$siteTitle?></title>
	<link rel=" shortcut icon" type="image/ico" href="/favicon.ico?v=1" />
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="header">
    	<a accesskey="h" href="/" title="Home"><img src="" alt="Logo" /></a>
    </div>