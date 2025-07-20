<?php
$conn = new mysqli('127.0.0.1','root','','robot_arm');
if ($conn->connect_error) die('DB error: '.$conn->connect_error);
