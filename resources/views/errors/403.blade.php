<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Acceso denegado - EMM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #feca57 0%, #ff9ff3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .error-container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
            width: 100%;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            margin-bottom: 1rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .error-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .emm-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #feca57, #ff9ff3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(254, 202, 87, 0.3);
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #feca57, #ff9ff3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-subtitle {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-description {
            font-size: 1rem;
            color: #718096;
            margin-bottom: 2.5rem;
            line-height: 1.7;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #feca57, #ff9ff3);
            color: white;
            box-shadow: 0 4px 15px rgba(254, 202, 87, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(254, 202, 87, 0.6);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: #4a5568;
            border: 2px solid rgba(254, 202, 87, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(254, 202, 87, 0.1);
            border-color: rgba(254, 202, 87, 0.5);
            transform: translateY(-2px);
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        @media (max-width: 768px) {
            .error-number {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 2rem;
            }
            
            .error-card {
                padding: 2rem 1.5rem;
            }
            
            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-number">403</div>

        <div class="error-card">
            <div class="emm-logo">
                EMM
            </div>

            <h1 class="error-title">¡Acceso denegado!</h1>
            
            <p class="error-subtitle">
                No tienes permisos para acceder a esta sección
            </p>
            
            <p class="error-description">
                Esta área del sistema EMM requiere permisos especiales. 
                Si crees que deberías tener acceso, contacta con tu coordinador 
                o administrador del sistema.
            </p>

            <div class="buttons">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Ir al Inicio
                </a>
                <a href="{{ route('login') }}" class="btn btn-secondary">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
</body>
</html>