<div>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Mensajes</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.message.index') }}">Mensajes</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Usuarios
                            </li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group">
        @foreach ($mensajes as $item)
            <a href="#modalMensaje" wire:click="cargarMensaje({{ $item->message_id }})" class="list-group-item list-group-item-action pt-2" data-bs-toggle="modal" data-bs-target="#modalMensaje">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $item->message_nombres }}</h5>
                    <small class="text-secondary">
                        @if ($item->message_estado == 0)
                            <span class="badge bg-danger me-1">No leído</span>
                        @endif
                        @if ($item->message_estado == 1)
                            <span class="badge bg-success me-1">Leído</span>
                        @endif
                        @if ($item->message_estado == 2)
                            <span class="badge bg-primary me-1">Respondido</span>
                        @endif
                        {{ $item->message_creacion->diffForHumans() }}
                    </small>
                </div>
                <p class="card-text fs-4 fw-bold mt-1">
                    {{ $item->message_asunto }}
                </p>
                <p class="text-text text-truncate">{{ $item->message_texto }}</p>
            </a>
        @endforeach
        @if ($mensajes->count() == 0)
        <div class="alert alert-secondary alert-validation-msg p-1" role="alert">
            <div class="alert-body d-flex align-items-center">
                <span>No hay mensajes registrados.</span>
            </div>
        </div>
        @endif
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade text-start" id="modalMensaje" tabindex="-1" aria-labelledby="modalMensaje" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensaje de {{ $nombre }}</h4>
                    <button type="button" class="btn-close" wire:click="limpiar()" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-1">
                        <div>
                            <span class="fw-bold">Correo:</span> {{ $correo }}
                        </div>
                        <div>
                            <span class="fw-bold">Asunto:</span> {{ $asunto }}
                        </div>
                    </div>
                    <hr>
                    <div class="mt-1">
                        <div>
                            @if ($estado == 0)
                            <span class="badge bg-danger me-1">No leído</span>
                        @endif
                        @if ($estado == 1)
                            <span class="badge bg-success me-1">Leído</span>
                        @endif
                        @if ($estado == 2)
                            <span class="badge bg-primary me-1">Respondido</span>
                        @endif
                            @if ($hora)
                            {{ $hora->diffForHumans() }}
                            @endif
                        </div>
                        <div class="card mt-1">
                            <div class="card-body">
                                <p class="card-text">{{ $texto }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect waves-float waves-light" disabled>Responder</button>
                    <button type="button" wire:click="limpiar()"  class="btn btn-outline-danger waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
