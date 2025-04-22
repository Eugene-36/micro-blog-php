<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>MicroBlog Main</title>
		<link rel="stylesheet" href="<?= HOST ?>feeds/micro-blog/assets/css/main.css" />
		<link rel="stylesheet" href="<?= HOST ?>feeds/micro-blog/assets/css/addon.css" />
		<link rel="icon" type="image/x-icon" href="<?= HOST ?>feeds/micro-blog/assets/img/favicons/favicon.svg" />
		<link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon.png" />
	</head>

	<?php 
	  $className = "";
		if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark'){
			 $className .= 'dark';
		}
	 ?>
<body class="<?= $className ?>">
