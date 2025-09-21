@extends('layouts.app')

@section('template_title')
    Matrimonios
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-ring text-warning"></i> Matrimonios
                </h1>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <small>Gestión de matrimonios del EMM</small>
                    <div>
                        <a href="{{ route('matrimonios.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                            <i class="fa fa-plus"></i> {{ __('Crear matrimonio') }}
                        </a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check-circle"></i> {{ $message }}
                    </div>
                @endif

                @if($matrimonios->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Comunidad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matrimonios as $matrimonio)
                                    <tr style="cursor: pointer;" onclick="window.location='{{ route('matrimonios.show', $matrimonio->id) }}'">
                                        <td><strong>{{ $matrimonio->nombre }}</strong></td>
                                        <td>
                                            @if($matrimonio->comunidade)
                                                <span class="badge bg-primary">
                                                    {{ $matrimonio->comunidade->nombre }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Sin comunidad</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('matrimonios.show', $matrimonio->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-fw fa-eye"></i> {{ __('Abrir') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i> No hay matrimonios registrados.
                    </div>
                @endif

                {!! $matrimonios->withQueryString()->links() !!}
            </div>
        </div>
    </section>
@endsection
