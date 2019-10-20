<?php
// SurfEdge - Making Lives Smarter
// www.surfedge.lk - 2019.

// This is used to run few ISYD controllers in a minute basis
// You can use the cron functionality of your server and configure it using cron URL * * * *
// Function Request is used to send the GET request to the contorller (modify if needed)

// Set the Default timezone as Colombo to get accurate timestamps
date_default_timezone_set('Asia/Colombo');

$executionStartTime = microtime(true);
$date = date('m/d/Y H:i:s', time());

// Use the request function to call all the ISYD endpoints
// request( URL , NAME, TIME_TO_RUN_AT - optional );

request('https://sv2.ideamarthosting.dialog.lk/APP_NAME/controller.php', 'onthisday');
request('ANY_URL', 'quote_of_the_day');
request('https://sv2.ideamarthosting.dialog.lk/APP_NAME/controller.php', 'daily_news', '20:00');

request('https://sv2.ideamarthosting.dialog.lk/APP_NAME/controller.php', 'weekly_winners', '20:00','Sun'); // Runs only on sundays at 8PM

// Logging
$executionEndTime = microtime(true);
$seconds = round($executionEndTime - $executionStartTime, 3);
echo "CRON RAN AT $data took $seconds seconds";
flog('cron_access', $date . ' > ' . $seconds);

function request($url, $name, $run_at = null, $has_date = null)
{
    // There might be instance where you want to run an endpoint in a specific point in time of the day
    if($run_at && date('H:i', time()) != $run_at ){
        return;
    }
    // Check if its the day of the week
    if($has_date && date('D') != $has_date){
        return;
    }

    $date = date('m/d/Y H:i:s', time());

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'ISYD Cron',
    ]);
    $resp = curl_exec($curl);

    flog($name . '_access', $date . ' > ' . $resp);

    curl_close($curl);
}

function flog($file_name, $text)
{
    file_put_contents($file_name . '.txt', $text . PHP_EOL, FILE_APPEND | LOCK_EX);
}
