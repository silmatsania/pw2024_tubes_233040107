<?php

session_start();

if($_SESSION['user_id']==null){
    header("Location: login.php?error=Login%20Terlebih%20Dahulu");
}