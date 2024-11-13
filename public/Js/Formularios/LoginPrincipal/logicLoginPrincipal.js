/* LOGICA MOBILE */

// Obtener referencias a los elementos
const startSesionBtn = document.querySelector('.startSesionBtn');
const registerSesionBtn = document.querySelector('.registerSesionBtn a');
const iniciarLogin = document.querySelector('.iniciarLogin');
const registerSesion = document.querySelector('.registerSesion');
const iniciarSesion = document.querySelector('.iniciarSesion');

// Botones de tipo de usuario
const formRegisterUsuario = document.getElementById('formRegisterUsuario');
const formRegisterEstablecimiento = document.getElementById('formRegisterEstablecimiento');
const formStartUsuario = document.getElementById('formStartUsuario');
const formStartEsatblecimiento = document.getElementById('formStartEsatblecimiento');

// Formularios
const registerUsuarioForm = document.querySelector('.registerUsuario');
const registerEstablecimientoForm = document.querySelector('.registerEstablecimiento');
const startUsuarioForm = document.querySelector('.StartUsuario');
const startEstablecimientoForm = document.querySelector('.StartEstablecimiento');

// Función para mostrar el formulario de inicio de sesión
startSesionBtn.addEventListener('click', () => {
    iniciarLogin.classList.add('slide-up');
    iniciarSesion.classList.add('slide-up');
    registerSesion.classList.remove('slide-up');
});

// Función para mostrar el formulario de registro
registerSesionBtn.addEventListener('click', (e) => {
    e.preventDefault();
    iniciarLogin.classList.add('slide-up');
    registerSesion.classList.add('slide-up');
    iniciarSesion.classList.remove('slide-up');
});

// Toggle formularios de registro
formRegisterUsuario.addEventListener('click', () => {
    registerUsuarioForm.style.display = 'flex';
    registerEstablecimientoForm.style.display = 'none';
    formRegisterUsuario.style.borderBottom = '2px solid var(--color-primary)';
    formRegisterEstablecimiento.style.borderBottom = '1px solid var(--color-primary)';
});

formRegisterEstablecimiento.addEventListener('click', () => {
    registerUsuarioForm.style.display = 'none';
    registerEstablecimientoForm.style.display = 'flex';
    formRegisterEstablecimiento.style.borderBottom = '2px solid var(--color-primary)';
    formRegisterUsuario.style.borderBottom = '1px solid var(--color-primary)';
});

// Toggle formularios de inicio de sesión
formStartUsuario.addEventListener('click', () => {
    startUsuarioForm.style.display = 'flex';
    startEstablecimientoForm.style.display = 'none';
    formStartUsuario.style.borderBottom = '2px solid var(--color-primary)';
    formStartEsatblecimiento.style.borderBottom = '1px solid var(--color-primary)';
});

formStartEsatblecimiento.addEventListener('click', () => {
    startUsuarioForm.style.display = 'none';
    startEstablecimientoForm.style.display = 'flex';
    formStartEsatblecimiento.style.borderBottom = '2px solid var(--color-primary)';
    formStartUsuario.style.borderBottom = '1px solid var(--color-primary)';
});


/* LOGICA DE PC PARA LOS LOGIN */
const botonRegistro = document.getElementById('botonRegistro');
const botonInicioSesion = document.getElementById('botonInicioSesion');
const contenedor = document.getElementById('contenedor');
const botonesTipoUsuario = document.querySelectorAll('.boton-tipo-usuario');
const input1 = document.getElementById('1');
const input2 = document.getElementById('2');
const input3 = document.getElementById('3');
const input4 = document.getElementById('4');
const input5 = document.getElementById('5');
const input6 = document.getElementById('6');
const input7 = document.getElementById('7');
const input8 = document.getElementById('8');
const elementos = document.querySelectorAll('.tipo_usuario');

// Mostrar el formulario de registro
botonRegistro.addEventListener('click', () => {
    contenedor.classList.add("panel-derecho-activo");
});

