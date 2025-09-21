<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="experiencia_id" class="form-label">{{ __('Experiencia Id') }}</label>
            <input type="text" name="experiencia_id" class="form-control @error('experiencia_id') is-invalid @enderror" value="{{ old('experiencia_id', $experienciaMatrimonio?->experiencia_id) }}" id="experiencia_id" placeholder="Experiencia Id">
            {!! $errors->first('experiencia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="matrimonio_id" class="form-label">{{ __('Matrimonio Id') }}</label>
            <input type="text" name="matrimonio_id" class="form-control @error('matrimonio_id') is-invalid @enderror" value="{{ old('matrimonio_id', $experienciaMatrimonio?->matrimonio_id) }}" id="matrimonio_id" placeholder="Matrimonio Id">
            {!! $errors->first('matrimonio_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>