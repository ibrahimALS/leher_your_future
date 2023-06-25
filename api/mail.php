<?php

if (in_array($_SERVER['REQUEST_METHOD'], ['OPTIONS', 'GET', 'DELETE', 'PUT'])) {
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: *');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Max-Age: 86400');
  print "<h1>Start Mail Service</h1>";
  exit;
}

require(__DIR__ . '/functions.php');

$attachments = [];
$message = "";

foreach ($_POST as $key => $value) {
  $message .= "\n$key: $value\n";
}

foreach ($_FILES as $key => $value) {
  $attachments[] = $value['tmp_name'];
}

$sendto = ["ibrahimgamez@gmail.com", "office@lehreyourfuture.com", $_POST['company_email']];

foreach ($sendto as $key => $to) {
  send_email_with_attachments($to, "Apply for job", $message, $attachments);
}

header('Content-Type: application/json');
print_r(json_encode(['mail' => 'sent']));