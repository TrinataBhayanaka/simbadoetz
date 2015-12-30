<?php
$filename = 'log_import/import_kib.txt';  //about 500MB
$output = shell_exec('exec tail -n20 ' . $filename);  //only print last 50 lines
echo str_replace(PHP_EOL, '<br />', $output);         //add newlines
?>