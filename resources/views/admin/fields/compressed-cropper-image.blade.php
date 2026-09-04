<x-moonshine::layout.div x-data="cropper">

    <small class="cropper-small">Загрузите изображение с вашего компьютера: </small>

    <x-moonshine::form.file
        :attributes="$attributes"
        :files="$files"
        :removable="$isRemovable"
        :removableAttributes="$removableAttributes"
        :hiddenAttributes="$hiddenAttributes"
        :imageable="true"
        @change="handleFileChange($event)"
    />

    <div @defineEvent('modal-toggled', 'modal-cropper', 'toggleModal') >
        <div
            class="modal"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            aria-modal="true"
            role="dialog"
        >
            <div class="modal-dialog modal-dialog-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменить изображение</h5>
                        <button type="button"
                                class="btn btn-close"
                                @click.stop="open=false"
                                aria-label="Close"
                        >
                            <x-moonshine::icon icon="x-mark" size="6"/>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="cropper-wrapper">
                            <img x-ref="cropperImage">
                        </div>
                    </div>
                    <div class="modal-header">
                        <x-moonshine::link-button @click.prevent="toggleModal" class="btn-secondary">
                            Закрыть
                        </x-moonshine::link-button>
                        <a class="btn btn-primary"
                           data-fieldName="{{ $attributes['name'] }}"
                           @click.prevent="cropImage"
                        >
                            Обрезать
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition.opacity class="modal-backdrop"></div>


</x-moonshine::layout.div>
