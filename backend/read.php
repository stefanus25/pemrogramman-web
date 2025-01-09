<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'database.php';

$query = "SELECT *,
    (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) AS nilaiAkhir,
    CASE
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) BETWEEN 81 AND 100 THEN 'A'
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) BETWEEN 61 AND 80 THEN 'B'
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) BETWEEN 41 AND 60 THEN 'C'
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) BETWEEN 21 AND 40 THEN 'D'
        ELSE 'E'
    END AS grade,
    CASE
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) >= 61 THEN 'Lulus'
        WHEN (0.35 * nilaiUTS + 0.45 * nilaiUAS + 0.2 * nilaiPraktikum) BETWEEN 41 AND 60 THEN 'Harus Mengikuti UM'
        ELSE 'Tidak Lulus dan Wajib Mengulang'
    END AS status
FROM mahasiswa";

$stmt = $conn->prepare($query);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>
