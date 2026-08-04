<div id="map-search-component" x-data="{
    isMapOpen: {{ $isMapOpen ? 'true' : 'false' }},
    selectedPoint: null,

    openModal(point) {
        console.log(point)
        this.selectedPoint = point;
        window.dispatchEvent(new CustomEvent('modal_toggled:point-info-modal'));
    }
}"
     >

    <x-moonshine::action-button @click="isMapOpen = !isMapOpen" class="mb-4">
        <span x-text="isMapOpen ? 'Закрыть карту' : 'Открыть карту'"></span>
    </x-moonshine::action-button>

    <div id="map"
         x-show="isMapOpen"
         x-transition
         style="width:100%;height:500px;border-radius:12px;overflow:hidden;border:1px solid #ddd;"></div>

    <x-moonshine::modal
        name="point-info-modal"
        title="Информация о точке">
        <div class="space-y-4">
            <template x-if="selectedPoint">
                <div class="flex flex-col">
                    <x-moonshine::form.label class="text-lg font-bold" x-text="selectedPoint.name" />
                    <x-moonshine::form.label class="mt-2" x-text="selectedPoint.description" />
                    <x-moonshine::link-button class="mt-2 w-fit" x-bind:href="selectedPoint.url" >
                        Подробнее
                    </x-moonshine::link-button>
                </div>
            </template>
        </div>
    </x-moonshine::modal>

    <script>
        window.mapInstance = null;
        window.__mapInitDone = window.__mapInitDone || false;

        window.initMap = function initMap() {
            if (window.__mapInitDone) return;

            window.ymaps3.ready.then(() => {
                const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker } = window.ymaps3;

                const container = document.getElementById('map');

                if (window.mapInstance) {
                    window.mapInstance.destroy();
                    window.mapInstance = null;
                }

                window.mapInstance = new YMap(container, {
                    location: { center: [46.0086, 51.540600], zoom: 10 }
                });

                window.mapInstance.addChild(new YMapDefaultSchemeLayer());
                window.mapInstance.addChild(new YMapDefaultFeaturesLayer());

                const points = @json($points);

                points.forEach((point) => {
                    const lat = parseFloat(point.latitude);
                    const lng = parseFloat(point.longitude);
                    if (Number.isNaN(lat) || Number.isNaN(lng)) return;

                    const el = document.createElement('div');
                    el.style.cssText = `
                        width:36px;height:36px;background:#333;border-radius:50%;
                        border:3px solid white;box-shadow:0 2px 12px rgba(0,0,0,0.25);
                        cursor:pointer;display:flex;align-items:center;justify-content:center;
                        color:white;font-weight:bold;font-size:14px;transition:transform .2s;
                    `;

                    el.style.transform = 'scale(1) translate(-18px, -18px)';

                    el.textContent = point.name ? point.name.charAt(0).toUpperCase() : '•';

                    el.addEventListener('mouseenter', () => el.style.transform = 'scale(1.2) translate(-15px, -15px)');
                    el.addEventListener('mouseleave', () => el.style.transform = 'scale(1) translate(-18px, -18px)');

                    el.addEventListener('click', function() {

                        if (typeof Alpine !== 'undefined' && Alpine.$data) {
                            const component = document.getElementById('map-search-component');
                            if (component) {
                                const data = Alpine.$data(component);
                                if (data && typeof data.openModal === 'function') {
                                    data.openModal(point);
                                    return;
                                }
                            }
                        }
                    });

                    const marker = new YMapMarker({ coordinates: [lng, lat] }, el);
                    window.mapInstance.addChild(marker);
                });

                window.__mapInitDone = true;
            }).catch(function(err) {
                console.error('Yandex Maps initialization error:', err);
            });
        };

        document.addEventListener('alpine:init', function() {
            if (!window.__mapInitDone) {
                setTimeout(window.initMap, 300);
            }
        });
    </script>
</div>
