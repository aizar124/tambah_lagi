<?php
include "koneksi.php";
session_start();
session_unset();
session_destroy();
header("location:home.php?logout=sukses");
exit;

?>