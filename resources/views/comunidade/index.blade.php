@extends('layouts.app')

@section('template_title')
    Comunidades
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-heart text-danger"></i> Comunidades
                </h1>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <small>Gestión de comunidades del EMM</small>
                    <div>
                        <a href="{{ route('comunidades.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                            <i class="fa fa-plus"></i> {{ __('Agregrar comunidad') }}
                        </a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check-circle"></i> {{ $message }}
                    </div>
                @endif

                @if($comunidades->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Comunidad</th>
                                    <th>Matrimonios</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comunidades as $comunidade)
                                    <tr style="cursor: pointer;" onclick="window.location='{{ route('comunidades.show', $comunidade->id) }}'">
                                        <td><strong>{{ $comunidade->nombre }}</strong></td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $comunidade->matrimonios ? $comunidade->matrimonios->count() : 0 }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('comunidades.show', $comunidade->id) }}" class="btn btn-sm btn-primary">
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
                        <i class="fa fa-info-circle"></i> No hay comunidades registradas.
                    </div>
                @endif

                {!! $comunidades->withQueryString()->links() !!}
            </div>
        </div>
    </section>
@endsection
