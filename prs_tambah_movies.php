<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $nm_random = uniqid().".mp4";
    $tmp = $_FILES['video']['tmp_name'];

    $folder = 'video/'; // folder penyimpanan
    $path = $folder . $nm_random;

    // Pindahkan file ke folder
    if (move_uploaded_file($tmp, $path)) {

        echo "Video berhasil diupload dan disimpan.";
    } else {
        echo "Gagal upload video.";
    }
}

$tempat_gmbr = "movie/";
$nama_random = uniqid().".jpg";
$target_file = $tempat_gmbr . $nama_random;
$syaratUPLD = 1;

// check apakah gambar itu betul gambar atau bukan
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["poster_image"]["tmp_name"]);
  if($check == true) {
    $syaratUPLD = 1;
  } else {
    
    $syaratUPLD = 0;
  }
}



// Check apakah $syaratUPLD ada 0 nya
if ($syaratUPLD == 0) {
// jika semua ok, lanjut upload filenya
} else {
  if (move_uploaded_file($_FILES["poster_image"]["tmp_name"], $target_file)) {
    
    echo "The file ". htmlspecialchars( basename( $_FILES["poster_image"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

if($syaratUPLD !== 0){
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];

    $duration = $_POST['duration'];
    

    $max_tayang = $_POST['max_tayang'];

    $sql = "INSERT INTO movies (title,genre,description,release_date,duration,poster_image,max_tayang,video_path) VALUES ('$title','$genre','$description','$release_date','$duration','$nama_random','$max_tayang','$nm_random')";
    $query = mysqli_query($koneksi,$sql);

    if ($query){
      
      header("location:admin_azfa.php?tambah_movies=sukses");
        
    }
}else{
  echo "Tidak bisa menambahkan gambar";
    echo "<br>";
    echo "$gabungan";
    echo "<a href='admin_azfa.php'><button>kembali</button></a>";
}

?>