<pre>
    <?php
// Check whether client is allowed to trigger an update
    $allowed_ips = array(
        '207.97.227.', '50.57.128.', '108.171.174.', '50.57.231.', '204.232.175.', '192.30.252.', // GitHub
        '195.37.139.', '193.174.' // VZG
    );
    $allowed = false;
    $headers = apache_request_headers();
    if (@$headers["X-Forwarded-For"]) {
        $ips = explode(",", $headers["X-Forwarded-For"]);
        $ip = $ips[0];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    foreach ($allowed_ips as $allow) {
        if (stripos($ip, $allow) !== false) {
            $allowed = true;
            break;
        }
    }
    if (!$allowed) {
        echo "<span style=\"color: #ff0000\">Sorry, no hamster - better convince your parents!</span>\n";
    } else {

// Actually run the update
        $commands = array(
            'echo $PWD',
            'whoami',
            'git pull',
        );
        $output = "\n";
        $log = "####### " . date('Y-m-d H:i:s') . " #######\n";
        foreach ($commands AS $command) {
            // Run it
            $tmp = shell_exec("$command 2>&1");
            // Output
            $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
            $output .= htmlentities(trim($tmp)) . "\n";
            $log .= "\$ $command\n" . trim($tmp) . "\n";
        }
        $log .= "\n";
        file_put_contents('deploy-log.txt', $log, FILE_APPEND);
        echo $output;
    }
    ?>
</pre>