<?php

$Module = array( 'name' => 'trends' );

$ViewList = array();

$ViewList['dashboard'] = array(
	'functions'=>array('read'), 
	'script'	=> 'dashboard.php',
    'default_navigation_part' => 'googlenavigationpart'
);

$ViewList['hottrends'] = array(
	'functions'=>array('read'), 
	'script'	=> 'hottrends.php',
    'default_navigation_part' => 'googlenavigationpart',
);

$ViewList['topcharts'] = array(
	'functions'=>array('read'), 
	'script'	=> 'topcharts.php',
    'default_navigation_part' => 'googlenavigationpart',
);

$ViewList['fetchComponent'] = array(
	'functions'=>array('read'), 
	'script'	=> 'fetchcomponent.php',
    'default_navigation_part' => 'googlenavigationpart',
);





$FunctionList = array();
$FunctionList['read'] = array();

?>
