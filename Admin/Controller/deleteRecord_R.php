<?php

//세션 시작
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminLogin.php");
    exit();
}


include '../../Config/connect.php';

// POST로 전달된 id 값 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // 삭제 쿼리 실행
    $sql = "DELETE FROM 정기방문자 WHERE 정기방문자ID = ?";
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
header("Location: ../adminRoutine.php"); // 이전 페이지로 리디렉션
exit();

?>
