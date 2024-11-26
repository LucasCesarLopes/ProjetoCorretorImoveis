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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Preparação da consulta SQL
    $stmt = $conn->prepare("INSERT INTO contatos (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = 'contato.html';</script>";
    } else {
        echo "<script>alert('Erro ao enviar mensagem: " . $stmt->error . "');</script>";
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>
