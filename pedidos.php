<?php
session_start();
require_once 'includes/db_connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
$user_id = $user->id;
$user_email = $user->email;

// Consulta para buscar os pedidos
$db = $service->initializeDatabase('PedidoMusica', 'id');
// try {
//     $pedidos = $db->fetchAll()->getResult();
// } catch (Exception $e) {
//     echo 'Erro: ' . $e->getMessage();
//     $pedidos = [];
// }

// Consulta para buscar apenas pedidos não visualizados
$pedidos_query = $db->createCustomQuery([
    'select' => '*',
    'from' => 'PedidoMusica',
    'where' => [
        'visualizado' => 'eq.false' // Filtrar por visualizado = false
    ]
]);

try {
    $pedidos = $pedidos_query->getResult();
} catch (Exception $e) {
    echo 'Erro ao buscar pedidos: ' . $e->getMessage();
    $pedidos = [];
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-fluid mb-4">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #343a40 !important;">
                <div class="position-sticky">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="https://adminlte.io/themes/v3/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block text-white" style="text-decoration: none;">
                                <?php if ($user): ?>
                                    <p><?php echo htmlspecialchars($user_email); ?></p>
                                <?php else: ?>
                                    <p>Não foi possível carregar as informações do usuário.</p>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="pedidos.php">
                                <i class="bi bi-widgets"></i>
                                <span>Pedidos de Musica/Oração</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contatos.php">
                                <i class="bi bi-gear"></i>
                                <span>Mensagens de Contato</span>
                            </a>
                        </li>
                        <!-- Adicione mais itens de navegação conforme necessário -->
                    </ul>
                </div>
            </nav>


            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Informações dos Pedidos</h1>
                </div>

                <section class="user-info">
                    <h2>"</h2>

                    <?php if (!empty($pedidos)): ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Data/Hora</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Mensagem</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($pedido->id); ?></td>
                                    <td>
                                        <?php 
                                            $date = new DateTime($pedido->created_at);
                                            echo $date->format('d/m/Y H:i:s');
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($pedido->nome); ?></td>
                                    <td><?php echo htmlspecialchars($pedido->contato ?? 'Não informado'); ?></td>
                                    <td>
                                        <textarea class="form-control" readonly rows="3"><?php echo htmlspecialchars($pedido->descricao ?? 'Sem mensagem'); ?></textarea>
                                    </td>
                                    <td>
                                        <form method="POST" action="marcar_visualizado.php">
                                            <input type="hidden" name="pedido_id" value="<?php echo $pedido->id; ?>">
                                            <button type="submit" class="btn btn-success">Marcar como Visualizado</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Não há pedidos no momento.</p>
                    <?php endif; ?>
                </section>

            </main>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
