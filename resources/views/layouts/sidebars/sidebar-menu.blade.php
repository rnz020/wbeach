
        @if (isset($menu['children'])) 
            <li class="panel panel-default dropdown">
            <a data-toggle="collapse" href="#dropdown-{{ $menu['id'] }}"> 
        @else 
            <li>
            <a href="{{ $menu['url']?route($menu['url']):'#' }}"> 
        @endif
        
        @if ($menu['icon']) 
            <span class="icon {{ $menu['icon'] }}"></span>
        @endif    
            <span style="word-break: break-all" class="title">{{ $menu['display_name'] }}</span>     
            </a>
                
	@if (isset($menu['children']))
	    <div id="dropdown-{{ $menu['id'] }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                        @foreach($menu['children'] as $menu)
                            @include('layouts.sidebar-menu', $menu)
                        @endforeach
	            </ul>
                </div>
            </div>            
        @endif
            </li>