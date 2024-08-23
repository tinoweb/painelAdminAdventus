<?php
// Iniciar a sessão
session_start();

// Verificar se uma sessão está ativa
if (isset($_SESSION['user'])) {
    // Destruir a sessão
    session_destroy();

    // Redirecionar para a página de login
    header('Location: index.php');
    exit;
} else {
    // Se não houver uma sessão ativa, redirecionar para a página de login
    header('Location: index.php');
    exit;
}
