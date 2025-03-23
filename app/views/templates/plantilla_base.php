<?php
use App\Controllers\PrincipalController;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'app/Views/components/meta_datos.php'; ?>
</head>

<body class="min-h-screen flex flex-col" style="background: linear-gradient(to bottom, var(--bg-primary), var(--bg-secondary));">
    <!-- Menú de navegación -->
    <?php include 'app/Views/components/menu.php'; ?>

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-6 flex-grow">
        <div class="animate-fade-in" id="contenido-dinamico">
            <?php
            // Carga dinámica de contenido
            PrincipalController::cargaModulos();
            ?>
        </div>
    </main>

    <!-- Pie de página -->
    <?php include 'app/Views/components/pie_pagina.php'; ?>

    <!-- Script principal con módulos ES6 -->
    <script type="module" src="assets/js/modules/app.js"></script>
</body>

</html>