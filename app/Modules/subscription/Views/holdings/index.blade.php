@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
            <a href="http://admindesigns.com/demos/absolute/1.1/dashboard.html">Holding</a>
        </li>
        <li class="crumb-icon">
            <a href="http://admindesigns.com/demos/absolute/1.1/dashboard.html">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </li>
        <li class="crumb-link">
            <a href="http://admindesigns.com/demos/absolute/1.1/index.html">Subscripción</a>
        </li>
        <li class="crumb-trail">Holding</li>
    </ol>
    <div class="topbar-right hidden-xs hidden-sm">
<!--        <a href="ecommerce_orders.html" class="btn btn-default btn-sm fw600 ml10">
            <span class="fa fa-plus pr5"></span> Nuevo Holding
        </a>-->

        <button class="btn btn-primary btn-sm fw600 ml10" id="new-entity">Nuevo Holding</button>
   </div>
@endsection

@section('topbar')
@endsection


@section('content')

<div class="row">
    <div class="tray tray-center" style="height: 653px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-visible" id="spy3">
                    <div class="panel-heading">
                        <div class="panel-title hidden-xs">
                            <span class="glyphicon glyphicon-search"></span>Busqueda
                        </div>
                    </div>
                    <div class="panel-body pn">
                        <div id="datatable3_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="dt-panelmenu clearfix">
                                <form class="form-inline" id="form-search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="group_name" id="txt_group_name" placeholder="Nombre de grupo " maxlength="80">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="legal_name" id="txt_legal_name" placeholder="Nombre legal " maxlength="30">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="ruc" id="txt_ruc" placeholder="RUC" maxlength="80">
                                    </div>
                                    <button type="submit" class="btn btn-default" id="button-search">BUSCAR</button>
                                </form>
                            </div>
                            <div class="content-kendo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

<!-- DELETE FORM -->
{!! Form::open([ 'route' => ['subscription.holdings.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}

{!! Form::close() !!}

@endsection

@section('js-libraries')
    @include('scripts.jquery-validation')
@endsection

@section('scripts')
    <script id="command-template" type="text/x-kendo-template">
        <a title="Detalle"  href="\#" class="show-entity kendo-buttons">
            <i class="fa fa-lg fa-info"></i>
        </a>
        <a title="Editar"   href="\#" class="edit-entity kendo-buttons">
            <i class="fa fa-lg fa-pencil"></i>
        </a>
        <a title="Eliminar" href="\#" class="delete-entity kendo-buttons">
            <i class="fa fa-lg fa-trash"></i>
        </a>
    </script>

    <script type="text/javascript">

        var url_create_holding_form   = "{{ route('subscription.holdings.create') }}";
        var url_show_holding_form     = "{{ route('subscription.holdings.show', ":ROW_ID") }}";
        var url_edit_holding_form     = "{{ route('subscription.holdings.edit', ":ROW_ID") }}";
        var url_load_holding          = "{{ route('subscription.holdings.load') }}";
        var entity_title              = 'HOLDING';

    </script>

     <script type="text/javascript" src="{{ asset('js/subscription/holding/index.js') }}"></script>
@endsection
