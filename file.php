<?php
session_start();

$image = $_GET["image"];
$path = "uploads/".$image;

header('Content-Type: image/jpeg');
include($path);