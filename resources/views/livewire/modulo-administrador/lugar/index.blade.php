<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Lugares</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Productos / Servicios</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lugar.index') }}">Lugares</a>
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalLugar">
                    Nuevo lugar
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
                                <th>Lugar</th>
                                <th class="col-md-2">Slug</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lugares as $item)
                            <tr>
                                <td><strong>{{ $item->lugar_id }}</strong></td>
                                <td>{{ $item->lugar }}</td>
                                <td>{{ $item->lugar_slug }}</td>
                                <td>
                                    @if ($item->lugar_estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->lugar_id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->lugar_id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarLugar({{ $item->lugar_id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalLugar"><i class="ri-edit-line"></i></a>
                                    <a style="cursor: pointer" wire:click="cargarLugarImagen({{ $item->lugar_id }})" class="text-info" data-bs-toggle="modal" data-bs-target="#modalLugarImagen"><i class="ri-image-add-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($lugares->count() == 0)
                            <tr>
                                <td colspan="5">
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
    <div wire:ignore.self class="modal fade text-start" id="modalLugar" tabindex="-1" aria-labelledby="modalLugar" aria-hidden="true">
        <div class="modal-dialog">
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
                                    <label class="form-label">Lugar <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('lugar') is-invalid @enderror" wire:model="lugar" placeholder="Ingrese el lugar">
                                    @error('lugar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Slug <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug" placeholder="Ingrese el slug">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($modo == 1)
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Imagenes <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="file" class="form-control @error('imagenes') is-invalid @enderror" wire:model="imagenes" multiple accept="images/*">
                                    @error('imagenes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                    @if ($modo == 1)
                    <div class="mb-1">
                        <label class="form-label fw-bold">Imagines por ingresadas</label>
                        <div class="row">
                            @foreach ($imagenes as $item)
                                <div class="col-md-3 col-sm-4 mt-1">
                                        <img src="{{ $item->temporaryUrl() }}" class="rounded w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarLugar()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Imagenes -->
    <div wire:ignore.self class="modal fade text-start" id="modalLugarImagen" tabindex="-1" aria-labelledby="modalLugarImagen" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ingresar imagenes</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label class="form-label fw-bold">Imagines ingresadas</label>
                        <div class="row">
                            @if ($lugar_imagenes)
                            @foreach ($lugar_imagenes as $item)
                                <div class="col-md-2 col-sm-4">
                                    <div class="card mt-1">
                                        <img class="card-img-top img-fluid" src="{{ asset($item->lugar_imagen) }}" alt="...">
                                        @if ($item->lugar_imagen_estado == 1)
                                            <button type="button" wire:click="cambiarEstadoImagen({{ $item->lugar_imagen_id }})" class="btn btn-success btn-sm">Activo</button>
                                        @else
                                            <button type="button" wire:click="cambiarEstadoImagen({{ $item->lugar_imagen_id }})" class="btn btn-danger btn-sm">Inactivo</button>
                                        @endif
                                        <button type="button" wire:click="eliminarImagen({{ $item->lugar_imagen_id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Imagenes <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="file" class="form-control @error('imagenes') is-invalid @enderror" wire:model="imagenes" multiple accept="images/*">
                                    @error('imagenes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mb-1">
                        <label class="form-label fw-bold">Imagines por ingresadas</label>
                        <div class="row">
                            @foreach ($imagenes as $item)
                                <div class="col-md-4 col-lg-2 col-sm-4 mt-1">
                                        <img src="{{ $item->temporaryUrl() }}" class="rounded w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarImagenes()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
