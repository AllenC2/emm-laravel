@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Matrimonio
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <h1 class="px-2" style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-ring text-warning"></i> Editar Matrimonio
                </h1>
                <form method="POST" action="{{ route('matrimonios.update', $matrimonio->id) }}"  role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    @include('matrimonio.form')
                </form>
            </div>
        </div>
    </section>
@endsection
