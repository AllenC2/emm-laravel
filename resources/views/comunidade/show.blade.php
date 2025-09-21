@extends('layouts.app')

@section('template_title')
    {{ $comunidade->name ?? __('Show') . " " . __('Comunidade') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <a href="{{ url()->previous() }}" style="background: none; border: none; padding: 0; text-decoration: underline; font-weight: bold; background-clip: text; -webkit-background-clip: text; color: transparent; -webkit-text-fill-color: transparent; background-image: linear-gradient(90deg, #ff512f 0%, #f9d423 100%);">
            <i class="fas fa-arrow-left me-1"></i>
            Volver
        </a>
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">{{ $comunidade->nombre }}</h1>
                <small>{{ $comunidade->descripcion }}</small>
                <p>
                    <strong>
                        <i class="fa fa-heart text-danger"></i> Matrimonios:
                    </strong>
                    {{ $comunidade->matrimonios->count() }}
                </p>
                @if($comunidade->matrimonios->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Matrimonio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comunidade->matrimonios as $matrimonio)
                                    <tr style="cursor: pointer;" onclick="window.location='{{ route('matrimonios.show', $matrimonio->id) }}'">
                                        <td>{{ $matrimonio->nombre }}</td>
                                        <td>
                                            <a href="{{ route('matrimonios.show', $matrimonio->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-fw fa-eye"></i> {{ __('Ver tarjeta') }}
                                            </a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i> No hay matrimonios registrados en esta comunidad.
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <a href="{{ route('comunidades.edit', $comunidade->id) }}" class="btn btn-block w-100" style="background: transparent; border: 2px solid #ffc107; color: #ffc107;">
                    <i class="fa fa-edit"></i> Editar Comunidad
                </a>
            </div>
        </div>
    </section>
@endsection
