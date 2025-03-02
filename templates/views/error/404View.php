<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Error 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            display: grid;
            place-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .contenedor {
            width: 90%;
            max-width: 500px;
            background-color: white;
            padding: 30px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .title-error {
            font-size: 6rem;
            font-weight: bold;
            color: #dc3545; /* Rojo Bootstrap para resaltar */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .lead-error {
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-home {
            margin-top: 20px;
        }

        .results {
            margin-top: 20px;
        }

        .result-item {
            margin-bottom: 15px;
            text-align: left;
        }

        /* Animación de Fade para un toque más moderno */
        .fade-in {
            animation: fadeIn 1.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<main class="fade-in">
    <div class="contenedor">
        <h3 class="title-error">404</h3>
        <p class="lead-error">Oops! La página que buscabas no está disponible.</p>

        <!-- Cuadro de búsqueda para ayudar al usuario a encontrar otra página -->
        <form id="searchForm" class="d-flex justify-content-center mb-4">
            <input id="searchInput" class="form-control me-2" type="search" placeholder="Buscar en el sitio..." aria-label="Buscar">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </form>

        <!-- Contenedor para mostrar los resultados de la búsqueda -->
        <div class="results" id="results"></div>

        <!-- Botón para volver al home -->
        <a href="/" class="btn btn-primary btn-home btn-lg">Volver al Inicio</a>
    </div>
</main>

<script>
// Array de páginas del sitio
const paginas = [
    { titulo: "Inicio", url: "home" },
];

// Función para mostrar resultados
function mostrarResultados(resultados) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = ''; // Limpiar resultados previos

    if (resultados.length > 0) {
        resultados.forEach((pagina) => {
            const div = document.createElement('div');
            div.classList.add('result-item');
            div.innerHTML = `
                <h5>${pagina.titulo}</h5>
                <a href="${pagina.url}" class="btn btn-link">Ir a la página</a>
            `;
            resultsDiv.appendChild(div);
        });
    } else {
        resultsDiv.innerHTML = '<p>No se encontraron resultados.</p>';
    }
}

// Función para realizar la búsqueda
function buscar(event) {
    event.preventDefault();
    const query = document.getElementById('searchInput').value.toLowerCase();

    if (query) {
        const resultados = paginas.filter(pagina => 
            pagina.titulo.toLowerCase().includes(query) || 
        );
        mostrarResultados(resultados);
    } else {
        document.getElementById('results').innerHTML = '<p>Por favor, ingresa un término de búsqueda.</p>';
    }
}

// Agregar listener al formulario de búsqueda
document.getElementById('searchForm').addEventListener('submit', buscar);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
