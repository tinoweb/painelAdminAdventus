<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db_connect.php';

// Inclui o cabeçalho da página
include 'header.php';

// Verifica se o usuário está logado (você precisará implementar essa lógica)
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Função para obter todos os usuários
function getAllUsers($conn) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Função para adicionar um novo usuário
function addUser($conn, $username, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    return $stmt->execute();
}

// Lógica para lidar com formulários de adição de usuário, etc.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar o formulário de adição de usuário
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (addUser($conn, $username, $email, $password)) {
            echo "Usuário adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar usuário.";
        }
    }
}

// Obtém todos os usuários
$users = getAllUsers($conn);

// HTML para exibir a lista de usuários e o formulário de adição
?>

<h1>Gerenciamento de Usuários</h1>

<h2>Lista de Usuários</h2>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo htmlspecialchars($user['username']); ?> - <?php echo htmlspecialchars($user['email']); ?></li>
    <?php endforeach; ?>
</ul>

<h2>Adicionar Novo Usuário</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Nome de usuário" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit" name="add_user">Adicionar Usuário</button>
</form>

<?php
// Inclui o rodapé da página
include 'footer.php';
?>