# OVCSYSTEMS SAS - Plataforma Corporativa

Este repositorio contiene el código fuente del sitio web oficial de **OVCSYSTEMS SAS**.

## Descripción
Sitio web profesional diseñado con una estética minimalista y paleta de colores azules corporativos. 
Cuenta con una interfaz **Totalmente Responsive** que incluye menú hamburguesa para dispositivos móviles, animaciones suaves y una experiencia de usuario optimizada.
Incluye información de servicios, perfil de la empresa, sección de preguntas frecuentes y formulario de contacto funcional.

## Estructura del Proyecto
- `index.php`: La Landing Page principal.
- `assets/css/styles.css`: Hoja de estilos principal (Diseño Responsive, CSS Variables).
- `assets/js`: Lógica del frontend (Menú móvil, Acordeón FAQ, AJAX Form).
- `send_mail.php`: Script backend para procesamiento de correos.

## Configuración
Para el correcto funcionamiento del formulario de contacto en producción:
1. Configurar un servidor SMTP o asegurar que `sendmail` esté activo en el servidor.
2. (Opcional) Actualizar `send_mail.php` para usar PHPMailer para mayor robustez.

## Urls
- Principal: [ovcsystems.com](https://ovcsystems.com)
- Admin: [admin.ovcsystems.com](https://admin.ovcsystems.com) (En desarrollo)
