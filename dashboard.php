<?php
session_start();
require_once 'includes/db_connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
$user_email = $user->email;

// Exemplo de consultas para contar os registros
$total_pedidos_musica = $service->initializeDatabase('PedidoMusica', 'id')->findBy('visualizado', 'false')->getResult();
$total_contatos = $service->initializeDatabase('Contato', 'id')->findBy('visualizado', 'false')->getResult();
$total_pedidos_visualizados = $service->initializeDatabase('PedidoMusica', 'id')->findBy('visualizado', 'true')->getResult();
$total_contatos_atendidos = $service->initializeDatabase('Contato', 'id')->findBy('visualizado', 'true')->getResult();

$total_pedidos_musica_count = count($total_pedidos_musica);
$total_contatos_count = count($total_contatos);
$total_pedidos_visualizados_count = count($total_pedidos_visualizados);
$total_contatos_atendidos_count = count($total_contatos_atendidos);

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

    <div class="container-fluid">
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
                            <a class="nav-link active" href="#">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pedidos.php">
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 container">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- User Information -->
                <section class=" user-info">
                    <h2>Relatórios</h2>
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Pedidos de Música</h5>
                                        <p class="card-text"><?php echo $total_pedidos_musica_count; ?></p>
                                        <a href="pedidos.php" class="btn btn-light">Ver detalhes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Contatos Feitos</h5>
                                        <p class="card-text"><?php echo $total_contatos_count; ?></p>
                                        <a href="contatos.php" class="btn btn-light">Ver detalhes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Pedidos Visualizados</h5>
                                        <p class="card-text"><?php echo $total_pedidos_visualizados_count; ?></p>
                                        <!-- <a href="listar_pedidos_visualizados.php" class="btn btn-light">Ver detalhes</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Contatos Atendidos</h5>
                                        <p class="card-text"><?php echo $total_contatos_atendidos_count; ?></p>
                                        <!-- <a href="listar_contatos_atendidos.php" class="btn btn-light">Ver detalhes</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
