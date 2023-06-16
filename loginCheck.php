<?php
$_id = $_POST["id"];
$_pw = $_POST["pw"];

if (strcmp($_id, "Sean") == 0 && strcmp($_pw, '23756778') == 0) {
    header("Location:main.php",true,301);
    exit();
} else {
    echo "<h1>ERROR</h1>";
}
