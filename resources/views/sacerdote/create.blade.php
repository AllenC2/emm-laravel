@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Sacerdote
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="px-2" style="font-weight: 900; letter-spacing: -1px; font-size: 2.5rem; font-family: 'Arial Black', Arial, sans-serif;">
                    <i class="fa fa-user-tie text-primary"></i> Agregar Sacerdote
                </h1>
                        <form method="POST" action="{{ route('sacerdotes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @include('sacerdote.form')
                        </form>
            </div>
        </div>
    </section>
@endsection
