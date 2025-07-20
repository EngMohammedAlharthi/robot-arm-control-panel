<?php
include 'con.php';

$res = $conn->query(
    "SELECT * FROM poses WHERE status=1 ORDER BY id LIMIT 1"
);

if ($row = $res->fetch_assoc()) {
    header('Content-Type: application/json');
    echo json_encode($row);
}
