<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini"><i class="fas fa-cat"></i></a>
            <a href="#" class="simple-text logo-normal">{{ _('Principal') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="fas fa-cat"></i>
                    <p>{{ _('Principal') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#users" aria-expanded="true">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-text" >{{ __('Usuarios') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="fas fa-id-card-alt"></i>
                                <p>{{ _('Perfil') }}</p>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('Mostrar-Usuario'))
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="fas fa-user"></i>
                                <p>{{ _('Usuarios') }}</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasPermission('Mostrar-Rol'))
                        <li @if ($pageSlug == 'permission') class="active " @endif>
                            <a href="{{ route('permission.index')  }}">
                                <i class="fas fa-users-cog"></i>
                                <p>{{ _('Roles') }}</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#catalogos" aria-expanded="true">
                    <i class="fas fa-carpet"></i>
                    <span class="nav-link-text" >{{ __('Catalogos') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                @if(auth()->user()->hasPermission('Mostrar-Lote'))
                <div class="collapse show" id="lotes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'Lotes') class="active " @endif>
                            <a href="{{ route('lote.index')  }}">
                                <i class="fas fa-box"></i>
                                <p>{{ _('Lotes') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
                @endif
            </li>
        </ul>
    </div>
</div>
