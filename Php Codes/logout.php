<?php

session_destroy();
unset($_SESSION);

header("location:index.php");
?>

