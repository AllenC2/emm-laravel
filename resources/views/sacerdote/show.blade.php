@extends('layouts.app')

@section('template_title')
    {{ $sacerdote->nombre ?? __('Detalle Sacerdote') }}
@endsection

@section('content')
<div class="container-fluid sacerdote-detail">
    <!-- Header Section -->
    <a href="{{ route('sacerdotes.index') }}" style="background: none; border: none; padding: 0; text-decoration: underline; font-weight: bold; background-clip: text; -webkit-background-clip: text; color: transparent; -webkit-text-fill-color: transparent; background-image: linear-gradient(90deg, #ff512f 0%, #f9d423 100%);">
        <i class="fas fa-arrow-left me-1"></i>
        Volver
    </a>
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="display-3 mb-1 fw-bolder" style="font-family: 'Montserrat Black', 'Montserrat', Arial, sans-serif;">
                        {{ $sacerdote->nombre }}
                    </h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-church text-warning"></i>
                        {{ $sacerdote->parroquia }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <!-- Información Completa del Sacerdote -->
        <div class="col-lg-8 offset-lg-2 mb-4">
            <div class="card shadow-sm border-0 h-100 card-hover">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">
                <i class="fas fa-user-circle me-2"></i>
                Información del Sacerdote
                </h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 g-4">
                <div class="col-12 col-md-6">
                    <label class="text-muted small">TELÉFONO</label>
                    <div class="fw-bold">
                        <i class="fas fa-phone text-primary me-2"></i>
                        @if($sacerdote->telefono)
                            <a href="tel:{{ $sacerdote->telefono }}" class="text-decoration-none">
                                {{ $sacerdote->telefono }}
                            </a>
                        @else
                            <span class="text-muted">No registrado</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="text-muted small">CUMPLEAÑOS</label>
                    <div class="fw-bold">
                        <i class="fas fa-birthday-cake text-warning me-2"></i>
                        @if($sacerdote->cumpleaños)
                            @php
                            try {
                                \Carbon\Carbon::setLocale('es');
                                $fecha = \Carbon\Carbon::parse($sacerdote->cumpleaños);
                                $fechaFormateada = $fecha->format('d/m/Y');
                                $fechaRelativa = $fecha->diffForHumans();
                            } catch (\Exception $e) {
                                $fechaFormateada = $sacerdote->cumpleaños;
                                $fechaRelativa = null;
                            }
                            @endphp
                            {{ $fechaFormateada }}
                            @if(isset($fechaRelativa))
                            <small class="text-muted ms-2">
                                ({{ $fechaRelativa }})
                            </small>
                            @endif
                        @else
                            <span class="text-muted">No registrado</span>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <label class="text-muted small">DOMICILIO</label>
                    <div class="fw-bold">
                    <i class="fas fa-home text-info me-2"></i>
                    {{ $sacerdote->domicilio ?: 'No registrado' }}
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Botón de Edición -->
        <div class="col-lg-12 mb-4">
            <a href="{{ route('sacerdotes.edit', $sacerdote->id) }}" class="btn btn-primary w-100">
                <i class="fas fa-edit me-1"></i> Actualizar información del sacerdote
            </a>
        </div>
        
    </div>
</div>

<style>
.card-hover {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
}

.display-3 {
    font-size: 2.5rem;
    font-weight: 900;
    letter-spacing: -1px;
}

.card {
    border-radius: 12px;
    border: none;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border: none;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
}

.fw-bolder {
    font-weight: 900 !important;
}

.fw-bold {
    font-weight: 600 !important;
}

.badge {
    font-size: 0.85em;
    padding: 0.5em 0.75em;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.text-primary {
    color: #007bff !important;
}

.text-warning {
    color: #ffc107 !important;
}

.text-info {
    color: #17a2b8 !important;
}

.text-muted {
    color: #6c757d !important;
}

.small {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}
</style>
@endsection
