# 🚀 Guía de Despliegue EMM en cPanel sin Node.js

## 📋 Problema Resuelto
**No puedes ejecutar npm en tu terminal de cPanel** → **Assets pre-compilados localmente**

## 🎯 Solución Implementada

### ✅ Assets Compilados Localmente
Los assets ya están compilados y optimizados:
- **CSS**: `public/build/assets/app-C7eCAKQo.css` (228 KB → 31 KB gzipped)
- **JS**: `public/build/assets/app-CkIMDabS.js` (118 KB → 39 KB gzipped)
- **Manifest**: `public/build/manifest.json` (para cache busting)

### ✅ Configuración Multi-Dominio
- **imallen.dev** → `modelo-emm/public/` (EMM)
- **funerariasshalom.com** → `shalom-erp/public/`
- **shalomfuneraria.com** → `shalom-erp/public/`
- **shalomfunerarias.com** → `shalom-erp/public/`

---

## 📦 Archivos para Subir a cPanel

### 1. `.htaccess` Principal (`/public_html/`)
```bash
# Usar archivo: htaccess-principal-cpanel.conf
# Copiar como: /public_html/.htaccess
```

### 2. `.htaccess` EMM (`/public_html/modelo-emm/public/`)
```bash
# Ya configurado en: public/.htaccess
# Optimizado para cPanel multi-dominio
```

### 3. Script de Configuración
```bash
# Usar archivo: setup-cpanel.sh
# Ejecutar desde: /public_html/modelo-emm/
chmod +x setup-cpanel.sh
./setup-cpanel.sh
```

---

## 🔧 Pasos de Instalación

### Paso 1: Subir Archivos
1. **Comprimir proyecto completo** (excepto `node_modules/`)
2. **Subir a cPanel** → File Manager → `/public_html/modelo-emm/`
3. **Extraer archivos** en el directorio correcto

### Paso 2: Configurar .htaccess Principal
```bash
# En /public_html/
cp modelo-emm/htaccess-principal-cpanel.conf .htaccess
```

### Paso 3: Ejecutar Script de Configuración
```bash
cd /public_html/modelo-emm/
chmod +x setup-cpanel.sh
./setup-cpanel.sh
```

### Paso 4: Configurar Base de Datos
Editar `.env`:
```env
APP_NAME="EMM - Equipos de Matrimonio"
APP_ENV=production
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
APP_DEBUG=false
APP_URL=https://imallen.dev

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tu_base_datos_emm
DB_USERNAME=tu_usuario_db
DB_PASSWORD=tu_password_db

CACHE_DRIVER=file
FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Paso 5: Instalar Dependencias PHP
```bash
# Opción A: Con Composer en terminal
composer install --no-dev --optimize-autoloader

# Opción B: Desde cPanel > PHP Composer
# Navegar a modelo-emm/ y ejecutar install
```

### Paso 6: Configurar Laravel
```bash
php artisan key:generate --force
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Paso 7: Crear Usuario Administrador
```bash
php artisan tinker
User::create([
    'name' => 'Administrador',
    'email' => 'admin@imallen.dev',
    'password' => bcrypt('admin123')
]);
```

---

## 🧪 Verificación

### ✅ URLs de Prueba
- **Página principal**: https://imallen.dev
- **Login**: https://imallen.dev/login
- **Assets CSS**: https://imallen.dev/build/assets/app-C7eCAKQo.css
- **Assets JS**: https://imallen.dev/build/assets/app-CkIMDabS.js
- **Manifest**: https://imallen.dev/build/manifest.json

### ✅ Verificar Funcionamiento
1. **Página carga correctamente** (sin errores 404/500)
2. **Assets se cargan** (CSS/JS funcionando)
3. **Login funciona** (base de datos conectada)
4. **Otros dominios** redirigen a shalom-erp

---

## 🔍 Solución de Problemas

### Error 404 en imallen.dev
```bash
# Verificar .htaccess principal
cat /public_html/.htaccess | grep imallen
```

### Assets no cargan
```bash
# Verificar manifest.json
cat /public_html/modelo-emm/public/build/manifest.json
ls -la /public_html/modelo-emm/public/build/assets/
```

### Error 500
```bash
# Revisar logs
tail -f /public_html/modelo-emm/storage/logs/laravel.log
```

### Base de datos no conecta
```bash
# Verificar .env
grep DB_ /public_html/modelo-emm/.env
```

---

## 🎯 Ventajas de Esta Solución

### ✅ Sin Dependencias Node.js
- **Assets pre-compilados** localmente
- **No requiere npm** en el servidor
- **Cache optimizado** (1 año para assets con hash)

### ✅ Multi-Dominio Robusto
- **Routing automático** por dominio
- **HTTPS forzado** para todos
- **Seguridad** (bloqueo de archivos sensibles)

### ✅ Optimización cPanel
- **Compresión GZIP** habilitada
- **Headers de seguridad** configurados
- **Cache inteligente** para performance

### ✅ Mantenimiento Fácil
- **Script automatizado** de configuración
- **Estructura clara** de directorios
- **Logs centralizados** para debugging

---

## 📞 Soporte

Si tienes problemas:
1. **Revisar logs**: `storage/logs/laravel.log`
2. **Verificar permisos**: 755 para directorios, 644 para archivos
3. **Comprobar .env**: Configuración de base de datos
4. **Validar .htaccess**: Reglas multi-dominio

**¡Tu EMM estará funcionando sin npm!** 🎉