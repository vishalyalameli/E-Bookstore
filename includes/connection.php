<?php

$link = mysqli_connect("localhost", "root", "", "bms");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
