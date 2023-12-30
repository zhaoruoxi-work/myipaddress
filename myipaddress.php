<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What is My IP Address</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            margin: 10px 0;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>
<body>

<?php
function get_client_ip() {
    $ip_address = '';

    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip_address = 'UNKNOWN';
    }

    return $ip_address;
}

$api_url = 'http://www.inte.net/tool/ip/api.ashx?ip=' . get_client_ip() . '&datatype=json&key=12';
$response = @file_get_contents($api_url); // Use @ to suppress warnings
$data = json_decode($response, true);

if ($data && isset($data['ret']) && $data['ret'] === 'ok') {
    $location = implode(', ', $data['data']);
    echo "<h1>What is My IP Address</h1>";
    echo "<p>Your IP address: " . get_client_ip() . "</p>";
    echo "<p>Location: " . $location . "</p>";
} else {
    echo "<div class='error'>Unable to retrieve location information.</div>";
}
?>

</body>
</html>
