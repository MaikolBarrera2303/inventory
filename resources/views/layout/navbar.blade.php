    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if(auth()->user()->role_id === 1)
                        <li class="nav-item dropdown ml-12" style="margin-left: 40px">
                            <a class="nav-link" href="{{ route("users.index") }}">
                                <i class="bi bi-person-fill" style="color: #6f42c1"></i>
                                <span class="h6">Usuarios</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown ml-12" style="margin-left: 40px">
                        <a class="nav-link" href="{{ route("responsibles.index") }}">
                            <i class="bi bi-people-fill" style="color: #6f42c1"></i>
                            <span class="h6">Responsables</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown" style="margin-left: 40px">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-pc-display" style="color: #6f42c1"></i>
                            <span class="h6">Dispositivos</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route("devices.index") }}">
                                    <i class="bi bi-laptop" style="color: #6f42c1"></i>
                                    <span class="h6">Inventario</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route("accessories.index") }}">
                                    <i class="bi bi-mouse" style="color: #6f42c1"></i>
                                    <span class="h6">Accesorios</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route("type-devices.index") }}">
                                    <i class="bi bi-display" style="color: #6f42c1"></i>
                                    <span class="h6">Tipo Dispositivo</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown ml-12" style="margin-left: 40px">
                        <a class="nav-link" href="#">
                            <i class="bi bi-postcard-fill"></i>
                            Licencias
                        </a>
                    </li>

                </ul>
                <form class="d-flex" method="post" action="{{ route("logout") }}">
                    @csrf
                    <span class="me-5" style="margin-top: 6px">{{ auth()->user()->name  }}</span>
                    <button class="btn btn-outline-danger" type="submit">Cerrar sesion</button>
                </form>
            </div>
        </div>
    </nav>
