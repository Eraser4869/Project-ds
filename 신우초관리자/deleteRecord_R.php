<?php
include 'connect.php';

// POST로 전달된 id 값 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // 삭제 쿼리 실행
    $sql = "DELETE FROM 정기방문자 WHERE `ID 정기방문자` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

// 연결 종료
$conn->close();

// 삭제 후 리디렉션
header("Location: adminroutine.php"); // 이전 페이지로 리디렉션
exit();
?>
