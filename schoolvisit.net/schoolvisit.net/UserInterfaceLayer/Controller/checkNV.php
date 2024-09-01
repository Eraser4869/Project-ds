<?php


// connect.php 파일 읽어오기
include_once("../../Config/connect.php");

// 폼의 연락처 데이터 읽어오기 및 필터링
$연락처 = isset($_POST['연락처']) ? trim($_POST['연락처']) : '';

// 연락처 형식 검증 (간단한 예: 숫자와 하이픈만 허용)
if (!preg_match('/^[0-9]+$/', $연락처)) {
    echo '<script type="text/javascript">
    alert("유효한 연락처 형식이 아닙니다.");
    window.history.back();
    </script>';
    exit();
}

// 연락처가 테이블에 존재하는지 확인
$sql = "SELECT * FROM 일일방명록 WHERE 연락처 = ? ORDER BY 입교시간 DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $연락처);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 연락처가 기존의 데이터베이스에 존재하면 데이터를 복사하여 마지막에 삽입
    $row = $result->fetch_assoc();

    // 각 필드에 대해 필터링 및 검증
    $이름 = trim($row['이름']);
    $소속직위 = trim($row['소속직위']);
    $성별 = trim($row['성별']);
    $생년월일 = trim($row['생년월일']); // 날짜 형식 검증 필요
    $방문목적 = trim($row['방문목적']);
    $차량번호 = trim($row['차량번호']);

    // 복사된 데이터를 새로운 레코드로 삽입
    $insert_sql = "INSERT INTO 일일방명록 (이름, 소속직위, 성별, 생년월일, 연락처, 방문목적, 차량번호) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sssssss", $이름, $소속직위, $성별, $생년월일, $연락처, $방문목적, $차량번호);

    if ($insert_stmt->execute()) {
        echo '<script type="text/javascript">
        window.location = "../ibgdFin.html";
        </script>';
    } else {
        // 에러를 사용자에게 표시하지 않고 로그로 기록
        error_log("Error inserting data: " . $insert_stmt->error);
        echo '<script type="text/javascript">
        alert("등록 실패. 다시 시도해 주세요.");
        window.history.back();
        </script>';
    }

    // 자원 정리
    $insert_stmt->close();
} else {
    echo '<script type="text/javascript">
    alert("재방문 대상자의 연락처를 찾을 수 없음.");
    window.history.back();
    </script>';
}

// 연결 종료
$stmt->close();
$conn->close();
exit();


?>