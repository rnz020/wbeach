<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">

			    {!! Form::model($holding, [ 'route' => ['subscription.holdings.update', $holding->id], 'class' => 'form-horizontal form-modal-left' , 'id' => 'form-update', 'method' => 'PATCH']) !!}

			        @include('Subscription::holdings.partials.modals.form-holding')

			    {!! Form::close() !!}

			</div>
		</div>
	</div>
</div>
