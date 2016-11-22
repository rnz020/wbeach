
<nav class="navbar navbar-default" role="navigation">
    <div class="side-menu-container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <div class="icon fa fa-paper-plane"></div>
                <span class="title">FITEL</span>
            </a>
            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav">
            @each('layouts.sidebar-menu', $sidebarMenu, 'menu', 'layouts.sidebar-menu-none')
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
