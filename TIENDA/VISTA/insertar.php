<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <form action="../CONTROLADOR/login.php?action=insert" method="post">
        <div>
            <label for="nombre">Nombre de tu amigo:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div>
            <label for="apellido">Apellido de tu amigo:</label>
            <input type="text" id="apellido" name="apellido" required>
        </div>

        <div>
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>

        <div>
            <button type="submit">Agregar Amigo</button>
        </div>
    </form>
</body>
</html>