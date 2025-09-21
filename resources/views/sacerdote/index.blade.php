@extends('layouts.app')

@section('template_title')
    Sacerdotes
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-church text-warning"></i> Sacerdotes
                </h1>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <small>Gestión de sacerdotes del EMM</small>
                    <div>
                        <a href="{{ route('sacerdotes.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                            <i class="fa fa-plus"></i> {{ __('Agregar sacerdote') }}
                        </a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check-circle"></i> {{ $message }}
                    </div>
                @endif

                @if($sacerdotes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Parroquia</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sacerdotes as $sacerdote)
                                    <tr style="cursor: pointer;" onclick="window.location='{{ route('sacerdotes.show', $sacerdote->id) }}'">
                                        <td><strong>{{ $sacerdote->nombre }}</strong></td>
                                        <td>{{ $sacerdote->parroquia }}</td>
                                        <td>
                                            <a href="{{ route('sacerdotes.show', $sacerdote->id) }}" class="btn btn-sm btn-primary">
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
                        <i class="fa fa-info-circle"></i> No hay sacerdotes registrados.
                    </div>
                @endif

                {!! $sacerdotes->withQueryString()->links() !!}
            </div>
        </div>
    </section>
@endsection
