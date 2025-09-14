// Función para cerrar sesión
        function logout() {
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                // Aquí puedes agregar la lógica para cerrar sesión
                alert('Cerrando sesión...');
                // window.location.href = 'logout.php';
            }
        }

        // Agregar efectos de transición al cambiar de página (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de entrada para el contenido
            const content = document.getElementById('main-content');
            if (content) {
                content.classList.add('show');
            }

            // Agregar efecto hover a los enlaces del sidebar
            document.querySelectorAll('.sidebar-item[data-page]').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Efecto visual de carga (opcional)
                    const content = document.getElementById('main-content');
                    content.classList.remove('show');
                    
                    // Pequeño delay para el efecto visual
                    setTimeout(() => {
                        content.classList.add('show');
                    }, 150);
                });
            });
        });

        // Actualizar estado activo de la navegación
        function updateActiveNavigation() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentPage = urlParams.get('page') || 'dashboard';
            
            // Remover active de todos
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Agregar active al actual
            const activeItem = document.querySelector(`[data-page="${currentPage}"]`);
            if (activeItem) {
                activeItem.classList.add('active');
            }
        }