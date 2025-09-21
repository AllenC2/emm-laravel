@extends('layouts.app')

@section('template_title')
    {{ $matrimonio->nombre ?? __('Detalle Matrimonio') }}
@endsection

@section('content')
<div class="container-fluid matrimonio-detail">
    <!-- Header Section -->
    <a href="{{ route('matrimonios.index') }}" style="background: none; border: none; padding: 0; text-decoration: underline; font-weight: bold; background-clip: text; -webkit-background-clip: text; color: transparent; -webkit-text-fill-color: transparent; background-image: linear-gradient(90deg, #ff512f 0%, #f9d423 100%);">
        <i class="fas fa-arrow-left me-1"></i>
        Volver
    </a>
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="display-3 mb-1 fw-bolder" style="font-family: 'Montserrat Black', 'Montserrat', Arial, sans-serif;">
                        {{ $matrimonio->nombre }}
                    </h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-heart text-danger"></i>
                        FDS #{{ $matrimonio->fin_de_semana }}
                    </p>
                </div>
                <div>
                    
                
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <!-- Información Personal -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100 card-hover">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row row-cols-2 g-2">
                        <div class="col">
                            <div class="card text-center shadow-sm border-0 h-100 card-hover" style="background: linear-gradient(135deg, #ffe6e6 0%, #fff5f7 100%);">
                                <div class="card-body" style="padding: 0.5rem;">
                                    <i class="fas fa-female fa-3x text-pink mb-2" style="color: #e75480 !important;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-center shadow-sm border-0 h-100 card-hover" style="background: linear-gradient(135deg, #e6f0ff 0%, #f0f7ff 100%);">
                                <div class="card-body" style="padding: 0.5rem;">
                                    <i class="fas fa-male fa-3x text-primary mb-2" style="color: #007bff !important;"></i>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col">
                            <label class="text-muted small">TELÉFONO ELLA</label>
                            <div class="fw-bold">
                                <i class="fas fa-phone text-primary me-2"></i>
                                @if($matrimonio->telefono_ella)
                                    <a href="tel:{{ $matrimonio->telefono_ella }}" class="text-decoration-none">
                                        {{ $matrimonio->telefono_ella }}
                                    </a>
                                @else
                                    <span class="text-muted">No registrado</span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <label class="text-muted small">TELÉFONO ÉL</label>
                            <div class="fw-bold">
                                <i class="fas fa-phone text-primary me-2"></i>
                                @if($matrimonio->telefono_el)
                                    <a href="tel:{{ $matrimonio->telefono_el }}" class="text-decoration-none">
                                        {{ $matrimonio->telefono_el }}
                                    </a>
                                @else
                                    <span class="text-muted">No registrado</span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <label class="text-muted small">CUMPLEAÑOS ELLA</label>
                            <div class="fw-bold">
                                <i class="fas fa-birthday-cake text-warning me-2"></i>
                                {{ $matrimonio->cumpleanos_ella_formatted }}
                            </div>
                        </div>
                        <div class="col">
                            <label class="text-muted small">CUMPLEAÑOS ÉL</label>
                            <div class="fw-bold">
                                <i class="fas fa-birthday-cake text-warning me-2"></i>
                                {{ $matrimonio->cumpleanos_el_formatted }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card text-center shadow-sm border-0 h-100 card-hover" style="background: linear-gradient(135deg, #e0e0e0 0%, #f5f7fa 50%, #bfc9ca 100%); box-shadow: 0 2px 8px rgba(180,180,180,0.2);">
                                <div class="card-body" style="padding: 0.5rem;">
                                    <label class="text-muted small">ANIVERSARIO</label>
                                    <br>
                                    {{ $matrimonio->aniversario_formatted }}
                                    @if($matrimonio->aniversario_relative)
                                        <small class="text-muted ms-2">
                                            ({{ $matrimonio->aniversario_relative }})
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información EMM -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 card-hover">
                <div class="card-header bg-gradient-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-church me-2"></i>
                        Información EMM
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row row-cols-2 g-2">
                        <div class="col">
                            <label class="text-muted small">CABEZA DE COMUNIDAD</label>
                            <div class="fw-bold">
                                <i class="fas fa-crown text-warning me-2"></i>
                                <span class="badge {{ $matrimonio->cabeza_comunidad ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $matrimonio->cabeza_comunidad ? 'Sí' : 'No' }}
                                </span>
                            </div>
                        </div>
                        @if($matrimonio->equipo_post)
                        <div class="col">
                            <label class="text-muted small">EQUIPO POST</label>
                            <div class="fw-bold">
                                <i class="fas fa-users-cog text-primary me-2"></i>
                                {{ $matrimonio->equipo_post }}
                            </div>
                        </div>
                        @endif
                        @if($matrimonio->cargo_post)
                        <div class="col">
                            <label class="text-muted small">CARGO POST</label>
                            <div class="fw-bold">
                                <i class="fas fa-user-tie text-success me-2"></i>
                                <span class="badge bg-success">{{ $matrimonio->cargo_post }}</span>
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <label class="text-muted small">COMUNIDAD</label>
                            <div class="fw-bold">
                                <i class="fas fa-users text-secondary me-2"></i>
                                {{ $matrimonio->comunidade->nombre ?? 'ID: ' . $matrimonio->comunidad_id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Familiar -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100 card-hover">
                <div class="card-header bg-gradient-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-home me-2"></i>
                        Información Familiar
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6 mb-3">
                            <label class="text-muted small">NÚMERO DE HIJOS</label>
                            <div class="fw-bold">
                                <i class="fas fa-child text-info me-2"></i>
                                <span class="badge bg-info text-white">{{ $matrimonio->numero_hijos ?: '0' }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 mb-3">
                            <label class="text-muted small">HIJOS SOLTEROS</label>
                            <div class="fw-bold">
                                <i class="fas fa-users text-info me-2"></i>
                                <span class="badge bg-secondary">{{ $matrimonio->hijos_solteros ?: '0' }}</span>
                            </div>
                        </div>
                        @if($matrimonio->edades_hijos)
                        <div class="col-12 mb-3">
                            <label class="text-muted small">EDADES DE LOS HIJOS</label>
                            <div class="fw-bold">
                                <i class="fas fa-list text-info me-2"></i>
                                {{ $matrimonio->edades_hijos }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Dirección -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 card-hover">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Dirección
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small">DIRECCIÓN COMPLETA</label>
                            <div class="fw-bold">
                                <i class="fas fa-home text-primary me-2"></i>
                                {{ $matrimonio->direccion ?: 'No registrada' }}
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <label class="text-muted small">COLONIA</label>
                            <div class="fw-bold">
                                <i class="fas fa-map me-2"></i>
                                {{ $matrimonio->colonia ?: 'No registrada' }}
                            </div>
                        </div>

                        <div class="col-6 col-md-4 mb-3">
                            <label class="text-muted small">CÓDIGO POSTAL</label>
                            <div class="fw-bold">
                                <i class="fas fa-mail-bulk me-2"></i>
                                {{ $matrimonio->codigo_postal ?: 'No registrado' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="text-muted small">CIUDAD</label>
                            <div class="fw-bold">
                                <i class="fas fa-city me-2"></i>
                                {{ $matrimonio->ciudad ?: 'No registrada' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <a href="{{ route('matrimonios.edit', $matrimonio->id) }}" class="btn btn-primary w-100">
                <i class="fas fa-edit me-1"></i> Actualizar información del matrimonio
            </a>
        </div>

        
    </div>
</div>
@endsection
