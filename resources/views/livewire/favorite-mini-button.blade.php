<div
    wire:click="toggleFavorite"
    class="absolute {{$position}} size-12 xl:size-15 rounded-md xl:rounded-xl flex items-center justify-center gap-1 xl:gap-1.5 shadow-lg cursor-pointer transition-all duration-300 hover:scale-110 {{ $isFavorite ? 'bg-red-500 text-white' : 'bg-[#A855F7] text-white' }}">
    <i class="fa-sharp {{ $isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart text-base xl:text-xl"></i>

    <span class="text-xs xl:text-sm font-bold {{ $isFavorite ? 'text-white' : 'text-white/90' }} transition-colors">
        {{ $favoritesCount }}
    </span>
</div>
