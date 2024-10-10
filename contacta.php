<?php
// contacta.php

// Inicializar variables para mensajes
$nombre = $apellidos = $edad = $telefono = $servicio = "";
$es_TEA = "";
$mensaje = "";

// Manejar la solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para limpiar los datos de entrada
    function limpiarEntrada($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validar y asignar los datos del formulario
    $nombre = limpiarEntrada($_POST["nombre"]);
    $apellidos = limpiarEntrada($_POST["apellidos"]);
    $edad = limpiarEntrada($_POST["edad"]);
    $telefono = limpiarEntrada($_POST["telefono"]);
    $servicio = limpiarEntrada($_POST["servicio"]);
    $es_TEA = isset($_POST["es_TEA"]) ? "Sí" : "No";

    // Aquí puedes procesar los datos, por ejemplo, enviarlos por correo electrónico o almacenarlos en una base de datos.

    // Por simplicidad, mostraremos un mensaje de éxito
    $mensaje = "¡Gracias, $nombre $apellidos! Hemos recibido tu solicitud para el servicio: $servicio. Nos pondremos en contacto contigo pronto.";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacta - DonJulio</title>
    <link rel="stylesheet" href="estilos.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome (opcional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header (igual que en index.php) -->
    <header>
        <div class="logo">
            <h1>DonJulio</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Reservas</a></li>
                <li><a href="contacta.php">Contacta</a></li>
            </ul>
        </nav>
    </header>

    <!-- Sección del Formulario de Contacto -->
    <section class="contacta">
        <h2>Contacta con Nosotros</h2>
        <?php
        if ($mensaje) {
            echo "<div class='mensaje-exito'>$mensaje</div>";
        }
        ?>
        <form action="contacta.php" method="POST" class="form-contacto">
            <div class="form-grupo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="1" max="120" value="<?php echo htmlspecialchars($edad); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="123456789" value="<?php echo htmlspecialchars($telefono); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="servicio">Servicio:</label>
                <select id="servicio" name="servicio" required>
                    <option value="">-- Selecciona una opción --</option>
                    <option value="Corte pelo" <?php if ($servicio == "Corte pelo") echo "selected"; ?>>Corte pelo</option>
                    <option value="Corte pelo + barba" <?php if ($servicio == "Corte pelo + barba") echo "selected"; ?>>Corte pelo + barba</option>
                    <option value="Corte pelo + tratamiento" <?php if ($servicio == "Corte pelo + tratamiento") echo "selected"; ?>>Corte pelo + tratamiento</option>
                    <option value="Corte pelo + barba + tratamiento" <?php if ($servicio == "Corte pelo + barba + tratamiento") echo "selected"; ?>>Corte pelo + barba + tratamiento</option>
                </select>
            </div>
            <div class="form-grupo-checkbox">
                <input type="checkbox" id="es_TEA" name="es_TEA" <?php if ($es_TEA == "Sí") echo "checked"; ?>>
                <label for="es_TEA">Niños con TEA</label>
            </div>
            <div class="form-grupo">
                <button type="submit" class="boton-enviar">Enviar</button>
            </div>
        </form>
    </section>

    <!-- Redes Sociales (igual que en index.php) -->
    <footer>
        <a href="https://www.instagram.com/tu_perfil_de_instagram" target="_blank">
            <i class="fab fa-instagram fa-2x"></i>
        </a>
        <p>&copy; <?php echo date("Y"); ?> DonJulio. Todos los derechos reservados.</p>
    </footer>
</body>

</html>