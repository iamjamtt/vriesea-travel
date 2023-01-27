<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Tipo de Producto</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Productos / Servicios</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tipo-producto.index') }}">Tipo de Producto</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Tipo Producto
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalTipoProducto">
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
                                <th>Tipo de Producto</th>
                                <th class="col-md-2">Slug</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipo_producto_model as $item)
                            <tr>
                                <td><strong>{{ $item->tipo_id }}</strong></td>
                                <td>{{ $item->tipo }}</td>
                                <td>{{ $item->tipo_slug }}</td>
                                <td>
                                    @if ($item->tipo_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->tipo_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->tipo_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarTipoProducto({{ $item->tipo_id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalTipoProducto"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($tipo_producto_model->count() == 0)
                                <tr>
                                    <td colspan="4" class="text-muted text-center fw-bold">No hay registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalTipoProducto" tabindex="-1" aria-labelledby="modalTipoProducto" aria-hidden="true">
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
                                    <label class="form-label">Tipo de producto y/o servicio <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('tipo_producto') is-invalid @enderror" wire:model="tipo_producto" placeholder="Ingrese el tipo de producto">
                                    @error('tipo_producto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Slug <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" placeholder="Ingrese el slug del tipo de producto">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarTipoProducto()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
