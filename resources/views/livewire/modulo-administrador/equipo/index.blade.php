<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Equipo</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Empresa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.equipo.index') }}">Equipo</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Usuarios
                            </li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="mb-1" style="text-align: right">
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalEquipo">
                    Nuevo integrante
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <input type="search" wire:model="buscar" class="form-control" placeholder="Buscar intengrante...">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th>Nombres y Apellidos</th>
                                <th class="col-md-1">DNI</th>
                                <th class="col-md-1">Rol</th>
                                <th>Correo</th>
                                <th>Foto</th>
                                <th class="col-md-1">Estado</th>
                                <th>Registro</th>
                                <th class="col-md-1">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $item)
                            <tr>
                                <td><strong>{{ $item->equipo_id }}</strong></td>
                                <td>{{ $item->equipo_nombre_completo }}</td>
                                <td>{{ $item->equipo_dni }}</td>
                                <td>
                                    @php
                                        $equipo_rol_model = App\Models\EquipoRol::where('equipo_id', $item->equipo_id)->get();
                                    @endphp
                                    @foreach ($equipo_rol_model as $item2)
                                        <span class="badge rounded-pill badge-light-info me-1">{{ $item2->rol->rol }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $item->equipo_correo }}</td>
                                <td>
                                    <img src="{{ asset( $item->equipo_foto) }}" alt="" width="50px">
                                </td>
                                <td>
                                    @if ($item->equipo_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->equipo_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->equipo_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>{{ $item->equipo_registro }}</td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarEquipo({{ $item->equipo_id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalEquipo"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($equipos->count() == 0)
                                <tr>
                                    <td colspan="9" class="text-muted text-center fw-bold">No hay registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalEquipo" tabindex="-1" aria-labelledby="modalEquipo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $titulo }}</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Nombres <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" wire:model="nombres" placeholder="Ingrese sus nombres">
                                    @error('nombres')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Apellidos <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" wire:model="apellidos" placeholder="Ingrese sus apellidos">
                                    @error('apellidos')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">DNI <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('dni') is-invalid @enderror" wire:model="dni" placeholder="Ingrese su dni">
                                    @error('dni')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Edad <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="number" class="form-control @error('edad') is-invalid @enderror" wire:model="edad" placeholder="Ingrese su edad">
                                    @error('edad')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Correo <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror" wire:model="correo" placeholder="Ingrese su correo">
                                    @error('correo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Rol <span class="text-danger">(Obligatorio)</span></label>
                                    <div class="demo-inline-spacing">
                                        @foreach ($rol_model as $item2)
                                        <div class="form-check form-check-info">
                                            <input type="checkbox" class="form-check-input @error('rol') is-invalid @enderror" wire:model="rol" value="{{ $item2->rol_id }}">
                                            <label class="form-check-label">{{ $item2->rol }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('rol')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Foto <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" wire:model="foto">
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($modo == 2)
                                <div class="mb-1">
                                    <label class="form-label">Foto guardada</label>
                                    <br>
                                    <img src="{{ asset($foto_guardada) }}" alt="foto" width="70px">
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarEquipo()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
