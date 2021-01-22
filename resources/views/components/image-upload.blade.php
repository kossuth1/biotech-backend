@php
    $name = $name ?? 'icon';
    $required = empty($required) ? '' : 'required';
    $delete = $delete ?? false;
@endphp

<div class="form-group form-row" js-{{ $name }}-component>
    <label class="col-md-3 col-form-label">
        Kép
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input type="hidden" id="{{ $name }}" name="{{ $name }}" form="{{ $form }}" {{ $required }} />

    <div class="col-6 col-xl-auto col-md-5">
        <form id="dz-icon" class="dropzone" action="{{ $url }}">@csrf</form>
    </div>

    @if (optional($entity)->getOriginal($name))
        @php
            if (!method_exists($entity, 'getImageUrlAttribute')) {
                throw new Exception('The image uploader component requires a \'getImageUrlAttribute\' defined in the model returning the public path to the existing image');
            }
        @endphp
        <div class="col-6 col-md-4 col-xl-auto js-gallery">
            <div class="block m-0 border">
                <div class="block-content py-0 my-0 block-content-full">
                    <div class="options-container">
                        <img class="options-item" width="200px" height="200" src="{{ $entity->imageUrl }}">
                        <div class="options-overlay bg-white-90">
                            <div class="options-overlay-content">
                                <h4 class="h6 text-gray-dark mb-3">Jelenleg beállított kép</h4>
                                <a class="btn btn-sm btn-primary img-lightbox d-block mb-2" href="{{ $entity->imageUrl }}">
                                    <i class="fa fa-search-plus"></i> Megtekintés
                                </a>
                                @if ($delete)
                                    <a class="btn btn-sm btn-danger d-block" js-delete-image href="javascript:void(0)">
                                        <i class="fa fa-times"></i> Törlés
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>        
        Dropzone.options.dzIcon = {
            dictDefaultMessage: 'Húzd ide a képet a feltöltéshez',
            dictInvalidFileType: 'A kép kizárólag az alábbi fájlformátumok egyike lehet: jpeg, png.',
            maxFiles: 1,
            acceptedFiles: 'image/jpeg,image/png',
            init: function() {
                this.on('addedfile', () => {
                    if (this.files[1]) {
                        this.removeFile(this.files[0]);
                    }

                    $('[js-submit]').prop('disabled', true);
                });

                this.on('error', (_file, message, xhr) => {
                    dzUploadError(this, message, xhr);
                });

                this.on('complete', () => {
                    $('[js-submit]').prop('disabled', false);
                });

                this.on('success', function(_file, response) {
                    $('[name={{ $name }}]').val(response.path);
                });
            },
        };

        @if ($delete && optional($entity)->getOriginal($name))
            $('[js-delete-image]').click(() => {
                Swal.fire({
                    title: 'Biztos törlöd?',
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonText: 'Mégsem',
                    customClass: {
                        confirmButton: 'btn btn-danger m-1',
                        cancelButton: 'btn btn-secondary m-1',
                    },
                    confirmButtonText: 'Igen',
                    preConfirm: () => {
                        $('.js-gallery').remove();
                        $('[name={{ $name }}]').val('');
                    }
                });
            });
        @endif
    </script>

@endpush
