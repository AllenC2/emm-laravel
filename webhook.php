<?php
/**
 * Webhook para auto-despliegue de Laravel EMM
 * Coloca este archivo en una URL accesible desde GitHub
 * Ejemplo: https://imallen.dev/webhook.php
 */

// Configuración
$SECRET_TOKEN = 'tu_token_secreto_aqui'; // Cambia esto por un token seguro
$PROJECT_PATH = '/home/usuario/public_html'; // Ruta a tu proyecto Laravel
$BRANCH = 'main'; // Rama que quieres desplegar
$LOG_FILE = __DIR__ . '/webhook.log';

// Función para logging
function writeLog($message) {
    global $LOG_FILE;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($LOG_FILE, "[$timestamp] $message\n", FILE_APPEND | LOCK_EX);
}

// Verificar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    writeLog('Error: Método no permitido');
    die('Method not allowed');
}

// Verificar headers de GitHub
$githubEvent = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if ($githubEvent !== 'push') {
    writeLog('Info: Evento ignorado: ' . $githubEvent);
    die('Event ignored');
}

// Verificar signature (opcional pero recomendado)
if ($SECRET_TOKEN) {
    $payload = file_get_contents('php://input');
    $expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $SECRET_TOKEN);
    
    if (!hash_equals($expectedSignature, $signature)) {
        http_response_code(401);
        writeLog('Error: Signature inválida');
        die('Invalid signature');
    }
}

// Decodificar payload
$payload = json_decode(file_get_contents('php://input'), true);

if (!$payload) {
    http_response_code(400);
    writeLog('Error: Payload inválido');
    die('Invalid payload');
}

// Verificar rama
if ($payload['ref'] !== "refs/heads/$BRANCH") {
    writeLog('Info: Push a rama ignorada: ' . $payload['ref']);
    die('Branch ignored');
}

writeLog('Info: Iniciando despliegue para commit: ' . $payload['after']);

// Cambiar al directorio del proyecto
if (!chdir($PROJECT_PATH)) {
    writeLog('Error: No se puede acceder al directorio del proyecto');
    die('Cannot access project directory');
}

// Función para ejecutar comandos
function execCommand($command) {
    writeLog("Ejecutando: $command");
    $output = [];
    $returnCode = 0;
    exec($command . ' 2>&1', $output, $returnCode);
    
    $outputStr = implode("\n", $output);
    writeLog("Output: $outputStr");
    
    if ($returnCode !== 0) {
        writeLog("Error: Comando falló con código $returnCode");
        return false;
    }
    
    return true;
}

// Proceso de despliegue
try {
    writeLog('Info: Iniciando proceso de despliegue');
    
    // 1. Hacer backup del .env
    if (file_exists('.env')) {
        $backupName = '.env.backup.' . date('Y-m-d_H-i-s');
        copy('.env', $backupName);
        writeLog("Info: Backup creado: $backupName");
    }
    
    // 2. Actualizar código
    if (!execCommand('git fetch origin')) {
        throw new Exception('Error al hacer fetch');
    }
    
    if (!execCommand("git reset --hard origin/$BRANCH")) {
        throw new Exception('Error al actualizar código');
    }
    
    // 3. Instalar dependencias
    if (!execCommand('composer install --no-dev --optimize-autoloader')) {
        writeLog('Warning: Error al instalar dependencias PHP');
    }
    
    // 4. Compilar assets (si Node.js está disponible)
    if (exec('which npm') !== '') {
        if (!execCommand('npm ci')) {
            writeLog('Warning: Error al instalar dependencias Node');
        } else {
            if (!execCommand('npm run build')) {
                writeLog('Warning: Error al compilar assets');
            }
        }
    } else {
        writeLog('Info: Node.js no disponible, saltando compilación de assets');
    }
    
    // 5. Configurar Laravel
    execCommand('php artisan config:cache');
    execCommand('php artisan route:cache');
    execCommand('php artisan view:cache');
    
    // 6. Ejecutar migraciones
    if (!execCommand('php artisan migrate --force')) {
        writeLog('Warning: Error al ejecutar migraciones');
    }
    
    // 7. Configurar permisos
    execCommand('chmod -R 755 storage bootstrap/cache');
    
    // 8. Crear enlace storage
    if (!file_exists('public/storage')) {
        execCommand('php artisan storage:link');
    }
    
    writeLog('Success: Despliegue completado exitosamente');
    
    // Respuesta exitosa
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Deployment completed successfully',
        'commit' => $payload['after'],
        'timestamp' => date('c')
    ]);
    
} catch (Exception $e) {
    writeLog('Error: ' . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'timestamp' => date('c')
    ]);
}
?>