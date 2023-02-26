<?php
session_start();
session_destroy();
// Redirect to the login page:
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>