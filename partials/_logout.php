<?php
session_start();

session_unset();
session_destroy();
header("Location: /web/index.php?loggedout");
exit();
?>