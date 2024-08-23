<?php

include '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $field = $_POST['field'];
    $value = $_POST['value'];

    // 허용된 필드만 업데이트하도록 제한
    $allowed_fields = ['방문증번호', '반납여부'];
    if (in_array($field, $allowed_fields)) {
        // SQL 쿼리 준비 및 실행
        $stmt = $conn->prepare("UPDATE 중간관리자 SET $field = ? WHERE ID방문자 = ?");
        $stmt->bind_param("si", $value, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // 반납여부가 업데이트되면 퇴교시간도 업데이트
        if ($field === '반납여부' && !empty($value)) {
            $stmt = $conn->prepare("UPDATE 중간관리자 SET 퇴교시간 = CURRENT_TIMESTAMP WHERE ID방문자 = ? AND 반납여부 IS NOT NULL");
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
