<div>
    @if($count > 0)
        <span class="absolute -top-2 -right-2 inline-flex items-center justify-center min-w-4.5 h-4.5 px-1 rounded-full bg-red-400 text-white text-[11px] font-light leading-none transition-all duration-300">
            {{ $count > 99 ? '99+' : $count }}
        </span>
    @endif
</div>
