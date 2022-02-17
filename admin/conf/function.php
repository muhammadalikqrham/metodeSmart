<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect('localhost', 'root', '', 'db_smart') or die("koneksi ke database gagal");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function tambahKriteria($data)
{
    global $conn;
    // var_dump($data);
    // exit;
    $nama = htmlspecialchars($data['nama_bibit']);
    $ph_tanah = htmlspecialchars($data['ph_tanah']);
    $usia = htmlspecialchars($data['usia']);
    $batang = htmlspecialchars($data['batang']);
    $tekstur_tanah = htmlspecialchars($data['tekstur_tanah']);
    $pupuk = htmlspecialchars($data['pupuk']);

    $query = "INSERT INTO tb_alternatif VALUES('','$nama',$ph_tanah,'$tekstur_tanah',$usia,'$batang','$pupuk')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapusAlternatif($id)
{
    global $conn;
    $query = 'DELETE FROM tb_alternatif WHERE id_alternatif = ' . $id;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahAlternatif($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama_bibit']);
    $ph_tanah = htmlspecialchars($data['ph_tanah']);
    $usia = htmlspecialchars($data['usia']);
    $batang = htmlspecialchars($data['batang']);
    $tekstur_tanah = htmlspecialchars($data['tekstur_tanah']);
    $pupuk = htmlspecialchars($data['pupuk']);

    $query = 'UPDATE tb_alternatif SET nama_alternatif = "' . $nama . '", ph_tanah = "' . $ph_tanah . '", Tekstur_tanah = "' . $tekstur_tanah . '", usia = "' . $usia . '",batang = "' . $batang . '", pupuk = "' . $pupuk . '" WHERE id_alternatif = ' . $id;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function tambahUser($data)
{
    global $conn;
    $email = htmlspecialchars($data['email']);
    $nama = htmlspecialchars($data['nama']);
    $password = htmlspecialchars($data['password']);
    $password = md5($password);
    $query = "INSERT INTO tb_user VALUES('','$email','$nama','$password')";
    // var_dump($query);
    // exit;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function cekLogin($data)
{
    global $conn;
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $password = md5($password);

    $query = "SELECT * FROM tb_user WHERE email = '$email' AND password ='$password'";

    $row = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($row);
    if (!empty($result)) {

        $_SESSION["name"] = $result['nama'];
        // var_dump($_SESSION['name']);
        // exit;
        return count($result);
    } else {
        return 0;
    }
}
function ubahKriteria($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama_bobot = htmlspecialchars($data['nama_bobot']);
    $nilai_bobot = htmlspecialchars($data['nilai_bobot']);

    $query = "UPDATE tb_bobotkriteria SET nama_bobot = '$nama_bobot', nilai_bobot = '$nilai_bobot' WHERE id_bobot = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
