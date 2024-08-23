<?php
// Configurações de ambiente
define('ENVIRONMENT', 'development'); // ou 'production'

// Configurações de exibição de erros
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Configurações de fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Configurações de sessão
ini_set('session.cookie_lifetime', 3600); // 1 hora
ini_set('session.gc_maxlifetime', 3600); // 1 hora

// Outras configurações específicas do aplicativo
define('APP_NAME', 'Painel Admin');
define('APP_VERSION', '1.0.0');

// Configurações de URL base
define('BASE_URL', 'http://seudominio.com/admin/');

// Configurações de upload
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Você pode adicionar mais configurações conforme necessário