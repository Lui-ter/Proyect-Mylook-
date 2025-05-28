        const inputFondo = document.getElementById('inputImagenFondo');
        const imagenFondo = document.getElementById('imagenFondo');

        inputFondo.addEventListener('change', () => {
            const file = inputFondo.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    imagenFondo.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });

        const inputLogo = document.getElementById('inputLogo');
        const logo = document.getElementById('logo');

        inputLogo.addEventListener('change', () => {
            const file = inputLogo.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    logo.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });