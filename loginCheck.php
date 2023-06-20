<?php
session_start();
// 建立與 MySQL 資料庫的連接
$servername = "localhost";
$username = "op23756778";
$password = "Sean23756778";
$dbname = "op23756778";

$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗：" . $conn->connect_error);
}

// 獲取 POST 資料
$_id = $_POST["id"];
$_pw = $_POST["pw"];
$_pw = sha1($_pw);

// Retrieve the user information from the database
$userQuery = "SELECT UserName, password FROM account WHERE UserName = '".$_id."'";
$userData = $conn->query($userQuery);

if ($userData->num_rows > 0) {
    $row = $userData->fetch_assoc();
    if (strcmp($_pw, $row["password"]) == 0) {
        $_SESSION['user_id'] = $_id;
        header("Location: index.php?id=" . $_id, true, 301);
        exit();
    }
} else {
    // 登入失敗
    echo "<h1>ERROR</h1>";
    // 查詢所有帳號
    $allUsers = $conn->query("SELECT UserName, password FROM account");
    if ($allUsers->num_rows > 0) {
        while ($row = $allUsers->fetch_assoc()) {
            echo $row["UserName"] . $row["password"] . "<br>";
            echo "Your entry: " . $_id . " Password: " . $_pw;
        }
    }
}

// 關閉資料庫連接
$conn->close();
?>
