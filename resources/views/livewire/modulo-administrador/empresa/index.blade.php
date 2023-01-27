<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Data</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Empresa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.empresa.index') }}">Data</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Data
                            </li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-1" style="text-align: right">
        <button type="button" wire:click="cargarDatos({{ $empresa->empresa_id }})" class="btn btn-primary waves-effect" data-bs-toggle="modal"
            data-bs-target="#modalEmpresa">
            Editar
        </button>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="mb-75">Descripción</h5>
            <p class="card-text">
                {{ $empresa->empresa_descripcion }}
            </p>
            <div class="mt-2">
                <h5 class="mb-75">Dirección:</h5>
                <p class="card-text">{{ $empresa->empresa_direccion }}</p>
            </div>
            <div class="mt-2">
                <h5 class="mb-75">Logo:</h5>
                <p class="card-text">
                    <img src="{{ asset($empresa->empresa_logo) }}" alt="Logo" width="100px">
                </p>
            </div>
            <div class="mt-2">
                <h5 class="mb-75">Logo 2:</h5>
                <p class="card-text">
                    <img src="{{ asset($empresa->empresa_logo_2) }}" alt="Logo" width="100px">
                </p>
            </div>
            <div class="mt-2">
                <h5 class="mb-75">Correo:</h5>
                <p class="card-text">{{ $empresa->empresa_correo }}</p>
            </div>
            <div class="mt-2">
                <h5 class="mb-50">Celular:</h5>
                <p class="card-text mb-0">+51 {{ $empresa->empresa_celular }}</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresa"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $titulo }}</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Descripcion <span
                                            class="text-danger">(Obligatorio)</span></label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" rows="10" wire:model="descripcion" placeholder="Ingrese su nombre y apellido"></textarea>
                                    @error('descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Dirección <span
                                            class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        wire:model="direccion" placeholder="Ingrese su dirección">
                                    @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Correo <span
                                            class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('correo') is-invalid @enderror"
                                        wire:model="correo" placeholder="Ingrese su correo">
                                    @error('correo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Celular <span class="text-danger">(Obligatorio)</span></label>
                                    <input type="text" class="form-control @error('celular') is-invalid @enderror" wire:model="celular"
                                        placeholder="Ingrese su celular">
                                    @error('celular')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        wire:model="logo">
                                    @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Foto guardada</label>
                                    <br>
                                    <img src="{{ asset($logo_antiguo) }}" alt="foto" width="60%">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-1">
                                    <label class="form-label">Logo dark</label>
                                    <input type="file" class="form-control @error('logo_dark') is-invalid @enderror" wire:model="logo_dark">
                                    @error('logo_dark')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Foto guardada</label>
                                    <br>
                                    <img src="{{ asset($logo_dark_antiguo) }}" alt="foto" width="60%">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="guardarEmpresa()"
                        class="btn btn-primary waves-effect waves-float waves-light">Guardar</button>
                    <button type="button" wire:click="limpiar()"
                        class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal"
                        aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
