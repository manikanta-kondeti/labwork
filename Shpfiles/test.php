<?php
$file = './../home';
$newfile = '/var/www';

if (!copy($file, $newfile)) {
    echo "failed to copy $file...\n";
}
?>
