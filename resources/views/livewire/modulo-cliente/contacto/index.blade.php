<div>
    <div class="ratio ratio-16:9">
        <div class="map-ratio">
            <div class="map js-map-single"></div>
        </div>
    </div>

    <section>
        <div class="relative container">
            <div class="row justify-end">
                <div class="col-xl-5 col-lg-7">
                    <div class="map-form px-40 pt-40 pb-50 lg:px-30 lg:py-30 md:px-24 md:py-24 bg-white rounded-4 shadow-4">
                        <div class="text-22 fw-500">
                            Envianos un mensaje
                        </div>

                        <div class="row y-gap-20 pt-20">
                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="text" wire:model="nombres" class="form-control @error('nombres') is-invalid @enderror">
                                    <label class="lh-1 text-16 text-light-1">Nombres y Apellidos</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="text" wire:model="correo" class="form-control @error('correo') is-invalid @enderror">
                                    <label class="lh-1 text-16 text-light-1">Correo electrónico *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="text" wire:model="celular" class="form-control @error('celular') is-invalid @enderror">
                                    <label class="lh-1 text-16 text-light-1">Número de celular</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input ">
                                    <input type="text" wire:model="asunto" class="form-control @error('asunto') is-invalid @enderror">
                                    <label class="lh-1 text-16 text-light-1">Asunto *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input ">
                                    <textarea rows="6" cols="20" wire:model="mensaje" class="form-control @error('mensaje') is-invalid @enderror"></textarea>
                                    <label class="lh-1 text-16 text-light-1">Mensaje *</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="button" wire:click="enviarMensajeCliente()" class="button px-24 h-50 -dark-1 bg-blue-1 text-white">
                                    Enviar mensaje <div class="icon-arrow-top-right ml-15"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-md layout-pb-lg">
        <div class="container">
            <div class="row x-gap-80 y-gap-20 justify-between">
                <div class="col-12">
                    <div class="text-30 sm:text-24 fw-600">Contactanos</div>
                </div>

                <div class="col-lg-3">
                    <div class="text-14 text-light-1">Dirección</div>
                    <div class="text-18 fw-500 mt-10">{{ $empresa->empresa_direccion }}</div>
                </div>

                <div class="col-auto">
                    <div class="text-14 text-light-1">Celular</div>
                    <div class="text-18 fw-500 mt-10">+(1) {{ $empresa->empresa_celular }}</div>
                </div>

                <div class="col-auto">
                    <div class="text-14 text-light-1">Correo electrónico</div>
                    <div class="text-18 fw-500 mt-10">{{ $empresa->empresa_correo }}</div>
                </div>

                <div class="col-auto">
                    <div class="text-14 text-light-1">Siguenos en nuestras redes sociales</div>
                    <div class="d-flex x-gap-20 items-center mt-10">
                        <a href="#"><i class="icon-facebook text-14"></i></a>
                        <a href="#"><i class="icon-instagram text-14"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
