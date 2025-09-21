<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <!-- Campo Matrimonio -->
                    <div class="mb-4">
                        <label for="matrimonio_id" class="form-label fw-medium text-dark mb-2">
                            <i class="fas fa-heart text-primary me-2"></i>{{ __('Matrimonio') }}
                        </label>
                        <select name="matrimonio_id" 
                                id="matrimonio_id"
                                class="form-select form-select-lg border-0 bg-light @error('matrimonio_id') is-invalid @enderror" 
                                style="border-radius: 12px; padding: 15px 20px;">
                            <option value="">{{ __('Seleccione el matrimonio coordinador') }}</option>
                            @foreach($matrimonios as $matrimonio)
                                <option value="{{ $matrimonio->id }}" 
                                        {{ old('matrimonio_id', $coordinacione?->matrimonio_id) == $matrimonio->id ? 'selected' : '' }}>
                                    {{ $matrimonio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('matrimonio_id', '<div class="invalid-feedback fw-medium"><i class="fas fa-exclamation-circle me-1"></i>:message</div>') !!}
                    </div>

                    <!-- Campo Comunidad -->
                    <div class="mb-4">
                        <label for="comunidad_id" class="form-label fw-medium text-dark mb-2">
                            <i class="fas fa-users text-success me-2"></i>{{ __('Comunidad') }}
                        </label>
                        <select name="comunidad_id" 
                                id="comunidad_id"
                                class="form-select form-select-lg border-0 bg-light @error('comunidad_id') is-invalid @enderror" 
                                style="border-radius: 12px; padding: 15px 20px;">
                            <option value="">{{ __('Seleccione la comunidad a coordinar') }}</option>
                            @foreach($comunidades as $comunidad)
                                <option value="{{ $comunidad->id }}" 
                                        {{ old('comunidad_id', $coordinacione?->comunidad_id) == $comunidad->id ? 'selected' : '' }}>
                                    {{ $comunidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('comunidad_id', '<div class="invalid-feedback fw-medium"><i class="fas fa-exclamation-circle me-1"></i>:message</div>') !!}
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" 
                                class="btn btn-primary btn-lg fw-medium"
                                style="border-radius: 12px; padding: 15px; background: linear-gradient(45deg, #007bff, #0056b3); border: none; box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);">
                            <i class="fas fa-save me-2"></i>{{ __('Guardar Coordinación') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos adicionales para el formulario minimalista */
.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1) !important;
    border-color: transparent !important;
    background-color: #fff !important;
}

.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23007bff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
}

.form-select:hover {
    background-color: #fff !important;
    transition: all 0.3s ease;
}

.form-label {
    font-size: 0.95rem;
    letter-spacing: 0.3px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4) !important;
    transition: all 0.3s ease;
}

.card {
    border-radius: 16px !important;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.invalid-feedback {
    display: block;
    margin-top: 8px;
    font-size: 0.875rem;
}

/* Estilos específicos para las opciones del select */
.form-select option {
    padding: 10px;
    font-size: 1rem;
}

.form-select option:hover {
    background-color: #007bff;
    color: white;
}
</style>