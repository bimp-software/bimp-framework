<?php require_once INCLUDES.'inc_header.php'; ?>

    <?php require_once INCLUDES.'inc_navbar.php'; ?>

    <main>
        <div class="container-fluid bg-dark">
            <div class="row">
                <div class="col-6 text-center offset-md-3">
                    <img src="<?php echo FAVICON.'icono-bimp.png' ?>" alt="Bimp framework" 
                    class="img-fluid" style="width: 200px;">
                    <h2 class="text-white mt-2 mb-2"><span class="text-danger">Bimp</span> framework</h2>
                    <p class="text-center text-white">Un framework PHP ligero, rápido y completamente personalizable, desarrollado con pasión y dedicación.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark text-light"><i class="fas fa-code text-danger"></i> Desarrollado con PHP, JavaScript y HTML5</li>
                        <li class="list-group-item bg-dark text-light"><i class="fas fa-layer-group text-danger"></i> Basado en el patrón <b>MVC</b> para una arquitectura organizada</li>
                        <li class="list-group-item bg-dark text-light"><i class="fas fa-cogs text-danger"></i> <b>100%</b> personalizable y escalable según tus necesidades</li>
                    </ul>
                    <div class="mt-5">
                        <a class="btn btn-warning btn-lg" href="#">Probar</a>
                        <a class="btn btn-success btn-lg" href="#"><i class="fas fa-download"></i> Descargar</a>
                        <a class="btn btn-info btn-lg" href="#"><i class="fab fa-github"></i> Github</a>
                    </div>
                    <div class="mt-5">
                        <p class="text-muted">Desarrollado con <i class="fas fa-heart text-danger"></i> por <a href="https://www.instagram.com/_b3nj4min.23_" class="text-white">Benjamin Caceres R.</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require_once INCLUDES.'inc_footer.php'; ?>