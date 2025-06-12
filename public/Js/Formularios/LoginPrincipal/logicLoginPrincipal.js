const botonRegistro = document.getElementById('botonRegistro');
const botonInicioSesion = document.getElementById('botonInicioSesion');
const contenedor = document.getElementById('contenedor');
const botonesTipoUsuario = document.querySelectorAll('.boton-tipo-usuario');
const elementosTipoUsuario = document.querySelectorAll('.tipo_usuario');
let modoRegistroActivo = false;

document.addEventListener('DOMContentLoaded', () => {
    manejarTipoUsuario();
    configurarTogglePassword();

    const botonActivo = document.querySelector('.boton-tipo-usuario.activo');
    if (botonActivo) botonActivo.click();

    asignarListenersToggle();

    manejarModoSegunTamanio();

    window.addEventListener('resize', manejarModoSegunTamanio);
});
 window.addEventListener('DOMContentLoaded', () => {
                const errorMessages = document.querySelectorAll('.validacion-error');
                errorMessages.forEach((msg) => {
                    setTimeout(() => {
                        msg.style.transition = 'opacity 1s ease';
                        msg.style.opacity = '0';
                    }, 3000);

                    setTimeout(() => {
                        if (msg.parentNode) msg.remove();
                    }, 3500);
                });
            });
document.addEventListener("DOMContentLoaded", function() {
                 (session('mostrarNegocio'))
                    document.getElementById('botonNegocio')?.click();
            });            
function manejarModoSegunTamanio() {
    if (window.innerWidth <= 850) {
        modoMobile();
    } else {
        modoDesktop();
    }
}

function asignarListenersToggle() {
    botonRegistro.addEventListener('click', () => {
        modoRegistroActivo = true;
        if (window.innerWidth <= 850) {
            mostrarRegistroMobile();
        } else {
            contenedor.classList.add("panel-derecho-activo");
        }
    });

    botonInicioSesion.addEventListener('click', () => {
        modoRegistroActivo = false;
        if (window.innerWidth <= 850) {
            mostrarLoginMobile();
        } else {
            contenedor.classList.remove("panel-derecho-activo");
        }
    });

    const enlaceNoTieneCuenta = document.querySelector('.no-tiene-cuenta');
    const enlaceTieneCuenta = document.querySelector('.tiene-cuenta');

    if (enlaceNoTieneCuenta) {
        enlaceNoTieneCuenta.addEventListener('click', e => {
            e.preventDefault();
            modoRegistroActivo = true;
            if (window.innerWidth <= 850) {
                mostrarRegistroMobile();
            } else {
                contenedor.classList.add("panel-derecho-activo");
            }
        });
    }

    if (enlaceTieneCuenta) {
        enlaceTieneCuenta.addEventListener('click', e => {
            e.preventDefault();
            modoRegistroActivo = false;
            if (window.innerWidth <= 850) {
                mostrarLoginMobile();
            } else {
                contenedor.classList.remove("panel-derecho-activo");
            }
        });
    }
}

function modoMobile() {
    const superposicion = document.querySelector('.contenedor-superposicion');
    if (superposicion) superposicion.style.display = 'none';

    // Aquí removemos la clase desktop para evitar conflicto visual
    contenedor.classList.remove("panel-derecho-activo");

    if (modoRegistroActivo) {
        if (document.querySelector('.contenedor-registro')) {
            mostrarRegistroMobile();
        } else {
            console.warn('No existe contenedor de registro para mobile');
        }
    } else {
        if (document.querySelector('.contenedor-inicio-sesion')) {
            mostrarLoginMobile();
        } else {
            console.warn('No existe contenedor de login para mobile');
        }
    }
}

function modoDesktop() {
    const superposicion = document.querySelector('.contenedor-superposicion');
    if (superposicion) superposicion.style.display = 'grid';

    // Aquí agregamos o removemos la clase según modoRegistroActivo para desktop
    if (modoRegistroActivo) {
        contenedor.classList.add("panel-derecho-activo");
    } else {
        contenedor.classList.remove("panel-derecho-activo");
    }
}

