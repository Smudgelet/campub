<?php
session_start();
ini_get();
echo 'Hello World';
echo $_SESSION['user_id'];