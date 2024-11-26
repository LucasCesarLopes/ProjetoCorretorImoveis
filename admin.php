<?php
// Definir usuário e senha predefinidos
define('USERNAME', 'admin');
define('PASSWORD', 'admin123');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se os dados são corretos
    if ($username === USERNAME && $password === PASSWORD) {
        // Redireciona para a página do corretor
        header('Location: corretor.html');
        exit();
    } else {
        echo "<script>alert('Usuário ou senha incorretos.'); window.location.href = 'admin.html';</script>";
    }
}
?>
