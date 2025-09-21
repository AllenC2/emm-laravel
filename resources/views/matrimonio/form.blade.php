<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            
            <!-- Información Básica -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-user-circle me-2"></i>Información Básica
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nombre" class="form-label fw-semibold">Nombre del Matrimonio</label>
                            <input type="text" name="nombre" class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $matrimonio?->nombre) }}" id="nombre" 
                                   placeholder="Ej: Juan y María Pérez">
                            {!! $errors->first('nombre', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono_el" class="form-label fw-semibold">Teléfono Él</label>
                            <input type="tel" name="telefono_el" class="form-control @error('telefono_el') is-invalid @enderror" 
                                   value="{{ old('telefono_el', $matrimonio?->telefono_el) }}" id="telefono_el" 
                                   placeholder="(33) 123-4567">
                            {!! $errors->first('telefono_el', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono_ella" class="form-label fw-semibold">Teléfono Ella</label>
                            <input type="tel" name="telefono_ella" class="form-control @error('telefono_ella') is-invalid @enderror" 
                                   value="{{ old('telefono_ella', $matrimonio?->telefono_ella) }}" id="telefono_ella" 
                                   placeholder="(33) 123-4567">
                            {!! $errors->first('telefono_ella', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fechas Importantes -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-calendar me-2"></i>Fechas Importantes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cumpleaños_el" class="form-label fw-semibold">Cumpleaños Él</label>
                            <input type="date" name="cumpleaños_el" class="form-control @error('cumpleaños_el') is-invalid @enderror" 
                                   value="{{ old('cumpleaños_el', $matrimonio?->cumpleaños_el) }}" id="cumpleaños_el">
                            {!! $errors->first('cumpleaños_el', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cumpleaños_ella" class="form-label fw-semibold">Cumpleaños Ella</label>
                            <input type="date" name="cumpleaños_ella" class="form-control @error('cumpleaños_ella') is-invalid @enderror" 
                                   value="{{ old('cumpleaños_ella', $matrimonio?->cumpleaños_ella) }}" id="cumpleaños_ella">
                            {!! $errors->first('cumpleaños_ella', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="aniversario" class="form-label fw-semibold">Aniversario</label>
                            <input type="date" name="aniversario" class="form-control @error('aniversario') is-invalid @enderror" 
                                   value="{{ old('aniversario', $matrimonio?->aniversario) }}" id="aniversario">
                            {!! $errors->first('aniversario', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participación EMM -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-heart me-2"></i>Participación EMM
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="fin_de_semana" class="form-label fw-semibold">Fin de Semana</label>
                            <input type="text" name="fin_de_semana" class="form-control @error('fin_de_semana') is-invalid @enderror" 
                                   value="{{ old('fin_de_semana', $matrimonio?->fin_de_semana) }}" id="fin_de_semana" 
                                   placeholder="Ej: FDS #123">
                            {!! $errors->first('fin_de_semana', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="comunidad_id" class="form-label fw-semibold">Comunidad</label>
                            <select name="comunidad_id" class="form-select @error('comunidad_id') is-invalid @enderror" id="comunidad_id">
                                <option value="">Seleccionar Comunidad</option>
                                @foreach($comunidades as $comunidad)
                                    <option value="{{ $comunidad->id }}" {{ old('comunidad_id', $matrimonio?->comunidad_id) == $comunidad->id ? 'selected' : '' }}>
                                        {{ $comunidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('comunidad_id', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">¿Cabeza de Comunidad?</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cabeza_comunidad" id="cabeza_si" value="1" 
                                           {{ old('cabeza_comunidad', $matrimonio?->cabeza_comunidad) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cabeza_si">
                                        <i class="fa fa-check-circle text-success me-1"></i>Sí
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cabeza_comunidad" id="cabeza_no" value="0" 
                                           {{ old('cabeza_comunidad', $matrimonio?->cabeza_comunidad) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cabeza_no">
                                        <i class="fa fa-times-circle text-danger me-1"></i>No
                                    </label>
                                </div>
                            </div>
                            {!! $errors->first('cabeza_comunidad', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">¿Equipo Post?</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="equipo_post" id="equipo_si" value="1" 
                                           {{ old('equipo_post', $matrimonio?->equipo_post) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="equipo_si">
                                        <i class="fa fa-check-circle text-success me-1"></i>Sí
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="equipo_post" id="equipo_no" value="0" 
                                           {{ old('equipo_post', $matrimonio?->equipo_post) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="equipo_no">
                                        <i class="fa fa-times-circle text-danger me-1"></i>No
                                    </label>
                                </div>
                            </div>
                            {!! $errors->first('equipo_post', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="cargo_post" class="form-label fw-semibold">Cargo Post</label>
                            <input type="text" name="cargo_post" class="form-control @error('cargo_post') is-invalid @enderror" 
                                   value="{{ old('cargo_post', $matrimonio?->cargo_post) }}" id="cargo_post" 
                                   placeholder="Ej: Coordinador, Auxiliar, etc.">
                            {!! $errors->first('cargo_post', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dirección -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-map-marker-alt me-2"></i>Dirección
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="direccion" class="form-label fw-semibold">Dirección</label>
                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" 
                                   value="{{ old('direccion', $matrimonio?->direccion) }}" id="direccion" 
                                   placeholder="Calle y número">
                            {!! $errors->first('direccion', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="colonia" class="form-label fw-semibold">Colonia</label>
                            <input type="text" name="colonia" class="form-control @error('colonia') is-invalid @enderror" 
                                   value="{{ old('colonia', $matrimonio?->colonia) }}" id="colonia" 
                                   placeholder="Colonia">
                            {!! $errors->first('colonia', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="ciudad" class="form-label fw-semibold">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" 
                                   value="{{ old('ciudad', $matrimonio?->ciudad) }}" id="ciudad" 
                                   placeholder="Ciudad">
                            {!! $errors->first('ciudad', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="codigo_postal" class="form-label fw-semibold">Código Postal</label>
                            <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror" 
                                   value="{{ old('codigo_postal', $matrimonio?->codigo_postal) }}" id="codigo_postal" 
                                   placeholder="CP">
                            {!! $errors->first('codigo_postal', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Familiar -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-users me-2"></i>Información Familiar
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="numero_hijos" class="form-label fw-semibold">Número de Hijos</label>
                            <input type="number" name="numero_hijos" class="form-control @error('numero_hijos') is-invalid @enderror" 
                                   value="{{ old('numero_hijos', $matrimonio?->numero_hijos) }}" id="numero_hijos" 
                                   placeholder="0" min="0" max="20">
                            {!! $errors->first('numero_hijos', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="hijos_solteros" class="form-label fw-semibold">Hijos Solteros</label>
                            <input type="number" name="hijos_solteros" class="form-control @error('hijos_solteros') is-invalid @enderror" 
                                   value="{{ old('hijos_solteros', $matrimonio?->hijos_solteros) }}" id="hijos_solteros" 
                                   placeholder="0" min="0" max="20">
                            {!! $errors->first('hijos_solteros', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edades_hijos" class="form-label fw-semibold">Edades de los Hijos</label>
                            <input type="text" name="edades_hijos" class="form-control @error('edades_hijos') is-invalid @enderror" 
                                   value="{{ old('edades_hijos', $matrimonio?->edades_hijos) }}" id="edades_hijos" 
                                   placeholder="Ej: 15, 12, 8">
                            {!! $errors->first('edades_hijos', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
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
                    <a href="{{ route('matrimonios.index') }}" class="btn btn-outline-secondary btn-lg w-100">
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

.form-control-lg {
    padding: 1rem 1.25rem;
    font-size: 1.1rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
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