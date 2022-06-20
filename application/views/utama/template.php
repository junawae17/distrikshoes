<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function path_adm(){
		echo base_url()."assets/LanderApp";
	}
$timezone;
?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?=$title.' | '.$info['title_app']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="<?=base_url().'assets/images/'.$info['favicon_app']?>">

	<!-- Open Sans font from Google CDN -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css"> -->

	<!-- LanderApp's stylesheets -->
	<link href="<?=path_adm()?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=path_adm()?>/css/landerapp.min.css" rel="stylesheet" type="text/css">
	
	<link href="<?=path_adm()?>/css/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="<?=path_adm()?>/css/themes.min.css" rel="stylesheet" type="text/css">
	<link href="<?=path_adm()?>/fonts/animation.css" rel="stylesheet" type="text/css">
</head>
<body class="theme-default main-menu-animated" id="tooltip">

	
<div id="main-wrapper">
test
</div>
<!-- LanderApp's javascripts -->
<script src="<?=path_adm()?>/js/bootstrap.min.js"></script>
<script src="<?=path_adm()?>/js/landerapp.min.js"></script>

<!-- Google Maps -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script> -->

<script type="text/javascript">
</script>
</body>
</html>
