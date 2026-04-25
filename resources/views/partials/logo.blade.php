<!-- SalesCRM Premium Logo Component with Custom Indigo Background -->
<div class="flex items-center gap-3 group cursor-pointer">
    <div class="relative flex-none">
        <!-- Background Glow -->
        <div class="absolute -inset-2 bg-[#6366f1]/20 rounded-2xl blur opacity-20 group-hover:opacity-60 transition duration-700"></div>
        
        <!-- Image Container (Custom Indigo) -->
        <div class="relative w-12 h-12 bg-[#6366f1] rounded-2xl flex items-center justify-center shadow-2xl transition-all duration-500 group-hover:scale-105 group-hover:rotate-3 overflow-hidden p-1.5">
            <img src="{{ asset('logo_new.png') }}" alt="Logo" class="w-full h-full object-contain filter drop-shadow-sm brightness-110">
        </div>
    </div>

    <!-- Typography -->
    <div class="flex flex-col text-left">
        <span class="text-xl font-black tracking-tighter {{ $textColor ?? 'text-white' }} leading-none">
            Linka<span class="text-[#6366f1]"> CRM</span>
        </span>
        <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500 mt-1 italic">Growth Engine</span>
    </div>
</div>
