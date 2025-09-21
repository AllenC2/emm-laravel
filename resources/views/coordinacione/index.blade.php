@extends('layouts.app')

@section('template_title')
    Coordinaciones
@endsection

@section('content')
    <style>
        .badge {
            background-color: #6c757d !important;
        }
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .btn-group .btn {
            flex: 1;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="px-2" style="font-weight: 900; letter-spacing: -1px; font-size: 2rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-sitemap text-primary"></i> Coordinaciones
                </h1>
                <div class="mb-3">
                    <a href="{{ route('coordinaciones.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Nueva Coordinación
                    </a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row">
                    @forelse ($coordinacionesGrouped as $matrimonioId => $coordinaciones)
                        @php
                            $matrimonio = $coordinaciones->first()->matrimonio;
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h1 class="card-title">{{ $matrimonio->nombre }}</h1>
                                    <h6 class="mt-3 mb-2 text-muted">
                                        <i class="fa fa-users"></i>
                                        Comunidades coordinadas:
                                    </h6>
                                    <div class="mb-3">
                                        @foreach ($coordinaciones as $coordinacion)
                                            <span class="badge bg-secondary me-1 mb-1">
                                                {{ $coordinacion->comunidade->nombre ?? 'Comunidad ID: ' . $coordinacion->comunidad_id }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <div class="btn-group w-100" role="group">
                                        @php
                                            $firstCoordinacion = $coordinaciones->first();
                                        @endphp
                                        <a class="btn btn-sm btn-outline-primary" 
                                            href="{{ route('coordinaciones.show', $firstCoordinacion->id) }}" 
                                            title="Ver detalles">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-success" 
                                            href="{{ route('coordinaciones.edit', $firstCoordinacion->id) }}" 
                                            title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="showDeleteModal({{ $matrimonioId }})"
                                                title="Eliminar coordinaciones">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <h5><i class="fa fa-info-circle"></i> No hay coordinaciones registradas</h5>
                                <p>Aún no se han registrado coordinaciones de matrimonios.</p>
                                <a href="{{ route('coordinaciones.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Crear primera coordinación
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmar eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar todas las coordinaciones de este matrimonio?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(matrimonioId) {
            // Aquí podrías agregar lógica para eliminar todas las coordinaciones de un matrimonio
            // Por ahora, mantenemos la funcionalidad original
            if (confirm('¿Estás seguro de que deseas eliminar las coordinaciones de este matrimonio?')) {
                // Implementar lógica de eliminación
                console.log('Eliminar coordinaciones del matrimonio:', matrimonioId);
            }
        }
    </script>
@endsection
