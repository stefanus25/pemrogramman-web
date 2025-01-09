<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'database.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $query = "DELETE FROM mahasiswa WHERE id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $data->id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Data berhasil dihapus."]);
    } else {
        echo json_encode(["message" => "Gagal menghapus data."]);
    }
} else {
    echo json_encode(["message" => "ID tidak ditemukan."]);
}
?>
