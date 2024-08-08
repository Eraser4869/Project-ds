<?php
// 데이터베이스 연결 포함
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼 데이터에서 ID 정기방문자 읽기
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Prepared statement 사용
        $stmt = $conn->prepare("DELETE FROM 정기방문자 WHERE `ID 정기방문자` = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                alert("레코드 삭제 성공");
                window.location = "adminroutine.html"
                </script>';
        } else {
            echo '<script type="text/javascript">
                alert("등록 실패: ' . $stmt->error . '");
                window.location = "adminroutine.html"
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