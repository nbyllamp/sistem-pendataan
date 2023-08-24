<?php 
$conn = mysqli_connect("localhost", "root", "", "db_tatabusana");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $merk = htmlspecialchars($data["merk"]);
    $kondisi_barang = htmlspecialchars($data["kondisi_barang"]);

    $query = "INSERT INTO tb_alattb
                VALUES
                ('', '$nama_barang', '$jumlah', '$merk', '$kondisi_barang')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_alattb WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $merk = htmlspecialchars($data["merk"]);
    $kondisi_barang = htmlspecialchars($data["kondisi_barang"]);

    $query = "UPDATE tb_alattb SET
                jumlah = '$jumlah',
                nama_barang = '$nama_barang',
                merk = '$merk',
                kondisi_barang = '$kondisi_barang'
            WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM tb_alattb
                WHERE
            nama_barang LIKE  '%$keyword%' OR
            jumlah LIKE '%$keyword%' OR
            kondisi_barang LIKE '%$keyword%' OR
            merk LIKE '%$keyword%' 
            ";
    
    return query($query);
}
?>