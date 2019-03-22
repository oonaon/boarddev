<?php
echo "RUN ";

print("<pre>" . execPrint("cd /home/boarddev/public_html/") . "</pre>");
print("<pre>" . execPrint("git pull") . "</pre>");

echo " END";




function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "\n");
    }
}
?>