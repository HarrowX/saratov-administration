<div>
    <!-- Кнопка MoonShine -->
    <x-moonshine::action-button
        @click="toggleButton()"
        class="mb-4"
    >
        <span id="btnText">Открыть карту</span>
    </x-moonshine::action-button>

    <!-- Карта -->
    <div id="mapWrapper" style="display: none; width: 100%; height: 500px; border-radius: 12px; overflow: hidden; border: 1px solid #ddd;">
        <div id="map" style="width: 100%; height: 100%;"></div>
    </div>

    <!-- Модалка -->
    <div id="modalOverlay" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999;" onclick="closeModal()"></div>
    <div id="modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10000; background: white; border-radius: 16px; padding: 30px; max-width: 500px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        <button onclick="closeModal()" style="position: absolute; top: 12px; right: 16px; background: none; border: none; font-size: 24px; cursor: pointer;">✕</button>
        <h2 id="modalTitle" style="margin: 0 0 8px 0; font-size: 24px;"></h2>
        <p id="modalDesc" style="margin: 0 0 16px 0; color: #666;"></p>
        <div style="background: #f5f5f5; padding: 10px; border-radius: 8px; margin-bottom: 16px;">
            <span id="modalCoords"></span>
        </div>
        <a id="modalLink" href="#" style="display: inline-block; background: #2563eb; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none;">Подробнее →</a>
    </div>

    <script>
        let mapInstance = null;
        let isOpen = false;
        let isInitialized = false;
        const points = @json($points);
        let selectedPoint = null;

        function toggleButton() {
            isOpen = !isOpen;
            const wrapper = document.getElementById('mapWrapper');
            const btn = document.getElementById('btnText');

            if (isOpen) {
                wrapper.style.display = 'block';
                btn.textContent = 'Закрыть карту';
                if (!isInitialized) {
                    setTimeout(initMap, 300);
                } else {
                    setTimeout(() => {
                        if (mapInstance) {
                            mapInstance.updateLocation({
                                center: [37.588144, 55.733842],
                                zoom: 10
                            });
                        }
                    }, 100);
                }
            } else {
                wrapper.style.display = 'none';
                btn.textContent = 'Открыть карту';
            }
        }

        async function initMap() {
            if (isInitialized) return;

            try {
                await ymaps3.ready;

                const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker } = ymaps3;

                const container = document.getElementById('map');
                if (!container) return;

                mapInstance = new YMap(
                    container,
                    {
                        location: {
                            center: [46.0086, 51.540600],
                            zoom: 10
                        }
                    }
                );

                mapInstance.addChild(new YMapDefaultSchemeLayer());
                mapInstance.addChild(new YMapDefaultFeaturesLayer());

                points.forEach((point) => {
                    const lat = parseFloat(point.latitude);
                    const lng = parseFloat(point.longitude);

                    if (isNaN(lat) || isNaN(lng)) return;

                    const el = document.createElement('div');
                    el.style.cssText = `
                        width: 36px;
                        height: 36px;
                        background: #FF6B6B;
                        border-radius: 50%;
                        border: 3px solid white;
                        box-shadow: 0 2px 12px rgba(0,0,0,0.25);
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-weight: bold;
                        font-size: 14px;
                        transition: transform 0.2s;
                    `;
                    el.textContent = point.name ? point.name.charAt(0).toUpperCase() : '•';

                    el.addEventListener('mouseenter', () => {
                        el.style.transform = 'scale(1.2)';
                    });
                    el.addEventListener('mouseleave', () => {
                        el.style.transform = 'scale(1)';
                    });

                    el.addEventListener('click', () => {
                        selectedPoint = point;
                        openModal(point);
                    });

                    const marker = new YMapMarker(
                        { coordinates: [lng, lat] },
                        el
                    );

                    mapInstance.addChild(marker);
                });

                isInitialized = true;
                console.log('Карта создана, маркеров:', points.length);

            } catch (error) {
                console.error('Ошибка карты:', error);
                isInitialized = false;
            }
        }

        function openModal(point) {
            document.getElementById('modalTitle').textContent = point.name || 'Без названия';
            document.getElementById('modalDesc').textContent = point.description || 'Нет описания';
            document.getElementById('modalCoords').textContent = `${point.latitude}, ${point.longitude}`;

            const link = document.getElementById('modalLink');
            if (point.url) {
                link.href = point.url;
                link.style.display = 'inline-block';
            } else {
                link.style.display = 'none';
            }

            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('modal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

    </script>
</div>
