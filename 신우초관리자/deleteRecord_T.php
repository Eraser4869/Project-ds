<?php
// 데이터베이스 연결 포함
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼 데이터에서 ID 교직원 차량 읽기
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Prepared statement 사용
        $stmt = $conn->prepare("DELETE FROM 교직원차량 WHERE `ID 교직원차량` = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                alert("레코드 삭제 성공");
                window.location = "adminteacher.html"
                </script>';
        } else {
            echo '<script type="text/javascript">
                alert("등록 실패: ' . $stmt->error . '");
                window.location = "adminteacher.html"
                </script>';
        }

        $stmt->close();
    } else {
        echo "유효하지 않은 ID입니다.";
    }

    $conn->close();
} else {
    echo "올바른 요청이 아닙니다.";
}
?>