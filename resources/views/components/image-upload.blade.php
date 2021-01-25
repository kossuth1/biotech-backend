@php
    $name = $name ?? 'icon';
    $required = empty($required) ? '' : 'required';
@endphp

<div class="form-group" js-{{ $name }}-component>
    <label>Kép feltöltés</label>

    <form id="dz-icon" class="dropzone" action="{{ $url }}">@csrf</form>
</div>
<div class="form-group">
    <label>Jelenlegi képek</label>
    @if (optional($entity)->$name)
        <section class="row justify-content-between p-3">
            @foreach ($entity->images as $image)
                <div class="card shadow" js-image-container>
                    <div class="card-header">
                        <a class="text-danger float-right" data-id="{{ $image->id }}" js-delete-image href="javascript:void(0)">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <img class="ProductImage" width="200px" height="200" src="{{ $image->imageUrl }}" />
                    </div>

                </div>
            @endforeach
        </section>
    @endif
</div>

@push('styles')
    <style>
        .ProductImage {
            object-fit: contain;
        }

        .dropzone {
            border: 1px solid #ced4da !important;
            border-radius: .25rem
        }
    </style>
@endpush

@push('scripts')
    <script>        
        Dropzone.options.dzIcon = {
            dictDefaultMessage: 'Húzd ide a képet a feltöltéshez',
            dictInvalidFileType: 'A kép kizárólag az alábbi fájlformátumok egyike lehet: jpeg, png.',
            acceptedFiles: 'image/jpeg,image/png',
            init: function() {
                this.on('error', (_file, message, xhr) => {
                    dzUploadError(this, message, xhr);
                });

                this.on('complete', () => {
                    $('[js-submit]').prop('disabled', false);
                });

                this.on('success', function(_file, response) {
                    $('[js-product-form]').append(`<input type="hidden" name="images[][filename]" value="${response.filename}" />`)
                });
            },
        };

        $('[js-delete-image]').on('click', function() {
            const container = $(this).parents('[js-image-container]');
            const id = $(this).data('id');

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
                    $('[js-product-form]').append(`<input type="hidden" name="delete[]" value="${id}" />`);
                    container.remove();
                }
            });
        });
    </script>

@endpush
