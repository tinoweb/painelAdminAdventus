<?php

session_start();
require "includes/db_connect.php";

$auth = $service->createAuth();

// try{
//     $auth->createUserWithEmailAndPassword('tino477@gmail.com', 'tinoweb');
//     $data = $auth->data(); // get the returned data generated by request
//     echo 'User has been created! A confirmation link has been sent to the '. $data->email;
// }
// catch(Exception $e){
//     echo $auth->getError();
// }

// Assuming $service has been set up as per previous steps
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $auth = $service->createAuth();

    try{
        $auth->signInWithEmailAndPassword($email,$password);
        $data = $auth->data();

        if(isset($data->access_token)){
            $userData = $data->user;
            $_SESSION['user'] = $userData;
            $_SESSION['is_admin'] = true;
            header('Location: dashboard.php'); // Redirect to admin dashboard
            
        }else{
            echo "Access denied. Admins only.";
        }
    }
    catch(Exception $e){
        echo $auth->getError();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventus App Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Painel Adminstração App Rádio Adventus</h3>
                <div class="card mt-5">
                    <div class="card-header">Login Admin</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-50">Entrar</button>
                        </form>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>