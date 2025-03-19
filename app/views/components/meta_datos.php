<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MVC Base PHP para desarrollo de aplicaciones web">
<meta name="author" content="MVC Base PHP">
<title>MVC Base PHP</title>

<!-- CDN Tailwind -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo alias('@Img'); ?>/favicon.180x180.png" type="image/png">

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/588f112670.js" crossorigin="anonymous"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Precargar los módulos ES6 -->
<link rel="modulepreload" href="<?php echo alias('@Js_ES6'); ?>cache.modulo.js">
<link rel="modulepreload" href="<?php echo alias('@Js_ES6'); ?>cargador.modulo.js">

<!-- Estilos personalizados para tema oscuro Tailwind -->
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>styles.css">
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>output.css">