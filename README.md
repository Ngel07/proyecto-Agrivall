# Agrivall — Web Corporativa y Tienda Online

Rediseño completo de la web de **AGRIVALL**, empresa familiar dedicada al cultivo ecológico de cerezas, hierbas comestibles, albaricoques y nueces en la Vall de Gallinera (Valencia). El proyecto integra tienda online, sistema de reservas de casa rural y blog de noticias.

---

## Funcionalidades

### Área pública
- Landing page con identidad visual ecológica y certificaciones
- Catálogo de productos con compra online (Bizum / Transferencia bancaria)
- Calendario de disponibilidad y solicitud de reservas de **La Casilla Agrivall**
- Blog de noticias con categorías
- Formulario de contacto general

### Panel de administración (privado)
- CRUD de productos (con imágenes y disponibilidad)
- CRUD de entradas de blog con categorías
- Gestión de pedidos y actualización de estado
- Gestión de reservas de la casa rural

---

## Stack tecnológico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 12 (PHP 8.2+) |
| Base de datos | MySQL 8 |
| Frontend | Blade + CSS/JS vanilla |
| Tipografía | Montserrat (Google Fonts) |
| Iconos | Font Awesome 6 |
| Entorno local | Laravel Sail (Docker) |
| Caché / Colas | Redis |

---

## Requisitos previos

- Docker Desktop (o Docker Engine + Compose)
- PHP 8.2+ y Composer (solo si no se usa Sail)

---

## Instalación local

\`\`\`bash
# 1. Clonar el repositorio
git clone https://github.com/Ngel07/proyecto-Agrivall.git
cd proyecto-Agrivall

# 2. Instalar dependencias PHP
composer install

# 3. Copiar y configurar el entorno
cp .env.example .env
# Editar .env con los valores de DB, mail, etc.

# 4. Generar clave de aplicación
./vendor/bin/sail artisan key:generate

# 5. Levantar los contenedores
./vendor/bin/sail up -d

# 6. Ejecutar migraciones y seeder
./vendor/bin/sail artisan migrate --seed
\`\`\`

El seeder crea el usuario administrador por defecto:

| Campo | Valor |
|---|---|
| Email | \`admin@agrivall.com\` |
| Contraseña | \`agrivall2026\` |

> Cambia la contraseña antes de desplegar en producción.

---

## Estructura de base de datos

| Tabla | Descripción |
|---|---|
| \`users\` | Usuarios administradores (\`is_admin\`) |
| \`productos\` | Catálogo de productos con soft delete |
| \`pedidos\` | Pedidos de clientes con datos de envío y pago |
| \`lineas_pedido\` | Detalle de productos por pedido |
| \`tipos_post\` | Categorías del blog |
| \`posts_blog\` | Entradas del blog con soft delete |
| \`semanas_casilla\` | Disponibilidad semanal de la casa rural |

---

## Rutas principales

\`\`\`
GET  /                      → Landing page
GET  /productos             → Catálogo
GET  /productos/{id}        → Detalle de producto
GET  /carrito               → Carrito de compra
GET  /pedido/checkout       → Formulario de pedido
GET  /blog                  → Listado de posts
GET  /blog/{id}             → Post individual
GET  /casilla               → Reservas de la casa rural
GET  /contacto              → Formulario de contacto
GET  /admin                 → Panel de administración (auth + admin)
\`\`\`

---

## Assets

Las imágenes deben colocarse en \`public/images/\`. El CSS principal se encuentra en \`public/css/styles.css\`.

---

## Requisitos legales

El proyecto incluye (o debe incluir antes del despliegue):
- Aviso de cookies
- Política de privacidad
- Política de cookies
- Aviso legal

Conforme a **LOPD** y **RGPD**.

---

## Licencia

Proyecto académico — uso interno. Todos los derechos sobre la marca y contenidos pertenecen a AGRIVALL.
