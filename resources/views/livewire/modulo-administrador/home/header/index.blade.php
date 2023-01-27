<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Header</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Pagina cliente</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.header.index') }}">Header</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Usuarios
                            </li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <strong>Recuerda - Solo pueden estar activos 1 item.</strong>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="mb-1" style="text-align: right">
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalHeader">
                    Nuevo
                </button>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th class="col-md-2">Imagen</th>
                                <th>Titulo</th>
                                <th>Subtitulo</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($home_header as $item)
                            <tr>
                                <td><strong>{{ $item->id }}</strong></td>
                                <td>
                                    <img src="{{ asset($item->imagen) }}" alt="foto" width="150px" class="">
                                </td>
                                <td>{{ $item->titulo }}</td>
                                <td>{{ $item->subtitulo }}</td>
                                <td>
                                    @if ($item->estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarHeader({{ $item->id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalHeader"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($home_header->count() == 0)
                                <tr>
                                    <td colspan="6" class="text-muted text-center fw-bold">No hay registros</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalHeader" tabindex="-1" aria-labelledby="modalHeader" aria-hidden="true">
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
                                    <label class="form-label">Titulo <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" wire:model="titulo" placeholder="Ingrese el titulo">
                                    @error('titulo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Subtitulo <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('subtitulo') is-invalid @enderror" wire:model="subtitulo" placeholder="Ingrese el subtitulo">
                                    @error('subtitulo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Imagen @if($modo == 1) <span class="text-danger">(Obligatorio)</span> @endif</label>
                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" wire:model="imagen">
                                    @error('imagen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($modo == 2)
                                <div class="mb-1">
                                    <label class="form-label">Foto guardada</label>
                                    <br>
                                    <img src="{{ asset($imagen_guardada) }}" alt="foto" width="100%">
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarHeader()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
