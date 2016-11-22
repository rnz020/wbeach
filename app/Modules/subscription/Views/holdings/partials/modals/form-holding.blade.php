<div class="form-group">
    <label for="name" class="col-sm-4 control-label">NOMBRE DE GRUPO</label>
    <div class="col-sm-8">
        {{ Form::text('group_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de grupo', 'maxlength' => 200]) }}
    </div>
</div>
<div class="form-group">
    <label for="username" class="col-sm-4 control-label">NOMBRE LEGAL</label>
    <div class="col-sm-8">
        {{ Form::text('legal_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre legal', 'maxlength' => 200]) }}
    </div>
</div>
<div class="form-group">
    <label for="ruc" class="col-sm-4 control-label">R.U.C.</label>
    <div class="col-sm-8">
        {{ Form::text('ruc', null, ['class' => 'form-control', 'placeholder' => 'R.U.C.', 'maxlength' => 11]) }}
    </div>
</div>
<div class="form-group">
    <label for="ruc" class="col-sm-4 control-label">DIRECCIÓN</label>
    <div class="col-sm-8">
        {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Dirección', 'maxlength' => 200]) }}
    </div>
</div>
