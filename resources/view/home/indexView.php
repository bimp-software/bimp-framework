<?php require_once INCLUDES.'head.php'; ?>

    <?php require_once COMPONENTS.'navbar.php'; ?>

    <?php require_once COMPONENTS.'hero.php'; ?>

    <section class="features-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">BIMP-FRAMEWORK: Un ecosistema poderoso para PHP</h2>
                <p class="lead text-muted">Desarrolla aplicaciones modernas con facilidad gracias a un conjunto de herramientas optimizadas para productividad, seguridad y escalabilidad.</p>
            </div>

            <div class="row g-4">
                <!-- Autenticación Segura -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-user-lock fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Autenticación Segura</h4>
                        <p class="text-muted">Sistema integrado para registro, inicio de sesión y recuperación de contraseñas con verificación de email.</p>
                    </div>
                </div>

                <!-- Eloquent ORM -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-database fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Gestión de Base de Datos</h4>
                        <p class="text-muted">Un ORM elegante y eficiente que simplifica el manejo de bases de datos con relaciones, consultas y más.</p>
                    </div>
                </div>

                <!-- Autorización de Usuarios -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Autorización Avanzada</h4>
                        <p class="text-muted">Define permisos y roles fácilmente con un sistema de políticas flexible y seguro.</p>
                    </div>
                </div>

                <!-- Validación de Datos -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-check-circle fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Validación de Datos</h4>
                        <p class="text-muted">Verifica la entrada de datos con reglas robustas y maneja errores de forma intuitiva.</p>
                    </div>
                </div>

                <!-- Notificaciones Multicanal -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-envelope fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Notificaciones en Múltiples Canales</h4>
                        <p class="text-muted">Envía alertas vía email, SMS, Slack o notificaciones internas con facilidad.</p>
                    </div>
                </div>

                <!-- Sistema de Colas -->
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-white shadow rounded">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-tasks fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Procesamiento en Segundo Plano</h4>
                        <p class="text-muted">Optimiza el rendimiento ejecutando tareas pesadas en segundo plano con un sistema de colas eficiente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Código -->
    <section class="code-section py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <!-- Descripción -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="fw-bold text-white">Código limpio y expresivo</h2>
                    <p class="lead text-light">BIMP-FRAMEWORK está diseñado para escribir código claro, eficiente y escalable. Usa su sintaxis intuitiva para desarrollar con fluidez y mantener tu aplicación con facilidad.</p>

                    <!-- Menú con Bootstrap 5 -->
                    <div class="nav flex-column nav-pills mt-3" id="code-tabs" role="tablist">
                        <button class="nav-link active" id="model-tab" data-bs-toggle="pill" data-bs-target="#model" type="button" role="tab">
                            Definir un Modelo
                        </button>
                        <button class="nav-link" id="query-tab" data-bs-toggle="pill" data-bs-target="#query" type="button" role="tab">
                            Consultas con ORM
                        </button>
                        <button class="nav-link" id="validation-tab" data-bs-toggle="pill" data-bs-target="#validation" type="button" role="tab">
                            Validación de Datos
                        </button>
                        <button class="nav-link" id="routing-tab" data-bs-toggle="pill" data-bs-target="#routing" type="button" role="tab">
                            Rutas y Controladores
                        </button>
                    </div>
                </div>

                <!-- Bloque de Código -->
                <div class="col-lg-7">
                    <div class="tab-content p-4 bg-black rounded shadow" id="code-tabContent">
                        <!-- Modelo -->
                        <div class="tab-pane fade show active" id="model" role="tabpanel">
                            <pre class="text-white">
                                <code class="language-php">
                                // Definir un modelo en BIMP-FRAMEWORK
                                class User extends Model
                                {
                                    protected $table = 'users';
                                }
                                </code>
                            </pre>
                        </div>

                        <!-- Consultas con ORM -->
                        <div class="tab-pane fade" id="query" role="tabpanel">
                            <pre class="text-white">
                                <code class="language-php">
                                // Obtener todos los usuarios con BIMP ORM
                                foreach (User::all() as $user) {
                                    echo $user->name;
                                }
                                </code>
                            </pre>
                        </div>

                        <!-- Validación de Datos -->
                        <div class="tab-pane fade" id="validation" role="tabpanel">
                            <pre class="text-white">
                                <code class="language-php">
                                // Validar datos en un controlador
                                public function store(Request $request)
                                {
                                    $this->validate($request, [
                                        'username' => 'required|alpha_num|max:20',
                                        'email' => 'required|email|unique:users',
                                        'password' => 'required|min:8',
                                    ]);
                                }
                                </code>
                            </pre>
                        </div>

                        <!-- Rutas y Controladores -->
                        <div class="tab-pane fade" id="routing" role="tabpanel">
                            <pre class="text-white">
                                <code class="language-php">
                                // Definir rutas en BIMP-FRAMEWORK
                                Router::get('/usuarios', [UserController::class, 'index']);
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Sección Ecosistema -->
    <section class="ecosystem-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Un ecosistema completo para desarrolladores</h2>
                <p class="lead text-muted">BIMP-FRAMEWORK proporciona herramientas poderosas para simplificar el desarrollo, el despliegue y la administración de tus aplicaciones.</p>
            </div>

            <div class="row g-4">
                <!-- BIMP Cloud -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">BIMP Cloud</h5>
                            <p class="card-text text-muted">Plataforma en la nube para desplegar aplicaciones BIMP sin preocupaciones.</p>
                            <span class="badge bg-success mb-3">Nuevo</span>
                            <p class="card-text fw-bold">Desde $0.00/mes</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="#" class="btn btn-bimp btn-sm w-100">Desplegar ahora</a>
                        </div>
                    </div>
                </div>

                <!-- BIMP Forge -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">BIMP Forge</h5>
                            <p class="card-text text-muted">Gestión de servidores optimizada para DigitalOcean, AWS y más.</p>
                            <p class="card-text fw-bold">Desde $12.00/mes</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="#" class="btn btn-outline-bimp btn-sm w-100">Comenzar</a>
                        </div>
                    </div>
                </div>

                <!-- BIMP Monitor -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">BIMP Monitor</h5>
                            <p class="card-text text-muted">Monitoreo y análisis avanzado para el rendimiento de tu aplicación.</p>
                            <span class="badge bg-secondary mb-3">Próximamente</span>
                            <p class="card-text fw-bold">Precios próximamente</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="#" class="btn btn-outline-bimp btn-sm w-100">Unirse a la lista</a>
                        </div>
                    </div>
                </div>

                <!-- BIMP Admin -->
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">BIMP Admin</h5>
                            <p class="card-text text-muted">Construye paneles de administración profesionales en minutos.</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="#" class="btn btn-outline-bimp btn-sm w-100">Gratis</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="testimonial-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Confiado por desarrolladores, startups y empresas</h2>
                <p class="lead text-muted">Miles de empresas eligen <span class="text-primary">BIMP-FRAMEWORK</span> para desarrollar aplicaciones escalables y eficientes.</p>
            </div>

            <div class="row g-4">
                <!-- Testimonio 1 -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Carlos Rodríguez</h5>
                                <small class="text-muted">CTO, TechSoft</small>
                            </div>
                        </div>
                        <p class="text-muted">"BIMP-FRAMEWORK ha revolucionado nuestra forma de desarrollar aplicaciones. Su flexibilidad y rendimiento nos han permitido escalar rápidamente."</p>
                    </div>
                </div>

                <!-- Testimonio 2 -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Laura Gómez</h5>
                                <small class="text-muted">Lead Developer, Innovatech</small>
                            </div>
                        </div>
                        <p class="text-muted">"El ecosistema de BIMP nos permite integrar tecnologías de manera eficiente. Nos ha ahorrado tiempo y esfuerzo en cada proyecto."</p>
                    </div>
                </div>

                <!-- Testimonio 3 -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Miguel Sánchez</h5>
                                <small class="text-muted">Founder, WebSolutions</small>
                            </div>
                        </div>
                        <p class="text-muted">"Desde que implementamos BIMP-FRAMEWORK, hemos reducido el tiempo de desarrollo y mejorado la mantenibilidad del código en nuestros proyectos."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Call to Action -->
    <section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center text-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">¿Listo para crear tu próxima gran idea?</h2>
            <p class="lead mb-4">Impulsa tus proyectos con un framework moderno, escalable y optimizado para el desarrollo web.</p>
            <a href="#" class="btn btn-bimp btn-lg">Comenzar</a>
        </div>
        </div>
    </div>
    </section>


    
<?php require_once COMPONENTS.'footer.php'; ?>
    
<?php require_once INCLUDES.'footer.php'; ?>