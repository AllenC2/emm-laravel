<div class="form-container">
    <div class="form-content">
        
        <!-- Campo Nombre -->
        <div class="form-field">
            <label for="nombre" class="field-label">{{ __('Nombre de la Comunidad') }}</label>
            <div class="input-wrapper">
                <input type="text" 
                       name="nombre" 
                       class="field-input @error('nombre') error @enderror" 
                       value="{{ old('nombre', $comunidade?->nombre) }}" 
                       id="nombre" 
                       placeholder="Ingrese el nombre de la comunidad"
                       autocomplete="off">
                <div class="input-focus-border"></div>
            </div>
            @error('nombre')
                <div class="error-message">
                    <i class="error-icon">⚠</i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Campo Sacerdote -->
        <div class="form-field">
            <label for="sacerdote_id" class="field-label">{{ __('Sacerdote Asignado') }}</label>
            <div class="select-wrapper">
                <select name="sacerdote_id" 
                        class="field-select @error('sacerdote_id') error @enderror" 
                        id="sacerdote_id">
                    <option value="" disabled {{ !old('sacerdote_id', $comunidade?->sacerdote_id) ? 'selected' : '' }}>
                        {{ __('Seleccionar un sacerdote') }}
                    </option>
                    @foreach($sacerdotes as $sacerdote)
                        <option value="{{ $sacerdote->id }}" 
                                {{ old('sacerdote_id', $comunidade?->sacerdote_id) == $sacerdote->id ? 'selected' : '' }}>
                            {{ $sacerdote->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="select-arrow">
                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            @error('sacerdote_id')
                <div class="error-message">
                    <i class="error-icon">⚠</i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

    </div>
    
    <!-- Botón de Envío -->
    <div class="form-actions">
        <button type="submit" class="submit-btn">
            <span class="btn-text">{{ isset($comunidade) && $comunidade->exists ? __('Actualizar Comunidad') : __('Crear Comunidad') }}</span>
            <div class="btn-loading" style="display: none;">
                <div class="spinner"></div>
            </div>
        </button>
    </div>
</div>

<style>
.form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 2rem;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.form-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-field {
    position: relative;
}

.field-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    letter-spacing: 0.025em;
}

.input-wrapper {
    position: relative;
}

.field-input {
    width: 100%;
    padding: 0.875rem 1rem;
    font-size: 0.95rem;
    color: #1f2937;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
}

.field-input:focus {
    border-color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.field-input.error {
    border-color: #ef4444;
    background-color: #fef2f2;
}

.input-focus-border {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8);
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 1px;
}

.field-input:focus + .input-focus-border {
    width: 100%;
}

.select-wrapper {
    position: relative;
}

.field-select {
    width: 100%;
    padding: 0.875rem 2.5rem 0.875rem 1rem;
    font-size: 0.95rem;
    color: #1f2937;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.2s ease;
    outline: none;
    appearance: none;
    cursor: pointer;
    font-family: inherit;
}

.field-select:focus {
    border-color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.field-select.error {
    border-color: #ef4444;
    background-color: #fef2f2;
}

.select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
    transition: color 0.2s ease;
}

.field-select:focus + .select-arrow {
    color: #3b82f6;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    color: #ef4444;
    font-size: 0.875rem;
    font-weight: 500;
}

.error-icon {
    font-size: 0.875rem;
}

.form-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f3f4f6;
}

.submit-btn {
    width: 100%;
    position: relative;
    padding: 1rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: #ffffff;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    letter-spacing: 0.025em;
    overflow: hidden;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

.submit-btn:active {
    transform: translateY(0);
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-text {
    transition: opacity 0.2s ease;
}

.btn-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 640px) {
    .form-container {
        margin: 1rem;
        padding: 1.5rem;
        border-radius: 12px;
    }
    
    .form-content {
        gap: 1.5rem;
    }
    
    .field-input,
    .field-select {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    
    .field-select {
        padding-right: 2.25rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .form-container {
        background: #1f2937;
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
    }
    
    .field-label {
        color: #f3f4f6;
    }
    
    .field-input,
    .field-select {
        background: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
    }
    
    .field-input:focus,
    .field-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 4px 12px rgba(96, 165, 250, 0.2);
    }
    
    .form-actions {
        border-color: #374151;
    }
}

/* Focus trap and accessibility */
.field-input:focus,
.field-select:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}

/* Smooth transitions for better UX */
* {
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}
</style>