// Mostrar el formulario de inicio de sesión
botonInicioSesion.addEventListener('click', () => {
    contenedor.classList.remove("panel-derecho-activo");
});

// Manejar el cambio de tipo de usuario (Estudiante/Profesor)
botonesTipoUsuario.forEach(boton => {
    boton.addEventListener('click', () => {
        const formulario = boton.closest('form');
        const botones = formulario.querySelectorAll('.boton-tipo-usuario');
        const tipo = boton.dataset.tipo;

        // Cambiar la visualización de los campos según el rol seleccionado
        botones.forEach(btn => btn.classList.remove('activo'));
        boton.classList.add('activo');

        if (tipo === '1') {
            formulario.querySelector('.campos-estudiante').style.display = 'block';
            formulario.querySelector('.campos-profesor').style.display = 'none';
            input1.required = true;
            input2.required = true;
            input3.required = true;
            input4.required = true;
            /*--------------------------------  */
            input5.required = false;
            input6.required = false;
            input7.required = false;
            input8.required = false;
            
        
            elementos.forEach((elemento) => {
                elemento.value = tipo; // Asigna el valor a cada elemento
            });
            console.log(tipo);
            
        } else {
            formulario.querySelector('.campos-estudiante').style.display = 'none';
            formulario.querySelector('.campos-profesor').style.display = 'block';
            
            input1.required = false;
            input2.required = false;
            input3.required = false;
            input4.required = false;
            /*--------------------------------  */
            input5.required = true;
            input6.required = true;
            input7.required = true;
            input8.required = true;
            elementos.forEach((elemento) => {
                elemento.value = tipo; // Asigna el valor a cada elemento
            });
            console.log(tipo);
        }
    });
});

// Al cargar la página, asegúrate de que el formulario de estudiante esté visible
document.addEventListener('DOMContentLoaded', () => {
    // Mostrar campos para estudiante por defecto
    const primerBotonActivo = document.querySelector('.boton-tipo-usuario.activo');
    if (primerBotonActivo) {
        primerBotonActivo.click();
    }
});

/* Implementacion - Manejo de formularios */
const $ = (e)=>{return document.querySelector(e)}
const logo = $('.logoSta')
const activadores = $('.activadorForm')
const btnForms = [$('.startSesionBtn'),$('.link-register')]
const bienvenida = $('.contenedorMobile')
const formReg = $('.registerSesion')
const formLogin = $('.iniciarSesion')
const btnReverse = $('.cabecera p')
const login = $('.iniciarLogin')
btnReverse.onclick = ()=>{
    
    bienvenida.style.transition = "all 2s";
    bienvenida.style.gridTemplateRows = "100vh 0";
    setTimeout(()=>{
        login.style.gridTemplateRows = "35% 30% 35%"
        logo.style.opacity = "1";
        activadores.style.opacity = "1";
        btnReverse.style.transition = "all 2s";
        btnReverse.style.display = "none"
        logo.style.display = "flex";
        activadores.style.display = "flex";
    },2000)
    if (btn.classList.contains('startSesionBtn')) {
        formLogin.style.display = "none";
        btnReverse.style.display = "none";
    }    
    
    if (btn.classList.contains('link-register')) {
        formReg.style.display = "none";
        btnReverse.style.display = "none";
    }
}


btnForms.forEach(btn => {
    btn.onclick = ()=>{
        bienvenida.style.transition = "all 2s";
        logo.style.transition = "all 2s";
        logo.style.opacity = "0";
        activadores.style.transition = "all 2s";
        activadores.style.opacity = "0";
        bienvenida.style.gridTemplateRows = "30vh 70vh";
        btnReverse.style.display = "inline-block"
        setTimeout(()=>{
            logo.style.display = "none";
            activadores.style.display = "none";
            login.style.gridTemplateRows = "1fr"
        },2000)

        if (btn.classList.contains('startSesionBtn')) {
            formLogin.style.display = "flex";
            formReg.style.display = "none";

        }
        
        if (btn.classList.contains('link-register')) {
            formReg.style.display = "flex";
            formLogin.style.display = "none";
            
        }
    } 
})

