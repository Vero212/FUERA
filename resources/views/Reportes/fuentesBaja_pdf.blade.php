<!DOCTYPE html>
<html>
<head>
    <title>Fuentes de Baja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
        }

        /* Estilos para el encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 30px; /* Ajusta el tamaño del logo */
        }

        .header-title {
            flex-grow: 1;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline; /* Subraya el título */
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background-color: #cad1d0;
            font-size: 12px;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        /* Estilo para la fecha */
        .page-date {
            font-size: 12px;
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- Encabezado con logo, título y fecha -->
    <div class="header">
        <img src="{{ asset('img/logos/logo11.png') }}" alt="Logo" width="50" height="30">
        <div class="header-title">Listado de Fuentes Radiactivas de Baja</div>
        <div class="page-date">
            {{ date('d/m/Y') }}<br>            
        </div>
    </div>

    <!-- Tabla de contenido -->
    <table>
        <thead>
            <tr>
                <th>FUENTE</th>
                <th>CLASIFIC</th>
                <th>GEOMETRIA</th>
                <th>TIPO</th>
                <th>RADIONUC</th>
                <th>FECHA BAJA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuentes as $fuente)
            <tr>
                <td>{{ $fuente->Id_Fuente_Radiactiva }}</td>
                <td>{{ $fuente->Clasificacion }}</td>
                <td>{{ $fuente->Geometria_Soporte }}</td>
                <td>{{ $fuente->Tipo_Emision_1 }}</td>
                <td>{{ $fuente->Radionucleido_1 }}</td>
                <td>{{ $fuente->Baja_Real }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>