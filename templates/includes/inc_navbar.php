    <header class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?php echo FAVICON ?>icono-bimp.png" alt="Bimp Software" width="40" height="40" class="me-2">
                <span class="fw-bold fs-5">Bimp Framework</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-bimp" 
                aria-controls="navbar-bimp" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <nav class="collapse navbar-collapse" id="navbar-bimp">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 <?php echo $slug === 'home' ? 'active' : ''; ?>" href="home">Inicio</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 <?php echo $slug === 'creator' ? 'active' : ''; ?>" href="creator">Crear Archivo</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 <?php echo $slug === 'usuarios' ? 'active' : ''; ?>" href="usuarios">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2" href="">Comunidad</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2" href="">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>