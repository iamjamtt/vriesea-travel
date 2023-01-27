<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Video</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Pagina cliente</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.video.index') }}">Video</a>
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
                <button type="button" wire:click="modo()" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#modalVideo">
                    Nuevo
                </button>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1">Nro</th>
                                <th class="col-md-2">Portada</th>
                                <th>Url</th>
                                <th class="col-md-2">Estado</th>
                                <th class="col-md-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($home_video as $item)
                            <tr>
                                <td><strong>{{ $item->id }}</strong></td>
                                <td>
                                    <img src="{{ asset($item->portada) }}" alt="foto" width="150px" class="">
                                </td>
                                <td>{{ $item->url }}</td>
                                <td>
                                    @if ($item->estado == 0)
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->id }})" class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                                    @else
                                        <span style="cursor: pointer" wire:click="cargarAlertaEstado({{ $item->id }})" class="badge rounded-pill badge-light-primary me-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a style="cursor: pointer" wire:click="cargarVideo({{ $item->id }})" class="text-success" data-bs-toggle="modal" data-bs-target="#modalVideo"><i class="ri-edit-line"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if ($home_video->count() == 0)
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
    <div wire:ignore.self class="modal fade text-start" id="modalVideo" tabindex="-1" aria-labelledby="modalVideo" aria-hidden="true">
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
                                    <label class="form-label">Url <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('url') is-invalid @enderror" wire:model="url" placeholder="Ingrese la url de youtube del video">
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Portada @if($modo == 1) <span class="text-danger">(Obligatorio)</span> @endif</label>
                                    <input type="file" class="form-control @error('portada') is-invalid @enderror" wire:model="portada">
                                    @error('portada')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($modo == 2)
                                <div class="mb-1">
                                    <label class="form-label">Portada guardada</label>
                                    <br>
                                    <img src="{{ asset($portada_guardada) }}" alt="foto" width="100%">
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarVideo()" class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
