#!/bin/bash

# ===========================================
# SCRIPT DE PREPARACIÓN PARA cPanel SIN NPM
# Genera un ZIP listo para subir sin node_modules ni archivos de desarrollo
# ===========================================

echo "🚀 Preparando archivos para cPanel (sin npm)..."

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Funciones para mostrar mensajes
show_step() {
    echo -e "${BLUE}📋 $1${NC}"
}

show_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

show_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

show_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Verificar que estamos en el directorio correcto
if [[ ! -f "artisan" ]]; then
    show_error "No se encuentra el archivo 'artisan'. Ejecuta este script desde la raíz del proyecto Laravel"
    exit 1
fi

show_step "Paso 1: Compilando assets con npm..."
if command -v npm &> /dev/null; then
    npm run build
    if [[ $? -eq 0 ]]; then
        show_success "Assets compilados correctamente"
    else
        show_error "Error al compilar assets"
        exit 1
    fi
else
    show_warning "npm no está disponible. Asegúrate de que los assets estén compilados en public/build/"
fi

show_step "Paso 2: Instalando dependencias de Composer para producción..."
if command -v composer &> /dev/null; then
    composer install --no-dev --optimize-autoloader --no-interaction
    if [[ $? -eq 0 ]]; then
        show_success "Dependencias de Composer instaladas"
    else
        show_error "Error al instalar dependencias de Composer"
        exit 1
    fi
else
    show_warning "Composer no está disponible. Instala las dependencias manualmente"
fi

# Crear directorio de producción
PROD_DIR="emm-production-$(date +%Y%m%d_%H%M%S)"
show_step "Paso 3: Creando directorio de producción: $PROD_DIR"
mkdir -p "$PROD_DIR"

show_step "Paso 4: Copiando archivos necesarios..."

# Copiar archivos y directorios necesarios
rsync -av --progress \
    --exclude='.git*' \
    --exclude='node_modules' \
    --exclude='tests' \
    --exclude='.env*' \
    --exclude='README.md' \
    --exclude='package*.json' \
    --exclude='vite.config.js' \
    --exclude='phpunit.xml' \
    --exclude='tailwind.config.js' \
    --exclude='postcss.config.js' \
    --exclude='resources/js' \
    --exclude='resources/sass' \
    --exclude='resources/css' \
    --exclude='storage/logs/*' \
    --exclude='.phpunit.cache' \
    --exclude='database/database.sqlite' \
    --exclude='emm-production-*' \
    --exclude='prepare-cpanel.sh' \
    --exclude='instalar-htaccess.sh' \
    --exclude='htaccess-*.conf' \
    ./ "$PROD_DIR/"

show_success "Archivos copiados"

show_step "Paso 5: Preparando estructura de directorios..."

# Crear archivos de cache necesarios
echo "<?php return [];" > "$PROD_DIR/bootstrap/cache/packages.php"
echo "<?php return [];" > "$PROD_DIR/bootstrap/cache/services.php"

# Crear directorios necesarios
mkdir -p "$PROD_DIR/storage/app/public"
mkdir -p "$PROD_DIR/storage/app/private"
mkdir -p "$PROD_DIR/storage/framework/cache"
mkdir -p "$PROD_DIR/storage/framework/sessions"
mkdir -p "$PROD_DIR/storage/framework/testing"
mkdir -p "$PROD_DIR/storage/framework/views"
mkdir -p "$PROD_DIR/storage/logs"

show_success "Estructura preparada"

show_step "Paso 6: Creando archivos de configuración..."

# Crear .env.production de ejemplo
cat > "$PROD_DIR/.env.production.example" << 'EOF'
APP_NAME="EMM - Sistema de Matrimonios"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://imallen.dev

APP_LOCALE=es
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=es_ES

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@imallen.dev"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
EOF

# Crear instrucciones de instalación
cat > "$PROD_DIR/INSTALL-CPANEL.md" << 'EOF'
# 🚀 Instalación EMM en cPanel sin NPM

## 📋 Pasos de instalación:

### 1. 📁 Subir archivos:
- Extrae este ZIP en `/public_html/modelo-emm/`
- O sube todos los archivos vía File Manager de cPanel

### 2. ⚙️ Configurar .env:
```bash
# En el terminal de cPanel (si está disponible) o via File Manager:
cp .env.production.example .env

# Edita .env con tus datos de base de datos
# Si tienes acceso a terminal:
php artisan key:generate
```

