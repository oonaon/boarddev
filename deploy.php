<pre>
<?php
// Actually run the update
$commands = array(
	'echo $PWD',
	'whoami',
	'git pull',
);
$output = "\n";
$log = "####### ".date('Y-m-d H:i:s'). " #######\n";
foreach($commands AS $command){
    // Run it
    $tmp = shell_exec("$command 2>&1");
    // Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
    $log  .= "\$ $command\n".trim($tmp)."\n";
}
$log .= "\n";
file_put_contents ('deploy-log.txt',$log,FILE_APPEND);
echo $output; 
?>
</pre>