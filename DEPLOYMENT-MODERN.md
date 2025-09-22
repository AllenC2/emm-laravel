# 🚀 GitHub Actions - Métodos de Despliegue Modernos

## 📋 Opciones Disponibles

Tienes **3 métodos** de despliegue sin FTP:

### 🔥 **Método 1: SSH Deploy** (Recomendado)
**Archivo:** `.github/workflows/deploy-ssh.yml`

✅ **Ventajas:**
- Control total del servidor
- Ejecución en tiempo real
- Logs detallados
- Más rápido

❌ **Requisitos:**
- Acceso SSH al servidor
- Git instalado en el servidor

📋 **Secrets necesarios:**
```
SSH_HOST: tu-servidor.com
SSH_USERNAME: tu_usuario
SSH_PASSWORD: tu_contraseña  
SSH_PORT: 22
PROJECT_PATH: /home/usuario/public_html
```

---

### 📦 **Método 2: Artifact Deploy** (Más Simple)
**Archivo:** `.github/workflows/deploy-artifact.yml`

✅ **Ventajas:**
- No requiere SSH
- Paquete listo para usar
- Despliegue manual controlado
- Releases automáticos

❌ **Contras:**
- Proceso manual de subida
- No automático 100%

📥 **Cómo usar:**
1. GitHub Actions crea un ZIP optimizado
2. Descargas el ZIP desde GitHub
3. Subes a tu servidor manualmente
4. Ejecutas `bash install.sh`

---

### 🌐 **Método 3: Webhook Deploy** (Más Avanzado)
**Archivos:** 
- `.github/workflows/deploy-webhook.yml`
- `webhook.php` (subir a tu servidor)

✅ **Ventajas:**
- Despliegue instantáneo
- Tu servidor se actualiza solo
- No requiere GitHub Actions complejos
- Muy eficiente

❌ **Requisitos:**
- Configurar webhook en servidor
- Git instalado en servidor

## 🎯 **¿Cuál Elegir?**

### **Si tienes SSH → Método 1**
```bash
# El más completo y profesional
✅ Control total
✅ Logs en tiempo real  
✅ Automatización completa
```

### **Si NO tienes SSH → Método 2**
```bash
# El más simple y seguro
✅ Sin configuración compleja
✅ Control manual
✅ Fácil de usar
```

### **Si quieres máximo rendimiento → Método 3**
```bash
# El más eficiente
✅ Servidor se actualiza solo
✅ Mínimo uso de GitHub Actions
✅ Muy rápido
```

## ⚙️ **Configuración por Método**

### 🔧 **Para SSH Deploy:**

1. **Verifica acceso SSH:**
```bash
ssh usuario@tu-servidor.com
```

2. **Clona tu repositorio en el servidor:**
```bash
cd /home/usuario/public_html
git clone https://github.com/AllenC2/emm-laravel.git .
```

3. **Configura secrets en GitHub:**
- Ve a Settings → Secrets and variables → Actions
- Agrega los secrets SSH

### 🔧 **Para Artifact Deploy:**

1. **Solo activa el workflow**
2. **Cada push creará un release con ZIP**
3. **Descarga y sube manualmente**

### 🔧 **Para Webhook Deploy:**

1. **Sube `webhook.php` a tu servidor:**
```php
// Edita la configuración en webhook.php:
$SECRET_TOKEN = 'tu_token_super_secreto';
$PROJECT_PATH = '/ruta/a/tu/proyecto';
```

2. **Configura webhook en GitHub:**
- Settings → Webhooks → Add webhook
- URL: `https://tu-dominio.com/webhook.php`
- Secret: el mismo token del archivo

## 🚀 **Recomendación para ti:**

Como tu dominio es `imallen.dev`, te recomiendo:

**🎯 Empezar con Método 2 (Artifact)** si no estás seguro del SSH

**🎯 Usar Método 1 (SSH)** si tienes acceso SSH

¿Cuál prefieres que configuremos primero?