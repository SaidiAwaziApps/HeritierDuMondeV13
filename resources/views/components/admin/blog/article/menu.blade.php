<div class="dropdown">
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm active dropdown-toggle" data-bs-toggle="dropdown">
            <span>
                <i class="fa fa-list"></i>
            </span>        
        </button>
        <!-- Menu -->
        <ul class="dropdown-menu">
            <li class="dropdown-item" style="font-size: 20px;font-weight: bold;font-family: italic;opacity: 0.8;">
                Options <i class="fa fa-angle-down" style="opacity: 0.5;"></i>
            </li>
            <li class="dropdown-divider"></li>

            @if(Route::currentRouteName() != 'admin.article.list')
                <li class="dropdown-item">
                    <div class="d-grid">
                        <a href="{{ route('admin.article.list') }}" class="btn btn-default btn-sm" style="border: 1px solid #f8f8ff;">
                            <span style="font-size: 18px;font-family: italic;">
                                <i class="fa fa-list" style="opacity: 0.4;"></i> List
                            </span>
                        </a>
                    </div>    
                </li>
                @if(Route::currentRouteName() == 'admin.article.update_page' && Auth::user()->hasAccessToRessource('blog','register','allowed'))
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item">
                        <div class="d-grid">
                            <a href="{{ route('admin.article.register_page') }}" class="btn btn-default btn-sm" style="border: 1px solid #f8f8ff;">
                                <span style="font-size: 18px;font-family: italic;">
                                    <i class="fa fa-book" style="opacity: 0.4;"></i> New
                                </span>
                            </a>
                        </div>    
                    </li>
                @endif
            @else 
                @if(Auth::user()->hasAccessToRessource('blog','register','allowed'))
                <li class="dropdown-item">
                    <div class="d-grid">
                        <a href="{{ route('admin.article.register_page') }}" class="btn btn-default btn-sm" style="border: 1px solid #f8f8ff;">
                            <span style="font-size: 18px;font-family: italic;">
                                <i class="fa fa-book" style="opacity: 0.4;"></i> New
                            </span>
                        </a>
                    </div>    
                </li>
                @endif
            @endif


            @if(Auth::user()->hasRole('admin'))
            <li class="dropdown-divider"></li>
            <li class="dropdown-item">
                <div class="d-grid">
                    <a href="{{ $regulation ? route('admin.regulation.update_page',['id'=>1]) : route('admin.regulation.register') }}" class="btn btn-default btn-sm" style="border: 1px solid #f8f8ff;">
                        <span style="font-size: 18px;font-family: italic;">
                            <i class="fas fa-cog" style="opacity: 0.4;"></i> Moderation
                        </span>
                    </a>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div> 