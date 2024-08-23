<?php
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido_id = $_POST['pedido_id'];

    // Atualizar o status do pedido para visualizado
    $db = $service->initializeDatabase('Contato', 'id');
    try {
        $update_query = $db->update($pedido_id, ['visualizado' => true]);
        header('Location: contatos.php');
        exit;
    } catch (Exception $e) {
        echo 'Erro ao marcar como visualizado: ' . $e->getMessage();
    }
}
?>
