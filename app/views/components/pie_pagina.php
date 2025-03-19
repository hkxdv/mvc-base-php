<footer class="py-6 mt-auto border-t" style="background-color: var(--bg-primary); border-color: var(--border-color);">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Información del sistema -->
            <div class="mb-6 md:mb-0">
                <h5 class="text-xl font-semibold mb-3 flex items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background-color: var(--accent-transparent);">
                        <i class="fas fa-code" style="color: var(--accent-color);"></i>
                    </div>
                    <span style="color: var(--text-primary);">MVC Base PHP</span>
                </h5>
                <p style="color: var(--text-secondary);" class="mb-1 text-sm">Estructura base para el desarrollo de aplicaciones web con patrón MVC.</p>
                <p style="color: var(--text-secondary);" class="mb-0 text-sm">Desarrollada con PHP y Arquitectura MVC.</p>
            </div>

            <!-- Enlaces y GitHub -->
            <div class="md:text-right">
                <div class="flex flex-col md:items-end">
                    <!-- Enlaces rápidos -->
                    <div class="mb-4">
                        <h6 class="text-lg font-medium mb-2" style="color: var(--text-primary);">Enlaces Rápidos</h6>
                        <div class="flex flex-wrap md:justify-end gap-4">
                            <a href="index.php" class="text-sm transition-colors duration-200 flex items-center" 
                               style="color: var(--text-secondary);"
                               onmouseover="this.style.color='var(--accent-color)';" 
                               onmouseout="this.style.color='var(--text-secondary)';">
                                <i class="fas fa-home mr-1"></i>Inicio
                            </a>
                            <a href="index.php?option=documentacion" class="text-sm transition-colors duration-200 flex items-center"
                               style="color: var(--text-secondary);"
                               onmouseover="this.style.color='var(--accent-color)';" 
                               onmouseout="this.style.color='var(--text-secondary)';">
                                <i class="fas fa-book mr-1"></i>Documentación
                            </a>
                        </div>
                    </div>
                    
                    <!-- GitHub -->
                    <div>
                        <a class="inline-flex items-center px-4 py-2 rounded-md text-sm transition-all duration-200 border" 
                           style="background-color: var(--accent-transparent); border-color: var(--accent-color); color: var(--accent-color);"
                           onmouseover="this.style.backgroundColor='var(--accent-color)'; this.style.color='var(--text-primary)';" 
                           onmouseout="this.style.backgroundColor='var(--accent-transparent)'; this.style.color='var(--accent-color)';"
                           href="https://github.com/hk4u-dxv/mvc-base-php" 
                           target="_blank">
                            <i class="fab fa-github mr-2"></i>Ver en GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="mt-6 pt-4 border-t" style="border-color: var(--border-color);">
            <div class="text-center">
                <p class="text-sm" style="color: var(--text-secondary);">
                    &copy; <?php echo date('Y'); ?> - MVC Base PHP
                </p>
            </div>
        </div>
    </div>
</footer> 