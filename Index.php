<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DonJulio - Peluquería Especializada</title>
    <link rel="stylesheet" href="estilos.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>DonJulio</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="contacta.php">Contacta</a></li>
            </ul>
        </nav>
    </header>

    <!-- Imagen Principal -->
    <section class="hero">
        <img src="images/local.jpg" alt="Imagen del local de DonJulio">
    </section>

    <section class="descripcion">
        <h2>Bienvenidos a DonJulio</h2>
        <p>
            En DonJulio, no solo nos encargamos de que luzcas espectacular, sino que también nos especializamos en atender a niños con síndrome TEA.
            Nuestro equipo está capacitado para ofrecer un ambiente tranquilo y adaptado a las necesidades de cada niño, garantizando una experiencia agradable y sin estrés.
            ¡Ven y descubre un lugar donde el cuidado y la empatía se encuentran con el estilo y la profesionalidad!
        </p>
        <a href="#" class="boton-contacta">Contacta</a>
    </section>

    <!-- Nuevos Espacios: Niños y Adultos -->
    <section class="espacios">
        <div class="espacio">
            <img src="images/niños.jpg" alt="Espacio para Niños">
            <h3>Espacio para Niños</h3>
            <p>Nuestro espacio diseñado especialmente para niños con TEA, ofreciendo un ambiente seguro y amigable para que disfruten de su experiencia.</p>
        </div>
        <div class="espacio">
            <img src="images/adultos.jpg" alt="Espacio para Adultos">
            <h3>Espacio para Adultos</h3>
            <p>Un área cómoda y profesional para adultos que buscan un servicio de alta calidad en un entorno relajado.</p>
        </div>
    </section>

    <!-- Redes Sociales -->
    <footer>
        <a href="https://www.instagram.com/tu_perfil_de_instagram" target="_blank">
            <i class="fab fa-instagram fa-2x"></i>
        </a>
        <p>&copy; <?php echo date("Y"); ?> DonJulio. Todos los derechos reservados.</p>
    </footer>
</body>

</html>