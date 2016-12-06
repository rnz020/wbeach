<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">
			    {!! Form::open([ 'route' => ['subscription.holdings.store'], 'class' => 'form-horizontal form-modal-left', 'id' => 'form-create' ]) !!}

			        @include('subscription.holdings.partials.modals.form-holding')

			    {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
