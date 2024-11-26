<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'imoveis';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $cep = $_POST['cep'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $garage = $_POST['garage'];
    $area = $_POST['area'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Processamento das imagens
    $imageNames = [];
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        foreach ($files['name'] as $key => $name) {
            $tmpName = $files['tmp_name'][$key];
            $newName = 'uploads/' . basename($name);
            if (move_uploaded_file($tmpName, $newName)) {
                $imageNames[] = $newName;
            }
        }
    }
    $images = implode(',', $imageNames); // Salva os nomes das imagens como uma string

    // Preparação da consulta SQL
    $stmt = $conn->prepare("INSERT INTO anuncios (title, description, type, price, address, city, state, cep, bedrooms, bathrooms, garage, area, images, name, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdssssiiissss", $title, $description, $type, $price, $address, $city, $state, $cep, $bedrooms, $bathrooms, $garage, $area, $images, $name, $email, $phone);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Anúncio publicado com sucesso!";
    } else {
        echo "Erro ao publicar o anúncio: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>
