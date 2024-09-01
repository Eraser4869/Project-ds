<?php


// connect.php 파일 읽어오기
include_once("../../Config/connect.php");

// 입력값 읽어오기 및 필터링
$이름 = isset($_POST['이름']) ? trim($_POST['이름']) : '';
$소속직위 = isset($_POST['소속직위']) ? trim($_POST['소속직위']) : '';
$성별 = isset($_POST['성별']) ? trim($_POST['성별']) : '';
$생년월일 = isset($_POST['생년월일']) ? trim($_POST['생년월일']) : '';  // 날짜 형식 검증 필요
$연락처 = isset($_POST['연락처']) ? trim($_POST['연락처']) : '';
$방문목적 = isset($_POST['방문목적']) ? trim($_POST['방문목적']) : '';
$차량번호 = isset($_POST['차량번호']) ? trim($_POST['차량번호']) : '';

// SQL 인젝션 방지 위한 Prepared Statement 사용
$sql = "INSERT INTO 일일방명록 (이름, 소속직위, 성별, 생년월일, 연락처, 방문목적, 차량번호) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// 바인딩 변수
$stmt->bind_param("sssssss", $이름, $소속직위, $성별, $생년월일, $연락처, $방문목적, $차량번호);

// 쿼리 실행 및 결과 처리
if($stmt->execute()) {
    echo '<script type="text/javascript">
    window.location="../ibgdFin.html";
    </script>';
} else {
    // 오류 로그 작성 (실제 애플리케이션에서는 파일 또는 시스템 로그로 기록하는 것이 좋습니다)
    error_log("Error inserting data: " . $stmt->error);
    echo '<script type="text/javascript">
    alert("등록 실패. 다시 시도해 주세요.");
    window.location="../ibgdFin.html";
    </script>';
}

// 자원 정리
$stmt->close();
$conn->close();
exit();

?>