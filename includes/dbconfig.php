<?php
date_default_timezone_set('Asia/Calcutta');
try {
    session_start();
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "final_year_project_2023";
    // $web_socket = "http://192.168.1.2/";
    $web_socket = "http://localhost/";

    $con = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}
