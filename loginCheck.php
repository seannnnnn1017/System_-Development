<?php
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

if (strcmp($_id, "Sean") == 0 && strcmp($_pw, '23756778') == 0) {
    header("Locationindex.php?id=" . $_id",true,301);
    exit();
} else {
    // 登入失敗
    echo "<h1>ERROR</h1>";
        // 查詢所有帳號
    $allUsers = $conn->query("SELECT UserName FROM account");
    if ($allUsers->num_rows > 0) {
        while ($row = $allUsers->fetch_assoc()) {
            echo $row["UserName"] . $row["password"] ."<br>";
            echo "your entry:" . $_id ."Password". $hashed_password;
        }
    }
}

// 關閉資料庫連接
$stmt->close();
$conn->close();
?>
