<div class="col-12 mb-3">
    <div class="form-section-title">
        <div class="section-icon"><i class="fas fa-chart-line"></i></div>
        <div>
            <h6 class="mb-0">Demanda y stock</h6>
            <small>Parámetros base del cálculo de redistribución.</small>
        </div>
    </div>
</div>

<div class="form-group col-md-6">
    {!! Form::label('metodo_demanda', 'Método de demanda') !!}
    {!! Form::text('metodo_demanda', null, ['class' => 'form-control', 'required', 'maxlength' => 20]) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('porcentaje_demanda', 'Porcentaje de demanda') !!}
    {!! Form::number('porcentaje_demanda', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('stock_minimo', 'Stock mínimo') !!}
    {!! Form::number('stock_minimo', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('stock_maximo', 'Stock máximo') !!}
    {!! Form::number('stock_maximo', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('venta_minima', 'Venta mínima') !!}
    {!! Form::number('venta_minima', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('porcentaje_necesidad', 'Porcentaje de necesidad') !!}
    {!! Form::number('porcentaje_necesidad', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('porcentaje_conservar_origen', 'Porcentaje a conservar en origen') !!}
    {!! Form::number('porcentaje_conservar_origen', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('cantidad_minima', 'Cantidad mínima') !!}
    {!! Form::number('cantidad_minima', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('cantidad_maxima', 'Cantidad máxima') !!}
    {!! Form::number('cantidad_maxima', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('dias_bloqueo', 'Días de bloqueo') !!}
    {!! Form::number('dias_bloqueo', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-12 mt-2 mb-3">
    <div class="form-section-title">
        <div class="section-icon"><i class="fas fa-lock"></i></div>
        <div>
            <h6 class="mb-0">Restricciones</h6>
            <small>Estados que deben excluirse o bloquearse durante el análisis.</small>
        </div>
    </div>
</div>

@foreach ([
    'bloquear_pendientes' => 'Bloquear pendientes',
    'bloquear_en_proceso' => 'Bloquear en proceso',
    'bloquear_finalizados_recientes' => 'Bloquear finalizados recientes',
    'activo' => 'Configuración activa',
] as $field => $label)
    <div class="form-group col-md-6">
        <div class="custom-control custom-checkbox">
            {!! Form::hidden($field, 0) !!}
            {!! Form::checkbox($field, '1', null, ['class' => 'custom-control-input', 'id' => $field]) !!}
            {!! Form::label($field, $label, ['class' => 'custom-control-label']) !!}
        </div>
    </div>
@endforeach
