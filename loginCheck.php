<?php
// �إ߻P MySQL ��Ʈw���s��
$servername = "localhost";
$username = "op23756778";
$password = "Sean23756778";
$dbname = "op23756778";

$conn = new mysqli($servername, $username, $password, $dbname);

// �ˬd�s���O�_���\
if ($conn->connect_error) {
    die("�s�����ѡG" . $conn->connect_error);
}

// ��� POST ���
$_id = $_POST["id"];
$_pw = $_POST["pw"];

if (strcmp($_id, "Sean") == 0 && strcmp($_pw, '23756778') == 0) {
    header("Locationindex.php?id=" . $_id",true,301);
    exit();
} else {
    // �n�J����
    echo "<h1>ERROR</h1>";
        // �d�ߩҦ��b��
    $allUsers = $conn->query("SELECT UserName FROM account");
    if ($allUsers->num_rows > 0) {
        while ($row = $allUsers->fetch_assoc()) {
            echo $row["UserName"] . $row["password"] ."<br>";
            echo "your entry:" . $_id ."Password". $hashed_password;
        }
    }
}

// ������Ʈw�s��
$stmt->close();
$conn->close();
?>
