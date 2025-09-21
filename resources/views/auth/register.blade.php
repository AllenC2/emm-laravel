<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MODELO EMM') }} - Registro</title>
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
            max-width: 420px; 
            margin: 0 auto; 
            padding: 30px; 
            text-align: center;
        ">
            <!-- Logo EMM -->
            <div style="margin-bottom: 40px;">
                <img src="{{ asset('images/emm_logo.png') }}" alt="EMM Logo" style="
                    height: 80px; 
                    width: auto; 
                    opacity: 0.85; 
                    display: block; 
                    margin: 0 auto;
                ">
            </div>
            
            <!-- Título Principal -->
            <h1 style="
                font-size: 2.2rem; 
                color: #1f2937; 
                font-weight: 300; 
                margin: 0 0 15px 0; 
                letter-spacing: 2px;
            ">Registro</h1>
            
            <!-- Línea decorativa -->
            <div style="
                background: linear-gradient(90deg, #ef4444, #f59e0b); 
                height: 2px; 
                width: 60px; 
                margin: 0 auto 40px auto; 
                border-radius: 1px;
            "></div>

            <!-- Formulario de Registro -->
            <form method="POST" action="{{ route('register') }}" style="text-align: left;">
                @csrf

                <!-- Campo Name -->
                <div style="margin-bottom: 25px;">
                    <label for="name" style="
                        display: block; 
                        color: #374151; 
                        font-size: 0.9rem; 
                        margin-bottom: 8px; 
                        font-weight: 400;
                        letter-spacing: 0.5px;
                    ">Nombre</label>
                    
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="
                        width: 100%; 
                        padding: 12px 15px; 
                        border: 1px solid #d1d5db; 
                        background: white; 
                        font-size: 0.95rem; 
                        border-radius: 0; 
                        outline: none; 
                        transition: all 0.3s ease;
                        box-sizing: border-box;
                        @error('name') border-color: #ef4444; @enderror
                    " onfocus="
                        this.style.borderColor='#6b7280';
                        this.style.background='#fafafa';
                    " onblur="
                        this.style.borderColor='#d1d5db';
                        this.style.background='white';
                    ">

                    @error('name')
                        <span style="
                            color: #ef4444; 
                            font-size: 0.8rem; 
                            margin-top: 5px; 
                            display: block;
                        ">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Email -->
                <div style="margin-bottom: 25px;">
                    <label for="email" style="
                        display: block; 
                        color: #374151; 
                        font-size: 0.9rem; 
                        margin-bottom: 8px; 
                        font-weight: 400;
                        letter-spacing: 0.5px;
                    ">Correo electrónico</label>
                    
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" style="
                        width: 100%; 
                        padding: 12px 15px; 
                        border: 1px solid #d1d5db; 
                        background: white; 
                        font-size: 0.95rem; 
                        border-radius: 0; 
                        outline: none; 
                        transition: all 0.3s ease;
                        box-sizing: border-box;
                        @error('email') border-color: #ef4444; @enderror
                    " onfocus="
                        this.style.borderColor='#6b7280';
                        this.style.background='#fafafa';
                    " onblur="
                        this.style.borderColor='#d1d5db';
                        this.style.background='white';
                    ">

                    @error('email')
                        <span style="
                            color: #ef4444; 
                            font-size: 0.8rem; 
                            margin-top: 5px; 
                            display: block;
                        ">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Password -->
                <div style="margin-bottom: 25px;">
                    <label for="password" style="
                        display: block; 
                        color: #374151; 
                        font-size: 0.9rem; 
                        margin-bottom: 8px; 
                        font-weight: 400;
                        letter-spacing: 0.5px;
                    ">Contraseña</label>
                    
                    <input id="password" type="password" name="password" required autocomplete="new-password" style="
                        width: 100%; 
                        padding: 12px 15px; 
                        border: 1px solid #d1d5db; 
                        background: white; 
                        font-size: 0.95rem; 
                        border-radius: 0; 
                        outline: none; 
                        transition: all 0.3s ease;
                        box-sizing: border-box;
                        @error('password') border-color: #ef4444; @enderror
                    " onfocus="
                        this.style.borderColor='#6b7280';
                        this.style.background='#fafafa';
                    " onblur="
                        this.style.borderColor='#d1d5db';
                        this.style.background='white';
                    ">

                    @error('password')
                        <span style="
                            color: #ef4444; 
                            font-size: 0.8rem; 
                            margin-top: 5px; 
                            display: block;
                        ">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Confirm Password -->
                <div style="margin-bottom: 30px;">
                    <label for="password-confirm" style="
                        display: block; 
                        color: #374151; 
                        font-size: 0.9rem; 
                        margin-bottom: 8px; 
                        font-weight: 400;
                        letter-spacing: 0.5px;
                    ">Confirmar contraseña</label>
                    
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" style="
                        width: 100%; 
                        padding: 12px 15px; 
                        border: 1px solid #d1d5db; 
                        background: white; 
                        font-size: 0.95rem; 
                        border-radius: 0; 
                        outline: none; 
                        transition: all 0.3s ease;
                        box-sizing: border-box;
                    " onfocus="
                        this.style.borderColor='#6b7280';
                        this.style.background='#fafafa';
                    " onblur="
                        this.style.borderColor='#d1d5db';
                        this.style.background='white';
                    ">
                </div>

                <!-- Botón de Registro -->
                <button type="submit" style="
                    width: 100%; 
                    padding: 15px; 
                    border: 1px solid #d1d5db; 
                    background: white; 
                    color: #374151; 
                    font-size: 0.95rem; 
                    letter-spacing: 1px; 
                    transition: all 0.3s ease; 
                    cursor: pointer; 
                    font-weight: 400;
                    margin-bottom: 20px;
                " onmouseover="
                    this.style.background='#f9fafb';
                    this.style.transform='translateY(-1px)';
                " onmouseout="
                    this.style.background='white';
                    this.style.transform='translateY(0)';
                ">Registrarse</button>

                <!-- Link para Login -->
                <div style="text-align: center;">
                    <a href="{{ route('login') }}" style="
                        color: #6b7280; 
                        text-decoration: none; 
                        font-size: 0.85rem; 
                        letter-spacing: 0.5px;
                        transition: color 0.3s ease;
                    " onmouseover="this.style.color='#374151';" onmouseout="this.style.color='#6b7280';">
                        ¿Ya tienes cuenta? Iniciar sesión
                    </a>
                </div>
            </form>

            <!-- Elemento decorativo inferior -->
            <div style="margin-top: 40px; display: flex; justify-content: center; gap: 6px;">
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
