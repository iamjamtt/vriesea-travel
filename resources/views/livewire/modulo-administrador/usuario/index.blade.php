<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Usuarios</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                            </li>
                            {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                            </li> --}}
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                    Nuevo usuario
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <input type="search" wire:model="buscar" class="form-control" placeholder="Buscar usuario...">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $item)
                            <tr>
                                <td><strong>{{ $item->usuario_id }}</strong></td>
                                <td>
                                    @if ($item->usuario_photo == null)
                                        <img src="{{ asset('photo/photo.png') }}" alt="foto" width="18px" class="rounded-circle me-1">
                                    @else
                                    <img src="{{ asset($item->usuario_photo) }}" alt="foto" width="18px" class="rounded-circle me-1">
                                    @endif
                                    {{ $item->usuario_nombre }}
                                </td>
                                <td>{{ $item->usuario_username }}</td>
                                <td>
                                    @if ($item->usuario_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->usuario_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->usuario_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarUsuario({{ $item->usuario_id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalUsuario"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($usuarios->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-muted text-center fw-bold">No hay registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $titulo }}</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Nombres <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" wire:model="nombres" placeholder="Ingrese su nombre y apellido">
                                    @error('nombres')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Usuario <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('usuario') is-invalid @enderror" wire:model="usuario" placeholder="Ingrese su usuario">
                                    @error('usuario')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Contraseña @if ($modo == 1) <span class="text-danger">(Obligatorio)</span> @endif </label>
                                    <input type="text" class="form-control @error('contraseña') is-invalid @enderror" wire:model="contraseña" placeholder="Ingrese su contraseña">
                                    @error('contraseña')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Foto</label>
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
                    <button type="button" wire:click="guardarUsuario()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