### 3. 🗄️ Configurar base de datos:
En el archivo `.env`, actualiza:
- `DB_DATABASE=tu_base_de_datos`
- `DB_USERNAME=tu_usuario`
- `DB_PASSWORD=tu_contraseña`

### 4. 🚀 Ejecutar migraciones:
```bash
# Si tienes acceso a terminal:
php artisan migrate --force

# Si no tienes terminal, sube el SQL manualmente desde phpMyAdmin
```

### 5. 🔗 Crear storage link:
```bash
# Si tienes acceso a terminal:
php artisan storage:link

# Si no, crea un symlink manual en public/storage -> ../storage/app/public
```

### 6. ✅ Verificar permisos:
- `storage/` y subdirectorios: 755 o 777
- `bootstrap/cache/`: 755 o 777

## 🌐 Configuración de dominio:

### Opción A: Dominio principal
- Configura imallen.dev para que apunte a `/public_html/modelo-emm/public/`

### Opción B: Subdirectorio con .htaccess
- Usa el .htaccess multi-dominio en `/public_html/`
- Disponible en los archivos `htaccess-*.conf`

## 🎨 Assets:
✅ Los archivos CSS/JS ya están compilados en `public/build/`
✅ No necesitas npm en el servidor

## 🔧 Solución de problemas:

### Error 500:
- Verifica permisos de storage/ y bootstrap/cache/
- Revisa que .env esté configurado correctamente
- Verifica que la APP_KEY esté generada

### Assets no cargan:
- Verifica que public/build/ contenga los archivos
- Revisa la configuración de ASSET_URL en .env si es necesario

### Base de datos:
- Verifica conexión en .env
- Ejecuta migraciones si no se han aplicado
- Verifica que la base de datos exista

## 📞 Soporte:
Si tienes problemas, verifica los logs en `storage/logs/laravel.log`
EOF

show_success "Archivos de configuración creados"

show_step "Paso 7: Verificando assets compilados..."
if [[ -d "$PROD_DIR/public/build/assets" ]]; then
    asset_count=$(ls -1 "$PROD_DIR/public/build/assets" | wc -l)
    show_success "Assets encontrados: $asset_count archivos"
    echo "   📄 Archivos:"
    ls -la "$PROD_DIR/public/build/assets/" | head -5
else
    show_warning "No se encontraron assets compilados en public/build/assets"
    echo "   Asegúrate de ejecutar 'npm run build' antes de este script"
fi

show_step "Paso 8: Creando archivo ZIP..."
cd "$PROD_DIR"
zip -r "../emm-cpanel-ready-$(date +%Y%m%d_%H%M%S).zip" . -q
cd ..

ZIP_FILE=$(ls -t emm-cpanel-ready-*.zip | head -1)
ZIP_SIZE=$(du -sh "$ZIP_FILE" | cut -f1)

show_success "ZIP creado: $ZIP_FILE ($ZIP_SIZE)"

show_step "Paso 9: Resumen de archivos..."
echo ""
echo "📦 Contenido del paquete:"
echo "   📁 Directorio temporal: $PROD_DIR"
echo "   🗜️  Archivo ZIP: $ZIP_FILE"
echo "   📊 Tamaño: $ZIP_SIZE"
echo ""

cd "$PROD_DIR"
echo "📁 Estructura principal:"
find . -maxdepth 2 -type d | head -15

echo ""
echo "🎉 ¡Paquete para cPanel listo!"
echo ""
echo "📋 PRÓXIMOS PASOS:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "1. 📤 Sube $ZIP_FILE a tu cPanel"
echo "2. 📁 Extrae en /public_html/modelo-emm/"
echo "3. 📖 Sigue las instrucciones en INSTALL-CPANEL.md"
echo ""
echo "✨ Ventajas de este método:"
echo "   • ❌ No necesitas npm en el servidor"
echo "   • ✅ Assets ya compilados y optimizados"
echo "   • ✅ Solo archivos de producción incluidos"
echo "   • ✅ Configuración lista para usar"
echo ""

# Limpiar directorio temporal (opcional)
echo "🗑️  ¿Quieres eliminar el directorio temporal $PROD_DIR? (y/n)"
read -r cleanup
if [[ $cleanup == "y" ]]; then
    rm -rf "$PROD_DIR"
    show_success "Directorio temporal eliminado"
fi

show_success "¡Proceso completado!"