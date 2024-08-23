<?php
include '../../Config/connect.php';

// POST로 전달된 id 값 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // 삭제 쿼리 실행
    $sql = "DELETE FROM 교직원차량 WHERE `ID 교직원차량` = ?";
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
header("Location: ../adminTeacher.php"); // 이전 페이지로 리디렉션
exit();
?>
