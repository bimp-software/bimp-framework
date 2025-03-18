<nav class="navbar navbar-expand-lg navbar-bimp bg-body-tertiary sticky-top navbar-light">
    <div class="container">
        <!-- Logo y Nombre -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="<?php echo FAVICON ?>icono-bimp.png" alt="Bimp Framework" width="40" height="40" class="me-2">
            <span class="fw-bold text-dark">Bimp Framework</span>
        </a>

        <!-- Botón de menú hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-lg-start text-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Open Source</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Desarrolladores</a>
                </li>
            </ul>

            <!-- Sección derecha del Navbar -->
            <div class="d-flex flex-column flex-lg-row align-items-center text-center text-lg-start">
                <!-- Contador de descargas con ícono de GitHub -->
                <div class="d-flex align-items-center text-dark me-lg-3 justify-content-center mb-2 mb-lg-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub" width="20" height="20" class="me-1">
                    <span class="fw-bold">79K</span>
                </div>

                <!-- Botón de documentación -->
                <a href="#" class="btn btn-outline-bimp w-100 w-lg-auto">Documentación</a>
            </div>
        </div>
    </div>
</nav>
