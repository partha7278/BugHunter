<div class="sidebar-bg">
    <div class="sidebar-menu">
        <p class="sidebar-menu-name">DASHBOARD</p>
        <a href="{{ route('d_testing') }}"><button class="sidebar-btn  @if($page == 'testing')btn-active @endif"><i class="fas fa-flask sidebar-icon"></i>Testing</button></a>
    </div>
    <div class="sidebar-menu">
        <p class="sidebar-menu-name">PROJECT</p>
        <a data-target="#p_newmodal" data-toggle="modal"><button class="sidebar-btn"><i class="fas fa-folder-plus sidebar-icon"></i>New</button></a>
        <a href="{{ route('p_update') }}"><button class="sidebar-btn @if($page == 'p_update')btn-active @endif"><i class="far fa-edit sidebar-icon"></i>Update</button></a>
        <a href="{{ route('p_view') }}"><button class="sidebar-btn @if($page == 'p_view')btn-active @endif"><i class="far fa-eye sidebar-icon"></i>View</button></a>
    </div>
    <div class="sidebar-menu">
        <p class="sidebar-menu-name">BUG</p>
        <a href="{{ route('b_new') }}"><button class="sidebar-btn @if($page == 'b_new')btn-active @endif"><i class="fas fa-folder-plus sidebar-icon"></i>New</button></a>
        <a href="{{ route('b_update') }}"><button class="sidebar-btn @if($page == 'b_update')btn-active @endif"><i class="far fa-edit sidebar-icon"></i>Update</button></a>
    </div>
    <div class="sidebar-menu">
        <p class="sidebar-menu-name hidden-menu1">TOOLS <span class="fas fa-caret-down hidden-menu-icon1"></span></p>
        <div id="hidden-menu-item1">
            <a href="{{ route('toolcors') }}" target="_blank"><button class="sidebar-btn no-logo">CORS</button></a>
            <a href="{{ route('toolclickjacking') }}" target="_blank"><button class="sidebar-btn no-logo">ClickJacking</button></a>
            @foreach($item as $items)
                @if( $items->type == 2 )
                    <a href="{{ $items->url }}" target="_blank"><button class="sidebar-btn no-logo">{{ $items->name }}</button></a>
                @endif
            @endforeach
            <i class="fas fa-plus add-item item-2" data-toggle="modal" data-target="#new-item" onclick="additem(2)"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <p class="sidebar-menu-name hidden-menu2">SITE <span class="fas fa-caret-down hidden-menu-icon2"></span></p>
        <div id="hidden-menu-item2">
            @foreach($item as $items)
                @if( $items->type == 0 )
                    <a href="{{ $items->url }}" target="_blank"><button class="sidebar-btn no-logo">{{ $items->name }}</button></a>
                @endif
            @endforeach
            <i class="fas fa-plus add-item item-0" data-toggle="modal" data-target="#new-item" onclick="additem(0)"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <p class="sidebar-menu-name hidden-menu3">PROGRAM <span class="fas fa-caret-down hidden-menu-icon3"></span></p>
        <div id="hidden-menu-item3">
            @foreach($item as $items)
                @if( $items->type == 1 )
                    <a href="{{ $items->url }}" target="_blank"><button class="sidebar-btn no-logo">{{ $items->name }}</button></a>
                @endif
            @endforeach
            <i class="fas fa-plus add-item item-1" data-toggle="modal" data-target="#new-item" onclick="additem(1)"></i>
        </div>
    </div>
    <br/><br/><br/><br/>
</div>