function mostrarLoginMobile() {
    const registro = document.querySelector('.contenedor-registro');
    const login = document.querySelector('.contenedor-inicio-sesion');

    if (!login) {
        console.warn('No existe contenedor login para mostrar');
        return;
    }

    // Ocultamos el otro
    if (registro) {
        registro.classList.remove('contenedor-activo');
        setTimeout(() => {
            registro.style.display = 'none';
        }, 400); // después de la transición
    }

    // Mostramos el login con animación
    login.style.display = 'grid';
    setTimeout(() => {
        login.classList.add('contenedor-activo');
    }, 10);
}

function mostrarRegistroMobile() {
    const registro = document.querySelector('.contenedor-registro');
    const login = document.querySelector('.contenedor-inicio-sesion');

    if (!registro) {
        console.warn('No existe contenedor registro para mostrar');
        return;
    }

    // Ocultamos el otro
    if (login) {
        login.classList.remove('contenedor-activo');
        setTimeout(() => {
            login.style.display = 'none';
        }, 400);
    }

    // Mostramos el registro con animación
    registro.style.display = 'grid';
    setTimeout(() => {
        registro.classList.add('contenedor-activo');
    }, 10);
}



function manejarTipoUsuario() {
    botonesTipoUsuario.forEach(boton => {
        boton.addEventListener('click', () => {
            const form = boton.closest('form');
            const tipo = boton.dataset.tipo;

            form.querySelectorAll('.boton-tipo-usuario').forEach(btn => {
                btn.classList.remove('activo');
                btn.style.fontWeight = 'normal';
            });
            boton.classList.add('activo');
            boton.style.fontWeight = 'bold';

            if (tipo === '1') {
                form.querySelector('.campos-estudiante')?.classList.add('activo');
                form.querySelector('.campos-estudiante')?.style.setProperty('display', 'grid');
                form.querySelector('.campos-generales')?.classList.remove('activo');
                form.querySelector('.campos-generales')?.style.setProperty('display', 'none');
            } else {
                form.querySelector('.campos-estudiante')?.classList.remove('activo');
                form.querySelector('.campos-estudiante')?.style.setProperty('display', 'none');
                form.querySelector('.campos-generales')?.classList.add('activo');
                form.querySelector('.campos-generales')?.style.setProperty('display', 'grid');
            }

            elementosTipoUsuario.forEach(input => input.value = tipo);

            console.log('Tipo de usuario:', tipo);
        });
    });
}


function configurarTogglePassword() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');

    if (!document.getElementById('password-toggle-style')) {
        const style = document.createElement('style');
        style.id = 'password-toggle-style';
        style.textContent = `
            .password-toggle {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #A68160;
                z-index: 10;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .input-with-toggle {
                position: relative;
                display: inline-grid;
                width: 100%;
            }
            .input-with-toggle input {
                width: 100%;
                padding-right: 30px;
                box-sizing: border-box;
            }
            .input-with-toggle input:focus + .password-toggle,
            .input-with-toggle input:not(:placeholder-shown) + .password-toggle,
            .password-toggle:hover {
                opacity: 1;
            }
        `;
        document.head.appendChild(style);
    }

    passwordInputs.forEach(input => {
        if (!input.parentElement.classList.contains('input-with-toggle')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'input-with-toggle';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
        }

        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('password-toggle')) {
            const toggle = document.createElement('i');
            toggle.className = 'fas fa-eye password-toggle';
            toggle.style.color = '#A68160';

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                if (input.type === 'password') {
                    input.type = 'text';
                } else {
                    input.type = 'password';
                }
                toggle.classList.toggle('fa-eye');
                toggle.classList.toggle('fa-eye-slash');
            });

            input.insertAdjacentElement('afterend', toggle);

            document.addEventListener('click', function (e) {
                if (e.target !== input && e.target !== toggle) {
                    toggle.style.opacity = '0';
                }
            });

            input.addEventListener('focus', () => toggle.style.opacity = '1');
            input.addEventListener('blur', () => {
                if (input.value === '') toggle.style.opacity = '0';
            });
        }
    });
}