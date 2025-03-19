<!DOCTYPE html>
<html lang="es">

<head>
    <?php include alias('@Meta_datos'); ?>
</head>

<body class="min-h-screen flex flex-col" style="background: linear-gradient(to bottom, var(--bg-primary), var(--bg-secondary));">
    <!-- Menú de navegación -->
    <?php include alias('@Menu'); ?>

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-6 flex-grow">
        <div class="animate-fade-in" id="contenido-dinamico">
            <?php 
            // Carga dinámica de contenido
            PrincipalControlador::carga_modulos(); 
            ?>
        </div>
    </main>

    <!-- Pie de página -->
    <?php include alias('@Pie_pagina'); ?>

    <!-- Script principal con módulos ES6 -->
    <script type="module" src="<?php echo alias('@AppJs'); ?>"></script>
</body>

</html>