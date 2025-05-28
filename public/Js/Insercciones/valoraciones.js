        function actualizarVistaValoracion() {
            const comentario = document.getElementById('comentario').value;
            const preview = document.getElementById('previewComentario');

            preview.textContent = comentario ? comentario : '--';
        }

        const estrellasForm = document.querySelectorAll('.estrella-form');
        const estrellasPreview = document.querySelectorAll('.estrella-preview');
        const inputCalificacion = document.getElementById('calificacion');

        estrellasForm.forEach((estrella) => {
            estrella.addEventListener('click', () => {
                const valor = estrella.getAttribute('data-valor');
                inputCalificacion.value = valor;

                // Pintar estrellas en el formulario
                estrellasForm.forEach((e, i) => {
                    e.classList.toggle('seleccionada', i < valor);
                });

                // Pintar estrellas en la vista previa
                estrellasPreview.forEach((e, i) => {
                    e.classList.toggle('seleccionada', i < valor);
                });

                // También actualiza el texto numérico si querés
                document.getElementById('previewCalificacion').textContent = valor;
            });
        });
