<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'database.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->id) && isset($data->nama) && isset($data->mataKuliah) &&
    isset($data->nilaiUTS) && isset($data->nilaiUAS) && isset($data->nilaiPraktikum)
) {
    $query = "UPDATE mahasiswa SET nama = :nama, mataKuliah = :mataKuliah, nilaiUTS = :nilaiUTS, nilaiUAS = :nilaiUAS, nilaiPraktikum = :nilaiPraktikum WHERE id = :id";
    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $data->id);
    $stmt->bindParam(":nama", $data->nama);
    $stmt->bindParam(":mataKuliah", $data->mataKuliah);
    $stmt->bindParam(":nilaiUTS", $data->nilaiUTS);
    $stmt->bindParam(":nilaiUAS", $data->nilaiUAS);
    $stmt->bindParam(":nilaiPraktikum", $data->nilaiPraktikum);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Data berhasil diperbarui."]);
    } else {
        echo json_encode(["message" => "Gagal memperbarui data."]);
    }
} else {
    echo json_encode(["message" => "Data tidak lengkap."]);
}
?>