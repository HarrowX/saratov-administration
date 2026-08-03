<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer']) }}>
    {{ $slot }}
</button>
