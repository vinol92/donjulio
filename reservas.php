<?php
session_start();

require 'config.php';

// Generar un token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$nombre = $apellidos = $edad = $telefono = $servicio = "";
$es_TEA = "";
$mensaje = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para limpiar los datos de entrada
    function limpiarEntrada($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Token CSRF inválido. Por favor, recarga la página e intenta nuevamente.";
    }
    // Validar y asignar los datos del formulario
    $nombre = limpiarEntrada($_POST["nombre"]);
    $apellidos = limpiarEntrada($_POST["apellidos"]);
    $edad = limpiarEntrada($_POST["edad"]);
    $telefono = limpiarEntrada($_POST["telefono"]);
    $servicio = limpiarEntrada($_POST["servicio"]);
    $es_TEA = isset($_POST["es_TEA"]) ? 1 : 0;
    $fecha_reserva = limpiarEntrada($_POST["fecha_reserva"]);
    $hora_reserva = limpiarEntrada($_POST["hora_reserva"]);

    // Validaciones adicionales
    if (!preg_match("/^[0-9]{9}$/", $telefono)) {
        $error = "Por favor, introduce un número de teléfono válido de 9 dígitos.";
    }

    // Verificar que la fecha no sea sábado o domingo
    $dia_semana = date('N', strtotime($fecha_reserva)); // 6 = Sábado, 7 = Domingo
    if ($dia_semana >= 6) {
        $error = "Por favor, selecciona un día de semana (lunes a viernes).";
    }


    // Lógica para verificar si ya existe una reserva en esa fecha y hora

    if (empty($error)) {
        try {
            // Preparar la consulta SQL
            $stmt = $pdo->prepare("INSERT INTO reservas (nombre, apellidos, edad, telefono, servicio, es_TEA, fecha_reserva, hora_reserva) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellidos, $edad, $telefono, $servicio, $es_TEA, $fecha_reserva, $hora_reserva]);

            $mensaje = "¡Gracias, $nombre $apellidos! Hemos recibido tu reserva para el servicio: $servicio el día $fecha_reserva a las $hora_reserva. Nos pondremos en contacto contigo pronto.";

            // Limpiar los campos del formulario
            $nombre = $apellidos = $edad = $telefono = $servicio = "";
            $es_TEA = "";
            $fecha_reserva = $hora_reserva = "";
        } catch (Exception $e) {
            $error = "Hubo un problema al procesar tu reserva. Por favor, intenta nuevamente más tarde.";
            // $error .= " Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Timepicker Addon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - DonJulio</title>
    <link rel="stylesheet" href="estilos.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI  -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Timepicker Addon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
    <script>
        $(function() {
            // Configurar el datepicker
            $("#fecha_reserva").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0, // Desde hoy
                beforeShowDay: $.datepicker.noWeekends // Excluir sábados y domingos
            });

            // Configurar el timepicker
            $('#hora_reserva').timepicker({
                timeFormat: 'HH:mm',
                interval: 30,
                minTime: '09:00',
                maxTime: '20:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>

    <script>
        $(function() {
            // Configurar el datepicker
            $("#fecha_reserva").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0, // Desde hoy
                beforeShowDay: $.datepicker.noWeekends // Excluir sábados y domingos
            });

            // Configurar el timepicker
            $('#hora_reserva').timepicker({
                timeFormat: 'HH:mm',
                interval: 30,
                minTime: '09:00',
                maxTime: '20:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>

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

    <!-- Sección de Reservas -->
    <section class="reservas">
        <h2>Realiza tu Reserva</h2>
        <?php
        if ($mensaje) {
            echo "<div class='mensaje-exito'>$mensaje</div>";
        }
        if ($error) {
            echo "<div class='mensaje-error'>$error</div>";
        }
        ?>
        <form action="reservas.php" method="POST" class="form-reservas">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
                <input type="checkbox" id="es_TEA" name="es_TEA" <?php if ($es_TEA) echo "checked"; ?>>
                <label for="es_TEA">Niños con TEA</label>
            </div>
            <div class="form-grupo">
                <label for="fecha_reserva">Fecha de Reserva:</label>
                <input type="text" id="fecha_reserva" name="fecha_reserva" value="<?php echo htmlspecialchars($fecha_reserva ?? ''); ?>" required readonly>
            </div>
            <div class="form-grupo">
                <label for="hora_reserva">Hora de Reserva:</label>
                <input type="text" id="hora_reserva" name="hora_reserva" value="<?php echo htmlspecialchars($hora_reserva ?? ''); ?>" required readonly>
            </div>
            <div class="form-grupo">
                <button type="submit" class="boton-enviar">Reservar</button>
            </div>
        </form>
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