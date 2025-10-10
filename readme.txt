=== Bachpedia ===
Contributors: tu-usuario
Tags: bach, music, encyclopedia, bootstrap
Requires at least: 6.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Tema de WordPress para la enciclopedia de las obras de Johann Sebastian Bach, basado en Bootstrap 5 para un diseño responsivo y elegante.

== Description ==

Bachpedia es un tema ligero y moderno diseñado específicamente para una enciclopedia dedicada a las obras de Johann Sebastian Bach. Utiliza Bootstrap 5 como framework principal para componentes responsivos (grids, cards para entradas de obras, navbars para navegación), con personalizaciones en SCSS (variables como colores ivory y gold-old para un toque barroco).

Características clave:
* Integración completa con Bootstrap 5 (compilado con Sass para variables personalizadas).
* Soporte para Custom Post Types (preparado para el plugin Bachpedia con obras, BWV, etc.).
* Plantillas optimizadas para entradas (single.php con cards para detalles de obras).
* Encolado seguro de assets (CSS/JS de Bootstrap via functions.php, con dependencias y versioning).
* Compatible con Gutenberg y bloques clásicos.
* Accesibilidad y SEO-friendly (title-tag, post-thumbnails, custom-logo).

Sigue las guías de desarrollo de temas de WordPress: 100% GPL-3.0, sin dependencias externas no declaradas.

== Installation ==

1. Sube la carpeta `bachpedia` a `/wp-content/themes/` de tu instalación de WordPress.
2. Ve a Apariencia > Temas en el panel de administración y activa "Bachpedia".
3. (Opcional) Instala dependencias para desarrollo: En la raíz del tema, ejecuta `npm install` y `npm run build` para compilar SCSS (requiere Node.js y Sass).
4. Configura el menú principal en Apariencia > Menús.
5. Para personalizaciones: Edita `functions.php` para encolar assets adicionales; usa plantillas como `single.php` para entradas de obras.

Para despliegue automatizado: Usa GitHub con un workflow rsync (ver repo en GitHub para detalles).

== Frequently Asked Questions ==

= ¿Cómo integro Bootstrap 5 con mis variables personalizadas? =

El tema compila Bootstrap via Sass en `assets/scss/custom.scss`, importando `_variables-bachpedia.scss`. Ejecuta `npm run build` para actualizar `assets/css/bootstrap.min.css`. En `functions.php`, se encola con `wp_enqueue_style`.

= ¿Es compatible con el plugin Bachpedia? =

Sí, preparado para CPTs como "Obras" (slug: bach_obra). Usa `single-bach_obra.php` para plantillas personalizadas con cards Bootstrap.

= ¿Cómo actualizo el tema? =

Desde Apariencia > Temas > Actualizaciones (método directo configurado en wp-config.php). O clona desde GitHub y despliega via rsync.

== Changelog ==

= 1.0.0 =
* Inicialización del tema con Bootstrap 5 y Sass.
* Estructura base: functions.php, index.php, template-parts.
* Soporte para title-tag, thumbnails y custom-logo.

= 0.9.0 =
* Prototipo inicial con style.css y metadatos GPL-3.0.

== Credits ==

* Bootstrap 5: Framework CSS/JS (MIT License, https://getbootstrap.com).
* Iconos: Dashicons (GPLv2, bundled con WordPress).
* Desarrollo: Basado en guías de WordPress.org y Sass para compilación.

Gracias por usar Bachpedia. ¡Contribuye en GitHub!
