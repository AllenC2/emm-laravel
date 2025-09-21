@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Botones de creación -->
            <div class="row row-cols-2 row-cols-md-2 mb-4 g-2">
                <div class="col">
                    <a href="{{ route('matrimonios.create') }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-1"></i> Nuevo Matrimonio
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('comunidades.create') }}" class="btn btn-success w-100">
                        <i class="fas fa-plus me-1"></i> Nueva Comunidad
                    </a>
                </div>
            </div>

            <!-- Botones para navegar a índices -->
            <div class="row row-cols-2 row-cols-md-4 mb-4 g-2">
                <div class="col d-grid">
                    <a href="{{ route('matrimonios.index') }}" class="btn btn-outline-primary h-100 py-3 d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-heart mb-2 fa-2x"></i>
                        <span>Matrimonios</span>
                    </a>
                </div>
                <div class="col d-grid">
                    <a href="{{ route('comunidades.index') }}" class="btn btn-outline-success h-100 py-3 d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-church mb-2 fa-2x"></i>
                        <span>Comunidades</span>
                    </a>
                </div>
                <div class="col d-grid">
                    <a href="{{ route('sacerdotes.index') }}" class="btn btn-outline-warning h-100 py-3 d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user-tie mb-2 fa-2x"></i>
                        <span>Sacerdotes</span>
                    </a>
                </div>
                <div class="col d-grid">
                    <a href="{{ route('coordinaciones.index') }}" class="btn btn-outline-info h-100 py-3 d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-users-cog mb-2 fa-2x"></i>
                        <span>Coordinaciones</span>
                    </a>
                </div>
            </div>

            <div class="row g-3">
                    <h2>Comunidades</h2>
                    @forelse($comunidades as $comunidad)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="{{ route('comunidades.show', $comunidad->id) }}" class="text-decoration-none">
                                <div class="card shadow-sm comunidad-card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">{{ $comunidad->nombre }}</h6>
                                        <small class="text-muted d-block mb-2">
                                            @if($comunidad->sacerdote)
                                                <i class="fas fa-user-tie me-1"></i>{{ $comunidad->sacerdote->nombre }}
                                            @else
                                                <i class="fas fa-user-times me-1"></i>Sin sacerdote asignado
                                            @endif
                                        </small>
                                        <p class="card-text mb-0">
                                            <i class="fas fa-heart me-1"></i>{{ $comunidad->matrimonios->count() }} matrimonios
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-church fa-3x text-muted mb-3"></i>
                                    <h5 class="card-title text-muted">No hay comunidades registradas</h5>
                                    <p class="text-muted">Agrega tu primera comunidad para comenzar</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 text-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div>

<style>
.comunidad-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
    border-left: 4px solid #667eea;
}

.comunidad-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    border-left-color: #764ba2;
}

.comunidad-card .card-body {
    padding: 1.5rem;
}

.comunidad-card .card-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
}

.comunidad-card .card-text {
    color: #6c757d;
    font-size: 0.95rem;
}

.comunidad-card a {
    color: inherit;
    text-decoration: none;
}

.comunidad-card a:hover {
    color: inherit;
}

.text-muted i {
    color: #667eea !important;
}

.card-text i {
    color: #e74c3c !important;
}

/* Animación para iconos */
.comunidad-card:hover i {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .comunidad-card .card-body {
        padding: 1rem;
    }
    
    .comunidad-card .card-title {
        font-size: 1rem;
    }
}
</style>

@endsection
