# 🚨 Solución Error 404 - Laravel en cPanel

## Problema Identificado
El error 404 indica que el servidor no encuentra el punto de entrada de Laravel. Esto ocurre cuando el **document root** no está configurado correctamente.

## ✅ Solución Paso a Paso

### 1. **Verificar Estructura en cPanel**
Tu estructura debe verse así:
```
/public_html/
├── tu-proyecto-laravel/          ← Código de Laravel
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── public/                   ← Esta carpeta debe ser el document root
│   │   ├── index.php            ← Punto de entrada de Laravel
│   │   ├── .htaccess            ← Reglas de rewrite
│   │   └── assets/
│   ├── vendor/
│   ├── .env
│   └── ...
```

### 2. **Configurar Document Root en cPanel**

#### Opción A: Subdominios (Recomendado)
1. Ve a **cPanel → Subdominios**
2. Crea subdominio: `app.imallen.dev`
3. **Document Root:** `/public_html/tu-proyecto-laravel/public`

#### Opción B: Dominio Principal
1. Ve a **cPanel → Dominios → Zona de DNS**
2. O usa **File Manager** para:
   - Mover contenido de `public/` a `/public_html/`
   - Mover resto del proyecto a `/public_html/laravel/`
   - Editar `index.php` para cambiar las rutas

### 3. **Configuración con Dominio Principal** (Si eliges Opción B)

Edita `/public_html/index.php` y cambia:
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

Por:
```php
require __DIR__.'/laravel/vendor/autoload.php';
$app = require_once __DIR__.'/laravel/bootstrap/app.php';
```

### 4. **Subir Archivo de Diagnóstico**
1. Sube `diagnostico.php` a tu document root actual
2. Visita: `https://imallen.dev/diagnostico.php`
3. Revisa los resultados del diagnóstico

### 5. **Verificar .env**
En el directorio de Laravel (NO en public), asegúrate de tener `.env`:
```env
APP_NAME="EMM"
APP_ENV=production
APP_KEY=base64:tu-key-aqui
APP_DEBUG=false
APP_URL=https://imallen.dev

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=imallen_emm
DB_USERNAME=imallen_emm_user
DB_PASSWORD=tu_password
```

### 6. **Ejecutar Comandos Post-Despliegue**
En **cPanel → Terminal** o **File Manager → Terminal**:
```bash
cd /public_html/tu-proyecto-laravel
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link
```

## 🔧 Comandos de Verificación

```bash
# Verificar permisos
chmod -R 755 storage bootstrap/cache

# Limpiar cache si hay problemas
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## 📋 Checklist de Verificación

- [ ] Document root apunta a `/public`
- [ ] Archivo `index.php` existe en document root
- [ ] Archivo `.htaccess` existe en document root
- [ ] Directorio `vendor` existe (en nivel superior)
- [ ] Archivo `.env` configurado correctamente
- [ ] Permisos correctos en `storage` y `bootstrap/cache`
- [ ] PHP 8.2+ activado
- [ ] Extensiones PHP requeridas instaladas

## 🆘 Si Sigue sin Funcionar

1. **Sube y ejecuta `diagnostico.php`**
2. **Revisa logs en cPanel → Error Logs**
3. **Verifica que el dominio esté propagado correctamente**
4. **Contacta con soporte de hosting si persiste el problema**

## 📞 Información Adicional

- **Dominio:** imallen.dev
- **Panel:** cPanel
- **Framework:** Laravel 12
- **PHP requerido:** 8.2+