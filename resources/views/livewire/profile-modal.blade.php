<div id="profileModal" class="fixed inset-0 bg-black/50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-10">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 relative">
            <button onclick="closeProfileModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-linear-to-br from-blue-400 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-user text-white text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-2">Мой профиль</h3>
                <p class="text-gray-600">Уровень: Начинающий исследователь</p>
            </div>
            
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">Достижения</span>
                        <span class="text-blue-500">1/30</span>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 3.33%"></div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">Места посещены</span>
                        <span class="text-green-500">5/50</span>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 10%"></div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Бонусные баллы</span>
                        <span class="text-purple-500 text-xl font-bold">150</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-2 gap-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-gift mr-2"></i>Мои купоны
                </button>
                <button class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                    <i class="fas fa-history mr-2"></i>История
                </button>
            </div>
        </div>
    </div>
</div>
