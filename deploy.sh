#!/bin/bash

# Script de post-despliegue para cPanel
# Ejecuta este script después de cada despliegue desde el File Manager de cPanel o terminal

echo "Iniciando post-despliegue de Laravel EMM..."

# Navegar al directorio de la aplicación
cd ~/public_html  # Cambia esta ruta según tu configuración de cPanel

# Crear el archivo .env de producción si no existe
if [ ! -f .env ]; then
    echo "Creando archivo .env de producción..."
    cp .env.production.example .env
    
    # Generar APP_KEY si no existe
    php artisan key:generate --ansi
fi

# Instalar dependencias de Composer (si no se hizo en CI/CD)
echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

# Limpiar y crear cache de configuración
echo "Configurando cache de Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
echo "Ejecutando migraciones de base de datos..."
php artisan migrate --force

# Crear enlace simbólico para storage (si no existe)
if [ ! -L public/storage ]; then
    echo "Creando enlace simbólico para storage..."
    php artisan storage:link
fi

# Configurar permisos
echo "Configurando permisos..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "Post-despliegue completado exitosamente!"
echo "No olvides actualizar las variables de entorno en .env según tu configuración de producción."