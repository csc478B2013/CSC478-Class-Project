<?php

session_start();

session_destroy();

echo "You're logged out! <a href='test_login.php'>Click</a> here to return to login page.";

?>
