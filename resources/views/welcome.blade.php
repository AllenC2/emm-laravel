<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'MODELO EMM') }}</title>
    </head>
    <body style="
        margin: 0; 
        padding: 0; 
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
        background: #f8fafc; 
        min-height: 100vh; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 300;
    ">
        <div style="
            max-width: 400px; 
            margin: 0 auto; 
            padding: 0 30px; 
            text-align: center;
        ">
            <!-- Logo EMM -->
            <div style="margin-bottom: 80px;">
                <img src="{{ asset('images/emm_logo.png') }}" alt="EMM Logo" style="
                    height: 90px; 
                    width: auto; 
                    opacity: 0.85; 
                    display: block; 
                    margin: 0 auto;
                ">
            </div>
            
            <!-- Título Principal -->
            <h1 style="
                font-size: 2.5rem; 
                color: #1f2937; 
                font-weight: 300; 
                margin: 0 0 20px 0; 
                letter-spacing: 2px;
            ">Bienvenido</h1>
            
            <!-- Línea decorativa -->
            <div style="
                background: linear-gradient(90deg, #ef4444, #f59e0b); 
                height: 2px; 
                width: 60px; 
                margin: 0 auto 30px auto; 
                border-radius: 1px;
            "></div>
            
            <!-- Subtítulo -->
            <p style="
                color: #6b7280; 
                font-size: 0.9rem; 
                letter-spacing: 3px; 
                text-transform: uppercase; 
                margin: 0 0 50px 0; 
                font-weight: 400;
            ">Sistema de Gestión EMM</p>
            
            <!-- Botón de Ingreso -->
            <a href="{{ route('home') }}" style="
                display: inline-block; 
                padding: 15px 40px; 
                border: 1px solid #d1d5db; 
                background: white; 
                color: #374151; 
                text-decoration: none; 
                font-size: 0.95rem; 
                letter-spacing: 1px; 
                transition: all 0.3s ease; 
                position: relative; 
                overflow: hidden;
                font-weight: 400;
            " onmouseover="
                this.style.background='#f9fafb';
                this.style.transform='translateY(-1px)';
                this.querySelector('.arrow').style.transform='translateX(5px)';
            " onmouseout="
                this.style.background='white';
                this.style.transform='translateY(0)';
                this.querySelector('.arrow').style.transform='translateX(0)';
            ">
                <span>Ingresar</span>
                <span class="arrow" style="
                    display: inline-block; 
                    margin-left: 10px; 
                    transition: transform 0.3s ease;
                ">→</span>
            </a>
            
            <!-- Elemento decorativo inferior -->
            <div style="margin-top: 60px; display: flex; justify-content: center; gap: 6px;">
                <div style="
                    width: 6px; 
                    height: 6px; 
                    background: #fca5a5; 
                    border-radius: 50%;
                "></div>
                <div style="
                    width: 6px; 
                    height: 6px; 
                    background: #fde68a; 
                    border-radius: 50%;
                "></div>
                <div style="
                    width: 6px; 
                    height: 6px; 
                    background: #fca5a5; 
                    border-radius: 50%;
                "></div>
            </div>
        </div>
    </body>
</html>
