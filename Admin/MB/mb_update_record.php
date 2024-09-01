<?php

session_start();

// 로그인 상태 확인
if (!isset($_SESSION['mb_loggedin']) || $_SESSION['mb_loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: mbLogin.php");
    exit();
}


include '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $value = $_POST['value'];

    // 허용된 필드만 업데이트하도록 제한
    $allowed_fields = ['방문증번호', '반납여부'];
    if (in_array($field, $allowed_fields)) {
        // SQL 쿼리 준비 및 실행
        $stmt = $conn->prepare("UPDATE 중간관리자 SET $field = ? WHERE 방문자ID = ?");
        $stmt->bind_param("si", $value, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // 반납여부가 업데이트되면 퇴교시간도 업데이트
        if ($field === '반납여부' && !empty($value)) {
            $stmt = $conn->prepare("UPDATE 중간관리자 SET 퇴교시간 = CURRENT_TIMESTAMP WHERE 방문자ID = ? AND 반납여부 IS NOT NULL");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        
    } else {
        echo "Invalid field";
    }

    $stmt->close();
    $conn->close();
}


?>
