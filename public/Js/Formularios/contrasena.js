let tiempo = parseInt(localStorage.getItem('tiempoRestante')) || 300; // 5 minutos
let reintentos = parseInt(localStorage.getItem('reintentos')) || 3;

const contador = document.getElementById('contador');
const mensaje = document.getElementById('mensaje');
const botonEnviar = document.getElementById('botonEnviar');
const botonReenviar = document.getElementById('botonReenviar');
const esperaReenvio = 60; // segundos

function actualizarTextoBoton() {
    botonReenviar.classList.remove('boton-Activo', 'boton-inactivo');

    if (reintentos <= 0) {
        botonReenviar.textContent = 'No quedan más reintentos';
        botonReenviar.disabled = true;
        botonReenviar.classList.add('boton-inactivo');
    } else {
        botonReenviar.textContent = `Reenviar código (${reintentos} intento${reintentos === 1 ? '' : 's'} restantes)`;
        botonReenviar.disabled = false;
        botonReenviar.classList.add('boton-Activo');
    }
}

function actualizarReintentos(n) {
    reintentos = n;
    localStorage.setItem('reintentos', reintentos);
    actualizarTextoBoton();
}

function iniciarTemporizadorReenvio() {
    botonReenviar.disabled = true;
    botonReenviar.classList.remove('boton-Activo');
    botonReenviar.classList.add('boton-inactivo');

    let tiempoEspera = esperaReenvio;
    botonReenviar.textContent = `Reenviar código (disponible en ${tiempoEspera}s)`;

    const intervalReenvio = setInterval(() => {
        tiempoEspera--;
        botonReenviar.textContent = `Reenviar código (disponible en ${tiempoEspera}s)`;

        if (tiempoEspera <= 0) {
            clearInterval(intervalReenvio);

            if (reintentos > 0) {
                botonReenviar.disabled = false;
                botonReenviar.classList.remove('boton-inactivo');
                botonReenviar.classList.add('boton-Activo');

                actualizarTextoBoton();
            }
        }

    }, 1000);
}

botonReenviar.addEventListener('click', () => {
    if (reintentos <= 0) return;

    botonReenviar.disabled = true;
    botonReenviar.classList.remove('boton-Activo');
    botonReenviar.classList.add('boton-inactivo');
    botonReenviar.textContent = 'Reenviando...';

    fetch("{{ route('reenviarCodigo') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Error al reenviar');
                }).catch(() => {
                    throw new Error('Error al reenviar');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                actualizarReintentos(reintentos - 1);
                mensaje.textContent = data.message || 'Código reenviado correctamente.';
                mensaje.classList.remove('mensaje-error');
                mensaje.classList.add('mensaje-exito');

                // Mostrar mensaje como notificación y ocultarlo a los 3 segundos
                mensaje.classList.add('mostrar-mensaje');
                setTimeout(() => {
                    mensaje.classList.remove('mostrar-mensaje');
                    mensaje.textContent = '';
                }, 3000);

                iniciarTemporizadorReenvio();
            } else {
                throw new Error(data.message || 'Error desconocido');
            }
        })
});

const intervalo = setInterval(() => {
    const minutos = Math.floor(tiempo / 60);
    const segundos = tiempo % 60;

    contador.textContent = `${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
    localStorage.setItem('tiempoRestante', tiempo);

    if (tiempo <= 0) {
        clearInterval(intervalo);
        localStorage.removeItem('tiempoRestante');
        localStorage.removeItem('reintentos');
        contador.textContent = '00:00';
        mensaje.textContent = 'CÓDIGO EXPIRADO';
        mensaje.classList.remove('mensaje-exito');
        mensaje.classList.add('mensaje-error');

        botonEnviar.disabled = true;
        botonEnviar.classList.add('boton-expirado');

        botonReenviar.disabled = true;
        botonReenviar.classList.add('boton-inactivo');

        setTimeout(() => {
            window.location.href = "{{ route('contrasenas', ['accion' => 'olvidarContrasena']) }}";
        }, 3000);
    }

    tiempo--;
}, 1000);

actualizarTextoBoton();
iniciarTemporizadorReenvio();
