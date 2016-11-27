@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
            <a href="http://admindesigns.com/demos/absolute/1.1/dashboard.html">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <a href="http://admindesigns.com/demos/absolute/1.1/dashboard.html">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </li>
        <li class="crumb-link">
            <a href="http://admindesigns.com/demos/absolute/1.1/index.html">Home1</a>
        </li>
        <li class="crumb-trail">Dashboard</li>
    </ol>
@endsection

@section('topbar')
    <div class="ib topbar-dropdown">
        <label for="topbar-multiple" class="control-label pr10 fs11 text-muted">Reporting Period</label>
            <select id="topbar-multiple" class="hidden" style="display: none;">
              <optgroup label="Filter By:">
                <option value="1-1">Last 30 Days</option>
                <option value="1-2" selected="selected">Last 60 Days</option>
                <option value="1-3">Last Year</option>
              </optgroup>
            </select>
                <div class="btn-group">
                    <button type="button" class="multiselect dropdown-toggle btn btn-default btn-sm ph15" data-toggle="dropdown" title="Last 30 Days" aria-expanded="false">
                        Last 30 Days <b class="caret"></b>
                    </button>
                    <ul class="multiselect-container dropdown-menu pull-right">
                        <li class="multiselect-item multiselect-group">
                            <label>Filter By:</label>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0);">
                                <label class="radio"><input type="radio" value="1-1"> Last 30 Days</label>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);">
                                <label class="radio"><input type="radio" value="1-2"> Last 60 Days</label>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <label class="radio">
                                    <input type="radio" value="1-3"> Last Year</label>
                            </a>
                        </li>
                    </ul>
                </div>
    </div>
    <div class="ml15 ib va-m" id="toggle_sidemenu_r">
            <a href="#">
              <i class="ad ad-sort"></i>
              <span class="badge badge-warning badge-hero">3</span>
            </a>
    </div>
@endsection


@section('content')
<div class="row">
    Welcome
    {{ app_path("modules") }}
</div>
@endsection
