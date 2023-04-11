<?php
$url = $_SERVER['REQUEST_URI'];
$host = $_SERVER['DOCUMENT_ROOT'];

if ($url === '/gallery.php') {
  require($_SERVER['DOCUMENT_ROOT'] . '/Partials/Handlers/_gallery_page_handler.php');
} elseif ($url === '/links.php') {
  require($_SERVER['DOCUMENT_ROOT'] . '/Partials/Handlers/_links_handler.php');
} elseif ($url === '/login.php') {
  require($_SERVER['DOCUMENT_ROOT'] . '/Partials/_login.php');
} elseif ($url === '/index.php') {
  require($_SERVER['DOCUMENT_ROOT'] . '/Partials/Handlers/_home_page_handler.php');
} elseif ($url === '/') {
  require($_SERVER['DOCUMENT_ROOT'] . '/Partials/Handlers/_home_page_handler.php');
} else {
  // Handle unknown requests
  echo "Page not found";
}
