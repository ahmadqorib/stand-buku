<?php
    include'confiq/koneksi.php';

    $term = $_GET['term'];
    // buat database dan table provinsi
    $query = "SELECT * FROM bazzar_buku WHERE judul_buku LIKE '%$term%' LIMIT 10";
    $result = mysqli_query($kon, $query);
    while ($row = mysqli_fetch_array($result))
    {
        $data[] = array('id'=>$row['id_buku'],'label'=>$row['judul_buku'],'value'=>$row['judul_buku']);
    }
    echo json_encode($data);