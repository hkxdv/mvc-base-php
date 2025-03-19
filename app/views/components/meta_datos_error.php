<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="MVC Base PHP - Página de error">
<meta name="author" content="MVC Base PHP">
<title>Error - MVC Base PHP</title>

<!-- CDN Tailwind -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo alias('@Img'); ?>/favicon.180x180.png" type="image/png">

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/588f112670.js" crossorigin="anonymous"></script>

<!-- Estilos personalizados para tema oscuro Tailwind -->
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>styles.css">
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>output.css">

<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
main {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>