<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Rol</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Empresa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.rol.index') }}">Rol</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Rol
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalRol">
                    Nuevo rol
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <input type="search" wire:model="buscar" class="form-control" placeholder="Buscar rol...">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th>Rol</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                            <tr>
                                <td><strong>{{ $item->rol_id }}</strong></td>
                                <td>{{ $item->rol }}</td>
                                <td>
                                    @if ($item->rol_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->rol_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->rol_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarRol({{ $item->rol_id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalRol"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($roles->count() == 0)
                            <tr>
                                <td colspan="4">
                                    <div class="text-muted text-center">
                                        <strong>No se encontraron registros</strong>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalRol" tabindex="-1" aria-labelledby="modalRol" aria-hidden="true">
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
                                    <label class="form-label">Rol <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('rol') is-invalid @enderror" wire:model="rol" placeholder="Ingrese el rol">
                                    @error('rol')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarRol()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
