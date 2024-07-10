<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receta médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0 auto;
            width: 180mm;
            height: 279mm;
            position: relative;
            font-family: 'Arial', sans-serif;
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        .doctor-info, .patient-info, .diagnosis, .medications {
            width: 100%;
        }
        .doctor-info {
            margin-top: 50px;
            text-align: right;
        }
        .doctor-info p {
            margin: 0;
        }
        .doctor-info .name {
            color: orange;
            font-size: 1.2em;
            font-weight: bold;
        }
        .patient-info {
            margin-top: 40px;
        }
        .diagnosis {
            margin-top: 40px;
        }
        .medications {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('images/receta.png') }}" alt="Background Image" class="background-image">
    <div class="content">
        <div class="doctor-info">
            <p class="name">Doctor: {{ $user->name }}</p>
            <p>Cédula Profesional: {{ $user->cedula_profesional }}</p>
            <p>Correo Electrónico: {{ $user->email }}</p>
            <p>Escuela de Procedencia: {{ $user->escuela_de_procedencia }}</p>
        </div>
<br>
        <div class="patient-info">
            <p><strong>Fecha de consulta:</strong> {{ $date ?? now()->format('d-m-Y') }}</p>
            <p><strong>Paciente:</strong> {{ $selectedPaciente->nombre_nombres }} {{ $selectedPaciente->nombre_apellido_paterno }} {{ $selectedPaciente->nombre_apellido_materno }}</p>
            <p><strong>Edad:</strong> {{ $selectedPaciente->edad_anios }} años</p>
        </div>

        <div class="diagnosis">
            <p><strong>Diagnóstico:</strong> {{ $diagnostico }}</p>
        </div>

        <div class="medications">
            {!! $receta !!}
        </div>
    </div>
</body>
</html>
