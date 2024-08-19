<?php

$targetFolder = '../storage/app/public';
$linkFolder = '../public/storage';
symlink($targetFolder,$linkFolder);
header('Location: /home');

?>