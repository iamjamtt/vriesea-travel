<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Producto</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Producto / Servicio</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.producto.index') }}">Producto</a>
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalProducto">
                    Nuevo producto
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
                                <th>Titulo</th>
                                <th>Precio</th>
                                <th>Hora</th>
                                <th>Tipo</th>
                                <th class="col-md-1">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $item)
                            <tr>
                                <td><strong>{{ $item->producto_id }}</strong></td>
                                <td>{{ $item->producto_titulo }}</td>
                                <td>
                                    Persona: S/. {{ $item->producto_precio }} <br> Grupo: S/. {{ $item->producto_precio_grupo }}
                                </td>
                                <td>{{ date('h:i a', strtotime($item->producto_hora_inicio)) }} a {{ date('h:i a', strtotime($item->producto_hora_fin)) }}</td>
                                <td>{{ $item->tipo_producto->tipo }}</td>
                                <td>
                                    @if ($item->producto_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->producto_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->producto_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarProducto({{ $item->producto_id }},1)" class="text-success" data-bs-toggle="modal" data-bs-target="#modalProducto"><i class="ri-edit-line"></i></a>
                                    <a style="cursor: pointer" wire:click="cargarProducto({{ $item->producto_id }},3)" class="text-success" data-bs-toggle="modal" data-bs-target="#modalProductoLugares"><i class="ri-map-pin-add-line"></i></a>
                                    <a style="cursor: pointer" wire:click="cargarProducto({{ $item->producto_id }},4)" class="text-secondary" data-bs-toggle="modal" data-bs-target="#modalProductoIncluye"><i class="ri-menu-add-line"></i></a>
                                </td>
                            </tr>
                            @endforeach

                            @if ($productos->count() == 0)
                                <tr>
                                    <td colspan="7" class="text-muted text-center fw-bold">No hay registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalProducto" tabindex="-1" aria-labelledby="modalProducto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $titulo_modal }}</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Titulo <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" wire:model="titulo" placeholder="Ingrese el titulo del producto">
                                    @error('titulo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Precio <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="number" class="form-control @error('precio') is-invalid @enderror" wire:model="precio" placeholder="Ingrese el precio">
                                    @error('precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Precio por grupo <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="number" class="form-control @error('precio_grupo') is-invalid @enderror" wire:model="precio_grupo" placeholder="Ingrese el precio del grupo">
                                    @error('precio_grupo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Hora inicio <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" wire:model="hora_inicio" placeholder="Ingrese la hora inicio">
                                    @error('hora_inicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Hora fin <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" wire:model="hora_fin" placeholder="Ingrese la hora final">
                                    @error('hora_fin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Tipo de producto <span class="text-danger">(Obligatorio)</span></label>
                                    <select class="form-select @error('tipo_producto') is-invalid @enderror" wire:model="tipo_producto">
                                        <option value="">Seleccione</option>
                                        @foreach ($tipo_productos as $item)
                                            <option value="{{ $item->tipo_id }}">{{ $item->tipo }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_producto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarProducto()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para ingresar los lugares de los productos --}}
    <div wire:ignore.self class="modal fade text-start" id="modalProductoLugares" tabindex="-1" aria-labelledby="modalProductoLugares" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ingresar lugares</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Lugares <span class="text-danger">(Obligatorio)</span></label>
                                    <select type="text" class="form-select @error('lugares') is-invalid @enderror" wire:model="lugares">
                                        <option value="">Seleccione el lugar</option>
                                        @foreach ($lugar_model as $item)
                                            <option value="{{ $item->lugar_id }}">{{ $item->lugar }}</option>
                                        @endforeach
                                    </select>
                                    @error('lugares')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Nro</th>
                                            <th>Lugar</th>
                                            <th class="col-md-2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($producto_lugar_model)
                                            @foreach ($producto_lugar_model as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->lugar->lugar }}</td>
                                                    <td>
                                                        <button type="button" wire:click="eliminarLugar({{ $item->producto_lugar_id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($producto_lugar_model->count() == 0)
                                                <tr>
                                                    <td colspan="3" class="text-muted text-center fw-bold">No hay registros</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarLugares()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para ingresar lo que incluye de los productos --}}
    <div wire:ignore.self class="modal fade text-start" id="modalProductoIncluye" tabindex="-1" aria-labelledby="modalProductoIncluye" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ingresar extra</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Incluye <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('incluye') is-invalid @enderror" wire:model="incluye" placeholder="Ingresar lo que incluye el producto">
                                    @error('incluye')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Nro</th>
                                            <th>Incluye</th>
                                            <th class="col-md-2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $incluye_model = App\Models\ProductoIncluye::where('producto_id', $producto_id)->where('producto_incluye_estado', 1)->get();
                                        @endphp
                                        @foreach ($incluye_model as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->producto_incluye }}</td>
                                                <td>
                                                    <button type="button" wire:click="eliminarIncluye({{ $item->producto_incluye_id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($incluye_model->count() == 0)
                                            <tr>
                                                <td colspan="3" class="text-muted text-center fw-bold">No hay registros</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarIncluye()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
