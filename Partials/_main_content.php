<?php
$url = $_SERVER['REQUEST_URI'];
$host = $_SERVER['DOCUMENT_ROOT'];
if($url == '/gallery.php') include($host.'/Partials/Handlers/_gallery_page_handler.php');
if($url == '/links.php') include($host.'/Partials/Handlers/_links_handler.php');
if($url == '/') include($host.'/Partials/Handlers/_home_page_handler.php');
