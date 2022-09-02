<?php
session_start();
session_unset();
session_destroy();

// 홈 화면으로
header("Location: index.php");