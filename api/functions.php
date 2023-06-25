<?php

/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function haversineGreatCircleDistance(
  $latitudeFrom,
  $longitudeFrom,
  $latitudeTo,
  $longitudeTo,
  $earthRadius = 6371000
) {
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

function send_email_with_attachments($to, $subject, $message, $attachments = [])
{
  // Boundary string for MIME message
  $boundary = md5(time());

  // Headers for MIME message
  // $headers = "From: $from\r\n";
  // $headers .= "Reply-To: $replay\r\n";
  // $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

  // Combine message with attachments
  $body = "--$boundary\r\n";
  $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
  $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
  $body .= $message . "\r\n\r\n";

  // Loop through attachments and add to message
  foreach ($attachments as $attachment_path) {
    // Read attachment file
    $file_content = file_get_contents($attachment_path);

    // Get file extension of attachment
    $extension = pathinfo($attachment_path, PATHINFO_EXTENSION);

    // Determine MIME type of attachment based on its file extension
    $mime_type = mime_content_type($attachment_path);

    // Encode attachment file content in base64
    $attachment_content = chunk_split(base64_encode($file_content));

    // Attachment headers
    $attachment_headers = "--$boundary\r\n";
    $attachment_headers .= "Content-Type: $mime_type; name=\"" . basename($attachment_path) . "\"\r\n";
    $attachment_headers .= "Content-Transfer-Encoding: base64\r\n";
    $attachment_headers .= "Content-Disposition: attachment; filename=\"" . basename($attachment_path) . "\"\r\n\r\n";

    // Combine attachment headers and content
    $attachment = $attachment_headers . $attachment_content . "\r\n";

    // Add attachment to message
    $body .= $attachment;
  }

  // Send email
  return mail($to, $subject, $body, $headers);
}