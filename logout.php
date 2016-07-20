<?php
require 'core/init.php';
session_destroy();
header('Location: '.$referer);

?>