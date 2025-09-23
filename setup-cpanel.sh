#!/bin/bash

# ===========================================
# CONFIGURACIÓN EMM PARA CPANEL SIN NODE.JS
# Configuración automática para imallen.dev
# ===========================================

echo "🚀 Configurando EMM en cPanel (imallen.dev) sin Node.js..."

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

show_step() { echo -e "${BLUE}📋 $1${NC}"; }
show_success() { echo -e "${GREEN}✅ $1${NC}"; }
show_warning() { echo -e "${YELLOW}⚠️  $1${NC}"; }
show_error() { echo -e "${RED}❌ $1${NC}"; }

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🏥 SISTEMA EMM - EQUIPOS DE MATRIMONIO"
echo "🌐 Dominio: imallen.dev"
echo "📁 Ubicación: /public_html/modelo-emm/"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Verificar directorio
if [[ ! -f "composer.json" ]]; then
    show_error "No se encuentra composer.json"
    echo "Ejecuta este script desde el directorio modelo-emm"
    exit 1
fi

show_step "Paso 1: Verificando estructura de archivos"

# Verificar archivos críticos
critical_files=(
    "public/index.php"
    "public/.htaccess"
    "public/build/manifest.json"
    "bootstrap/app.php"
    "artisan"
)

missing_files=()
for file in "${critical_files[@]}"; do
    if [[ ! -f "$file" ]]; then
        missing_files+=("$file")
    fi
done

if [[ ${#missing_files[@]} -gt 0 ]]; then
    show_error "Archivos faltantes:"
    for file in "${missing_files[@]}"; do
        echo "  - $file"
    done
    exit 1
else
    show_success "Todos los archivos críticos están presentes"
fi

show_step "Paso 2: Configurando permisos"
chmod -R 755 .
chmod 644 .env.example
chmod 755 artisan
chmod -R 644 public/build/
show_success "Permisos configurados"

show_step "Paso 3: Verificando assets compilados"
if [[ -f "public/build/manifest.json" ]]; then
    asset_count=$(find public/build/assets -name "*.css" -o -name "*.js" | wc -l)
    if [[ $asset_count -gt 0 ]]; then
        show_success "Assets compilados encontrados ($asset_count archivos)"
        echo "📄 CSS: $(find public/build/assets -name "*.css" | head -1 | xargs basename)"
        echo "📄 JS:  $(find public/build/assets -name "*.js" | head -1 | xargs basename)"
    else
        show_warning "No se encontraron assets compilados"
        echo "Los assets fueron compilados localmente con npm run build"
    fi
else
    show_error "Falta manifest.json - ejecuta 'npm run build' localmente"
fi

show_step "Paso 4: Configuración de dependencias PHP"
if command -v composer &> /dev/null; then
    echo "Instalando dependencias PHP..."
    composer install --no-dev --optimize-autoloader --no-scripts
    show_success "Dependencias PHP instaladas"
else
    show_warning "Composer no encontrado"
    echo "Instala las dependencias manualmente desde cPanel > PHP Composer"
fi

show_step "Paso 5: Configuración de ambiente"
if [[ ! -f ".env" ]]; then
    if [[ -f ".env.example" ]]; then
        cp .env.example .env
        show_success "Archivo .env creado desde .env.example"
    else
        show_warning "No se encontró .env.example"
    fi
else
    show_success "Archivo .env ya existe"
fi

show_step "Paso 6: Configuración de Laravel"
if [[ -f ".env" ]]; then
    # Generar key si no existe
    if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$" .env; then
        if command -v php &> /dev/null; then
            php artisan key:generate --force
            show_success "APP_KEY generada"
        else
            show_warning "Genera APP_KEY manualmente desde cPanel > Terminal"
        fi
    else
        show_success "APP_KEY ya configurada"
    fi
fi

show_step "Paso 7: Storage y cache"
if command -v php &> /dev/null; then
    php artisan storage:link 2>/dev/null || true
    php artisan config:cache 2>/dev/null || true
    php artisan route:cache 2>/dev/null || true
    php artisan view:cache 2>/dev/null || true
    show_success "Cache y storage configurados"
else
    show_warning "Configura storage y cache manualmente"
fi

echo ""
echo "🔧 CONFIGURACIÓN MANUAL RESTANTE:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "1. 🗄️  Configurar base de datos en .env:"
echo "   DB_CONNECTION=mysql"
echo "   DB_HOST=localhost"
echo "   DB_PORT=3306"
echo "   DB_DATABASE=tu_base_datos"
echo "   DB_USERNAME=tu_usuario"
echo "   DB_PASSWORD=tu_password"
echo ""
echo "2. 🔑 Configurar URLs en .env:"
echo "   APP_URL=https://imallen.dev"
echo "   ASSET_URL=https://imallen.dev"
echo ""
echo "3. 🚀 Ejecutar migraciones:"
echo "   php artisan migrate --force"
echo ""
echo "4. 👤 Crear usuario administrador:"
echo "   php artisan tinker"
echo "   User::create(['name'=>'Admin','email'=>'admin@imallen.dev','password'=>bcrypt('password123')]);"
echo ""

echo "🧪 TESTING:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ Visita: https://imallen.dev"
echo "✅ Login: https://imallen.dev/login"
echo "✅ Assets: https://imallen.dev/build/manifest.json"
echo ""

echo "📋 ESTRUCTURA DE DIRECTORIOS EN CPANEL:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📁 /public_html/"
echo "  ├── 📄 .htaccess (redirige dominios)"
echo "  ├── 📁 shalom-erp/ (otros dominios)"
echo "  └── 📁 modelo-emm/ (imallen.dev)"
echo "      ├── 📄 .env"
echo "      ├── 📁 app/"
echo "      ├── 📁 public/"
echo "      │   ├── 📄 .htaccess (configurado)"
echo "      │   ├── 📄 index.php"
echo "      │   └── 📁 build/ (assets compilados)"
echo "      └── 📁 vendor/ (composer install)"
echo ""

if [[ ${#missing_files[@]} -eq 0 ]]; then
    show_success "🎉 ¡Configuración básica completada!"
    echo "Completa la configuración manual y prueba https://imallen.dev"
else
    show_warning "⚠️  Configuración parcial - revisa los archivos faltantes"
fi

echo ""
echo "💡 TIPS:"
echo "- Si los assets no cargan, verifica public/build/manifest.json"
echo "- Si hay errores 500, revisa storage/logs/laravel.log"
echo "- Para debugging, activa APP_DEBUG=true temporalmente"
echo "- Los assets están optimizados para cache (1 año)"