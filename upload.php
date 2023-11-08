<?php
declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["file_name"]) || empty($_FILES["content"]["name"])) {
        header("Location: index.html");
        exit;
    } else {
        $file_name = $_POST["file_name"];
        $file_tmp_name = $_FILES["content"]["tmp_name"];
        $file_size = $_FILES["content"]["size"];
        $upload_dir = "upload/";
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $destination = $upload_dir . $file_name . "_" . $_FILES["content"]["name"];
        
        if (move_uploaded_file($file_tmp_name, $destination)) {
            echo "Файл успешно загружен. Путь: " . $destination . "<br>";
            echo "Размер файла: " . $file_size . " байт";
        } else {
            echo "Произошла ошибка при загрузке файла.";
        }
    }
} else {
    header("Location: index.html");
    exit;
}

