<footer>
    <!-- Sección de información sobre la empresa -->
    <section class="sobre-nosotros">
        <h2>Sobre Nosotros</h2>
        <div class="sobre-nosotros-contenido">
            <a href="{{ url('/sobre-Nosotros') }}">¿Quienes somos?</a>
        </div>
    </section>

    <!-- Sección del logo y nombre de la empresa -->
    <section class="sta">
        <div class="contenedor-logo-footer">
            <i class="fa-solid fa-lightbulb logo-footer"></i>
        </div>
        <h2>STA</h2>
    </section>

    <!-- Sección de atención al cliente -->
    <section class="atencion-cliente">
        <h2>Contactanos</h2>
        <!-- Íconos de redes sociales -->
        <div class="redes">
            <a href="https://www.facebook.com/share/1DpJ6TZU7C/">
                <i class="fab fa-facebook-f iconFacebook"></i>
            </a>

            <!-- Instagram -->
            <a
                href="https://www.instagram.com/mylook7225?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                <i class="fab fa-instagram"></i>
            </a>
            <!-- Correo electronico -->
            <a href="mailto:mylook7225@gmail.com">
                <i class="fa-solid fa-envelope"></i>
            </a>
        </div>
    </section>
</footer>

@once
<link rel="stylesheet" href="{{ asset('Css/Footer/Footer.css') }}">
@endonce
