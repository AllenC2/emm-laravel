<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            
            <!-- Información Personal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-user-circle me-2"></i>Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $sacerdote?->nombre) }}" id="nombre" 
                                   placeholder="Ej: Padre Juan Carlos Pérez">
                            {!! $errors->first('nombre', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
                                   value="{{ old('telefono', $sacerdote?->telefono) }}" id="telefono" 
                                   placeholder="(33) 123-4567">
                            {!! $errors->first('telefono', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cumpleaños" class="form-label fw-semibold">Cumpleaños</label>
                            <input type="date" name="cumpleaños" class="form-control @error('cumpleaños') is-invalid @enderror" 
                                   value="{{ old('cumpleaños', $sacerdote?->cumpleaños) }}" id="cumpleaños">
                            {!! $errors->first('cumpleaños', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Ministerial -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-church me-2"></i>Información Ministerial
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="parroquia" class="form-label fw-semibold">Parroquia</label>
                            <input type="text" name="parroquia" class="form-control @error('parroquia') is-invalid @enderror" 
                                   value="{{ old('parroquia', $sacerdote?->parroquia) }}" id="parroquia" 
                                   placeholder="Ej: Sagrado Corazón de Jesús">
                            {!! $errors->first('parroquia', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="domicilio" class="form-label fw-semibold">Domicilio</label>
                            <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" 
                                   value="{{ old('domicilio', $sacerdote?->domicilio) }}" id="domicilio" 
                                   placeholder="Ej: Av. Principal #123, Col. Centro">
                            {!! $errors->first('domicilio', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="row">
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fa fa-save me-2"></i>Guardar
                    </button>
                </div>
                <div class="col-12">
                    <a href="{{ route('sacerdotes.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                        <i class="fa fa-times me-2"></i>Cancelar
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-label {
    cursor: pointer;
    font-weight: 500;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn-lg {
    padding: 0.75rem 2rem;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
}

.fw-semibold {
    font-weight: 600 !important;
}

.text-primary {
    color: #0d6efd !important;
}
</style>