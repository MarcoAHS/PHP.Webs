<?php 
    require 'includes/config/database.php';
    $db = conectarDB();

    $email = "marco@outlook.com";
    $password = "123456";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    var_dump($passwordHash);

    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

    // mysqli_query($db, $query);
?>