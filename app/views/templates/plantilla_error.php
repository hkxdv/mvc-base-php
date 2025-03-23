<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'app/Views/components/meta_datos_error.php'; ?>
</head>

<body class="min-h-screen text-white transition-colors duration-300" style="background: radial-gradient(circle at center, var(--bg-secondary), var(--bg-primary));">
    <!-- Contenido principal - solo muestra el error -->
    <main class="container mx-auto px-4 py-6 flex-grow">
        <!-- El contenido del error se incluirá aquí directamente -->
        <?php echo $contenido_error ?? ''; ?>
    </main>
</body>

</html>