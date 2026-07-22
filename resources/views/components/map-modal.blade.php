<div onclick="document.getElementById('map-modal').classList.add('hidden')" id="map-modal" class="fixed inset-0 bg-gray bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 max-w-3xl w-full">
        <!-- Заголовок -->
        <div class="flex justify-end items-center mb-4">
            <button onclick="document.getElementById('map-modal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700 text-2xl">
                ×
            </button>
        </div>

        <!-- Карта -->
        <div id="map" class="w-full h-200 bg-gray-200 rounded" onclick="event.stopPropagation()"></div>
    </div>
</div>
