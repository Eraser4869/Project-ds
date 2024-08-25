<?php

//connect.php 파일 읽어오기
include_once("../../Config/connect.php");

// 폼의 연락처 데이터 읽어오기
$연락처 = isset($_POST['연락처']) ? $_POST['연락처'] : '';

// 연락처가 테이블에 존재하는지 확인
// prepare와 bind_param을 사용하여 SQL 인젝션 공격 방지
// 방문시간을 기준으로 가장 최신의 데이터를 참조
$sql = "SELECT * FROM 일일방명록 WHERE 연락처 = ? ORDER BY 입교시간 DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $연락처);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 연락처가 기존의 데이터 베이스에 존재하면 데이터를 복사하여 마지막에 삽입
    $row = $result->fetch_assoc();
    $이름 = $row['이름'];
    $소속직위 = $row['소속직위'];
    $성별 = $row['성별'];
    $생년월일 = $row['생년월일'];
    $방문목적 = $row['방문목적'];
    $차량번호 = $row['차량번호'];

    $insert_sql = "INSERT INTO 일일방명록 (이름, 소속직위, 성별, 생년월일, 연락처, 방문목적, 차량번호) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sssssss", $이름, $소속직위, $성별, $생년월일, $연락처, $방문목적, $차량번호);

    if ($insert_stmt->execute()) {
        echo '<script type="text/javascript">
        window.location = "../ibgdFin.html";
        </script>';
    } else {
        echo '<script type="text/javascript">
        alert("등록 실패: ' . $insert_stmt->error . '");
        window.history.back();
        </script>';
    }
} else {
    echo '<script type="text/javascript">
    alert("재방문 대상자의 연락처를 찾을 수 없음.");
    window.history.back();
    </script>';
}

// 연결 종료
$stmt->close();
$insert_stmt->close();
$conn->close();

?>