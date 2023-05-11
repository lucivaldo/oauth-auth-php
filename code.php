<?php
  $oauth_base_url = getenv("OAUTH_BASE_URL");
  $client_id = getenv("OAUTH_CLIENT_ID");
  $client_secret = getenv("OAUTH_CLIENT_SECRET");
  $code = $_GET['code'];
  $grant_type = "authorization_code";
  $redirect_uri = getenv("OAUTH_REDIRECT_URI");

  $payload = http_build_query([
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "code" => $code,
    "grant_type" => $grant_type,
    "redirect_uri" => $redirect_uri,
  ]);

  $opts_token = [
    "http" => [
      "method" => "POST",
      "header" => "Content-type: application/x-www-form-urlencoded; Accept: application/json;",
      "content" => $payload,
    ],
  ];

  $context_token = stream_context_create($opts_token);
  $result = file_get_contents("{$oauth_base_url}/oauth/token", false, $context_token);
  $token = json_decode($result);

  $access_token = $token->access_token;

  $opts_user = [
    "http" => [
      "method" => "GET",
      "header" => "Authorization: Bearer {$access_token}"
    ],
  ];

  $context_user = stream_context_create($opts_user);

  $user_response = file_get_contents("{$oauth_base_url}/api/v1/me", false, $context_user);

  $_SESSION["user"] = $user_response;

  header("Location: /");
  die();
?>
