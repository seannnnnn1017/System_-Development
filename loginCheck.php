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

// ���J���K�X�i�� SHA1 �[�K
$hashed_password = sha1($_pw);

// �ϥιw�ƻy�y�ǳƬd��
$stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ? AND Password = ?");
$stmt->bind_param("ss", $_id, $hashed_password);
$stmt->execute();

// ����d�ߵ��G
$result = $stmt->get_result();

//�ˬd�O�_���ǰt���b���P�K�X
if ($result->num_rows == 1) {
    //�n�J���\�A�ɦV�D����
    header("Location: main.php?id=" . $_id, true, 301);
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
