# Guía de Despliegue EMM - Laravel a cPanel

## 📋 Requisitos Previos

### En tu cPanel:

-   **PHP 8.2 o superior**
-   **Composer instalado**
-   **Base de datos MySQL creada**
-   **Acceso FTP y/o SSH**

### En GitHub:

-   Repositorio creado y código subido
-   Secrets configurados (ver sección de configuración)

## 🔧 Configuración de Secrets en GitHub

Ve a tu repositorio en GitHub → Settings → Secrets and variables → Actions → New repository secret

### Secrets Requeridos:

#### Para FTP (Obligatorio):

-   `FTP_SERVER`: Servidor FTP de tu cPanel (ej: `ftp.tudominio.com`)
-   `FTP_USERNAME`: Usuario FTP de cPanel
-   `FTP_PASSWORD`: Contraseña FTP de cPanel
-   `FTP_SERVER_DIR`: Directorio en el servidor (ej: `/public_html/` o `/public_html/tu-proyecto/`)

#### Para SSH (Opcional - solo si tienes acceso SSH):

-   `SSH_HOST`: Host del servidor (mismo que FTP_SERVER)
-   `SSH_USERNAME`: Usuario SSH
-   `SSH_PASSWORD`: Contraseña SSH
-   `SSH_PORT`: Puerto SSH (normalmente 22)
-   `SERVER_PATH`: Ruta completa al proyecto en el servidor

#### Variables de Entorno de la Aplicación:

-   `APP_KEY`: Clave de la aplicación Laravel (genera una nueva para producción)
-   `DB_HOST`: Host de la base de datos (normalmente `localhost`)
-   `DB_DATABASE`: Nombre de la base de datos
-   `DB_USERNAME`: Usuario de la base de datos
-   `DB_PASSWORD`: Contraseña de la base de datos

## 🚀 Proceso de Despliegue

### Opción 1: Con SSH (Recomendado)

Si tienes acceso SSH, usa el workflow `deploy.yml` que:

1. Instala dependencias
2. Configura Laravel
3. Sube archivos por FTP
4. Ejecuta comandos Laravel via SSH

### Opción 2: Solo FTP

Si solo tienes acceso FTP, usa el workflow `deploy-ftp-only.yml`:

1. Prepara la aplicación
2. Sube archivos por FTP
3. Ejecuta manualmente `deploy.sh` en cPanel

## 📝 Configuración en cPanel

### 1. Configurar Variables de Entorno

Edita el archivo `.env` en tu servidor con los valores de producción:

```env
APP_NAME="EMM"
APP_ENV=production
APP_KEY=base64:TU_CLAVE_GENERADA
APP_DEBUG=false
APP_URL=https://tudominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario_db
DB_PASSWORD=tu_password_db
```

### 2. Configurar el Document Root

En cPanel → Subdomains/Addon Domains, configura que apunte a:

```
/public_html/tu-proyecto/public
```

### 3. Configurar PHP (si es necesario)

En cPanel → PHP Selector, asegúrate de usar PHP 8.2+

### 4. Ejecutar Post-Despliegue

Si usas solo FTP, ejecuta en File Manager → Terminal:

```bash
cd ~/public_html/tu-proyecto
bash deploy.sh
```

## 🔄 Flujo de Trabajo

1. **Desarrolla localmente**
2. **Commitea y pushea a `main`**
3. **GitHub Actions despliega automáticamente**
4. **Si usas solo FTP, ejecuta `deploy.sh` manualmente**

## ⚠️ Consideraciones Importantes

### Seguridad:

-   Nunca subas el archivo `.env` al repositorio
-   Usa variables de entorno diferentes para producción
-   Cambia `APP_DEBUG=false` en producción

### Performance:

-   Los archivos se cachean automáticamente
-   Las migraciones se ejecutan automáticamente
-   El storage se enlaza automáticamente

### Logs:

-   Revisa los logs en `storage/logs/laravel.log`
-   Configura el nivel de log a `error` en producción

## 🛠️ Comandos Útiles

### Para ejecutar manualmente en cPanel:

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Crear cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migraciones
php artisan migrate
php artisan migrate:status

# Storage link
php artisan storage:link
```

## 🔍 Troubleshooting

### Error 500:

1. Revisa `storage/logs/laravel.log`
2. Verifica permisos de `storage/` y `bootstrap/cache/`
3. Confirma que `.env` esté configurado correctamente

### Base de datos:

1. Verifica credenciales en `.env`
2. Asegúrate de que la base de datos exista
3. Ejecuta `php artisan migrate`

### Assets no cargan:

1. Verifica `APP_URL` en `.env`
2. Configura el document root correctamente
3. Ejecuta `php artisan storage:link`
