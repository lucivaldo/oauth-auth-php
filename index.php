<?php
  session_start();
  
  if (isset($_SERVER['PATH_INFO'])
    && $_SERVER['PATH_INFO'] == '/auth/callback'
    && isset($_GET['code'])
    && $_GET['code'] != ''
  ) {
    include "code.php";
    die();
  }

  if (!isset($_SESSION['user'])) {
    $oauth_base_url = getenv("OAUTH_BASE_URL");
    $client_id = getenv("OAUTH_CLIENT_ID");
    $redirect_uri = getenv("OAUTH_REDIRECT_URI");
    $response_type = "code";

    $url = "{$oauth_base_url}/oauth/authorize?client_id={$client_id}&redirect_uri={$redirect_uri}&response_type={$response_type}";

    header("Location: {$url}");
    die();
  }

  include "signed.php";
?>
