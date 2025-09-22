<?php
// Archivo de diagnóstico para cPanel
// Sube este archivo a la raíz de tu dominio para diagnosticar problemas

echo "<h1>🔍 Diagnóstico Laravel EMM</h1>";
echo "<hr>";

echo "<h2>📂 Información del Servidor</h2>";
echo "<strong>Directorio actual:</strong> " . getcwd() . "<br>";
echo "<strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "<strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "<strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "<br>";
echo "<strong>Versión PHP:</strong> " . phpversion() . "<br>";
echo "<hr>";

echo "<h2>📁 Estructura de Archivos</h2>";
$currentDir = getcwd();
echo "<strong>Archivos en directorio actual ($currentDir):</strong><br>";
$files = scandir($currentDir);
foreach($files as $file) {
    if($file != '.' && $file != '..') {
        $type = is_dir($file) ? '📁' : '📄';
        echo "$type $file<br>";
    }
}
echo "<hr>";

echo "<h2>🔧 Verificaciones Laravel</h2>";

// Verificar si existe index.php de Laravel
if(file_exists('index.php')) {
    echo "✅ index.php encontrado<br>";
    
    // Verificar si es el index.php de Laravel
    $indexContent = file_get_contents('index.php');
    if(strpos($indexContent, 'Laravel') !== false || strpos($indexContent, 'bootstrap/app.php') !== false) {
        echo "✅ Es el index.php de Laravel<br>";
    } else {
        echo "❌ index.php NO es de Laravel<br>";
    }
} else {
    echo "❌ index.php NO encontrado<br>";
}

// Verificar .htaccess
if(file_exists('.htaccess')) {
    echo "✅ .htaccess encontrado<br>";
    
    $htaccessContent = file_get_contents('.htaccess');
    if(strpos($htaccessContent, 'RewriteEngine On') !== false) {
        echo "✅ .htaccess contiene reglas de rewrite<br>";
    } else {
        echo "⚠️ .htaccess sin reglas de rewrite<br>";
    }
} else {
    echo "❌ .htaccess NO encontrado<br>";
}

// Verificar directorio vendor
if(is_dir('../vendor')) {
    echo "✅ Directorio vendor encontrado (en nivel superior)<br>";
} elseif(is_dir('vendor')) {
    echo "✅ Directorio vendor encontrado (en directorio actual)<br>";
} else {
    echo "❌ Directorio vendor NO encontrado<br>";
}

// Verificar archivo .env
if(file_exists('../.env')) {
    echo "✅ Archivo .env encontrado (en nivel superior)<br>";
} elseif(file_exists('.env')) {
    echo "✅ Archivo .env encontrado (en directorio actual)<br>";
} else {
    echo "❌ Archivo .env NO encontrado<br>";
}

echo "<hr>";

echo "<h2>🌐 Variables de Entorno</h2>";
echo "<strong>\$_SERVER['HTTP_HOST']:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'No definido') . "<br>";
echo "<strong>\$_SERVER['SERVER_NAME']:</strong> " . ($_SERVER['SERVER_NAME'] ?? 'No definido') . "<br>";
echo "<strong>\$_SERVER['REQUEST_METHOD']:</strong> " . ($_SERVER['REQUEST_METHOD'] ?? 'No definido') . "<br>";

echo "<hr>";

echo "<h2>📋 Módulos PHP</h2>";
$requiredModules = ['mbstring', 'openssl', 'pdo', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach($requiredModules as $module) {
    if(extension_loaded($module)) {
        echo "✅ $module<br>";
    } else {
        echo "❌ $module<br>";
    }
}

echo "<hr>";
echo "<h2>💡 Recomendaciones</h2>";

if(!file_exists('index.php')) {
    echo "<div style='background: #ffebee; padding: 10px; border-left: 4px solid #f44336;'>";
    echo "<strong>❌ PROBLEMA PRINCIPAL:</strong> No se encuentra index.php de Laravel<br>";
    echo "<strong>Solución:</strong> El document root debe apuntar a la carpeta 'public' de Laravel<br>";
    echo "En cPanel → Dominios → Redireccionar → Configurar que imallen.dev apunte a /public_html/tu-proyecto/public/";
    echo "</div><br>";
}

if(!file_exists('.htaccess')) {
    echo "<div style='background: #fff3e0; padding: 10px; border-left: 4px solid #ff9800;'>";
    echo "<strong>⚠️ ADVERTENCIA:</strong> No se encuentra .htaccess<br>";
    echo "<strong>Solución:</strong> Asegúrate de que el archivo .htaccess de la carpeta public se haya subido correctamente";
    echo "</div><br>";
}

echo "<div style='background: #e8f5e8; padding: 10px; border-left: 4px solid #4caf50;'>";
echo "<strong>📧 Información de contacto:</strong><br>";
echo "Si necesitas ayuda adicional, comparte esta información de diagnóstico.";
echo "</div>";

echo "<hr>";
echo "<small>Diagnóstico generado el " . date('Y-m-d H:i:s') . "</small>";
?>