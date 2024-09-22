<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Crear Venta</h1>
        <form id="ventaForm">
            <div id="errorContainer" class="error"></div>

            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" required>

            <label for="total">Total:</label>
            <input type="number" id="total" name="total" step="0.01" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="">Seleccione un estado</option>
                <option value="completado">Completado</option>
                <option value="pendiente">Pendiente</option>
                <option value="cancelado">Cancelado</option>
            </select>

            <button type="submit">Crear Venta</button>
        </form>
    </div>

    <script>
        document.getElementById('ventaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const errorContainer = document.getElementById('errorContainer');
            errorContainer.innerHTML = '';

            const id_cliente = document.getElementById('id_cliente').value;
            const total = document.getElementById('total').value;
            const fecha = document.getElementById('fecha').value;
            const estado = document.getElementById('estado').value;

            if (!id_cliente || !total || !fecha || !estado) {
                errorContainer.innerHTML = 'Por favor, ingrese todos los campos.';
                return;
            }

            const data = {
                id_cliente: id_cliente,
                total: total,
                fecha: fecha,
                estado: estado
            };

            fetch('/ventas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Error en la creación de la venta');
                    });
                }
                return response.json();
            })
            .then(data => {
                alert('Venta creada correctamente');
                document.getElementById('ventaForm').reset();
            })
            .catch(error => {
                errorContainer.innerHTML = error.message;
            });
        });
    </script>

</body>
</html>