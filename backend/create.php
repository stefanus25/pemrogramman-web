<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'database.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->nama) && isset($data->mataKuliah) &&
    isset($data->nilaiUTS) && isset($data->nilaiUAS) && isset($data->nilaiPraktikum)
) {
    $query = "INSERT INTO mahasiswa (nama, mataKuliah, nilaiUTS, nilaiUAS, nilaiPraktikum) VALUES (:nama, :mataKuliah, :nilaiUTS, :nilaiUAS, :nilaiPraktikum)";
    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":nama", $data->nama);
    $stmt->bindParam(":mataKuliah", $data->mataKuliah);
    $stmt->bindParam(":nilaiUTS", $data->nilaiUTS);
    $stmt->bindParam(":nilaiUAS", $data->nilaiUAS);
    $stmt->bindParam(":nilaiPraktikum", $data->nilaiPraktikum);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Data berhasil disimpan."]);
    } else {
        echo json_encode(["message" => "Gagal menyimpan data."]);
    }
} else {
    echo json_encode(["message" => "Data tidak lengkap."]);
}
?>