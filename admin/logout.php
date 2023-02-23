<?php
session_start();
unset($_SESSION['_token']);
unset($_SESSION['admin_id']);
header("Location:./");
