@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Comunidade
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="px-2" style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-heart text-danger"></i> Agregar Comunidad
                </h1>
                <form method="POST" action="{{ route('comunidades.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf
                    @include('comunidade.form')
                </form>
            </div>
        </div>
    </section>
@endsection
