<?php
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    if (file_exists("$p.php")) {
        include "$p.php";
    } else {
        echo "<h3 align='center'> Halaman tidak ditemukan!</h3>";
    }
} else {
    include "ideas.php";
}
