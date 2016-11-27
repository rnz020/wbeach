<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">
			    <div class="form-horizontal form-modal-left">
			    
			        <div class="form-group">
			            <label for="name" class="col-sm-4 control-label">NOMBRES DE GRUPO</label>
			            <div class="col-sm-8 control-div">
			                {{ $holding->group_name }}
			            </div>
			        </div>
			        <div class="form-group">
			            <label for="username" class="col-sm-4 control-label">NOMBRE LEGAL</label>
			            <div class="col-sm-8 control-div">
			                {{ $holding->legal_name }}
			            </div>
			        </div>
			        <div class="form-group">
			            <label for="email" class="col-sm-4 control-label">R.U.C.</label>
			            <div class="col-sm-8 control-div">
			                {{ $holding->ruc }}
			            </div>
			        </div>
                                <div class="form-group">
			            <label for="email" class="col-sm-4 control-label">DIRECCIÓN</label>
			            <div class="col-sm-8 control-div">
			                {{ $holding->address }}
			            </div>
			        </div>


			    </div>
			</div>
		</div>
	</div>
</div>
