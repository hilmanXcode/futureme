
@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen flex flex-col relative">

    @if(session('success'))
    <div class="fixed top-8 left-1/2 z-[100] animate-slide-down toast-success-floating">
        <div class="glass px-6 py-4 rounded-2xl flex items-center gap-4 border-emerald-500/20 bg-emerald-500/5 shadow-2xl shadow-emerald-500/10">
            <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <p class="text-sm font-bold text-emerald-400 tracking-tight whitespace-nowrap">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="absolute top-8 right-8 flex items-center gap-4 z-50 reveal">
        <div class="flex items-center gap-3 pr-4 border-r border-white/10">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-bold text-white">John Doe</p>
            </div>
            
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex cursor-pointer items-center gap-2 text-slate-500 hover:text-red-400 transition-colors group">
                <span class="text-xs font-bold uppercase tracking-widest hidden sm:inline">Keluar</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
            </button>
        </form>
    </div>

    <main class="flex-grow p-6 md:p-12 max-w-7xl mx-auto w-full pt-24 md:pt-32">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 reveal">
            <div>
                <div class="flex items-center gap-2 opacity-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em]">FutureMe</span>
                </div>
                <h1 class="text-5xl font-serif font-medium mb-2 italic">Halo, {{ Auth::user()->name }}</h1>
                <p class="text-slate-400">Anda memiliki {{ count($locked_capsules) }} pesan yang menunggu di masa depan.</p>
            </div>
            <a href="{{ route('dashboard.capsule.create') }}" class="px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-xl shadow-blue-600/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                <span>Buat Kapsul Baru</span>
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 reveal delay-1">
            <div class="glass p-8 rounded-3xl">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-6">Total Kapsul</p>
                <span class="text-5xl font-serif">{{ count($capsules) }}</span>
            </div>
            <div class="glass p-8 rounded-3xl">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-6">Masih Terkunci</p>
                <span class="text-5xl font-serif text-slate-300">{{ count($locked_capsules) }}</span>
            </div>
            <div class="glass p-8 rounded-3xl border-b-4 border-b-blue-600/20">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mb-6">Siap Dibaca</p>
                <span class="text-5xl font-serif text-blue-400">{{ count($unlocked_capsules) }}</span>
            </div>
        </div>

        <!-- Capsules List -->
        <div class="reveal delay-2">
            <h3 class="text-xl font-bold tracking-tight mb-8">Kapsul Waktu Kamu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @foreach ($capsules as $capsule)
                
                @if ($capsule->unlock_date <= $now)
                <div class="glass p-8 rounded-[2rem] group relative hover:bg-white/[0.05] transition-all border-blue-500/20 bg-blue-500/[0.02]">
                    
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex items-center gap-3">

                            <div class="w-12 h-12 bg-blue-600/20 rounded-2xl flex items-center justify-center text-blue-400 border border-blue-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                                
                            </div>
                            <span class="text-[9px] font-black uppercase tracking-widest text-blue-400 animate-pulse">{{ $capsule->readed_at ? '' : 'Ready to Read' }}</span>
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="openDeleteModal('{{ $capsule->title }}', '{{ route('dashboard.capsule.delete', $capsule->id) }}')" class="p-2 cursor-pointer rounded-lg bg-white/5 text-slate-500 hover:text-red-400 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </div>

                    
                    <h4 class="font-serif text-2xl mb-3 italic text-white mb-4">"{{ $capsule->title }}"</h4>
                    <a href="{{ route('dashboard.capsule.read', $capsule->id) }}" class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs flex items-center justify-center gap-2 transition-all group/btn">
                        <span>{{ $capsule->readed_at ? 'Baca Lagi' : 'Buka & Baca Sekarang' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
                @else
                {{-- Locked --}}
                <div class="glass p-8 rounded-[2rem] group relative hover:bg-white/[0.05] transition-all">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.capsule.edit', $capsule->id) }}" class="p-2 rounded-lg bg-white/5 text-slate-500 hover:text-blue-400 hover:bg-white/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </a>
                            <button onclick="openDeleteModal('{{ $capsule->title }}', '{{ route('dashboard.capsule.delete', $capsule->id) }}')" type="submit" class="p-2 rounded-lg bg-white/5 text-slate-500 hover:text-red-400 cursor-pointer hover:bg-white/10 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </div>
                    <h4 class="font-serif text-2xl mb-3 italic">"{{ $capsule->title }}"</h4>
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 pt-6 border-t border-white/5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Terbuka {{ \Carbon\Carbon::parse($capsule->unlock_date)->format('d F Y') }}</span>
                    </div>
                </div>
                @endif
                @endforeach


                <!-- Create New Capsule -->
                <a href="{{ route('dashboard.capsule.create') }}" class="border-2 border-dashed border-white/5 rounded-[2rem] flex flex-col items-center justify-center p-8 group hover:border-blue-500/30 transition-all">
                    <div class="w-14 h-14 rounded-full border border-white/10 flex items-center justify-center text-slate-600 group-hover:text-blue-400 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    </div>
                    <p class="text-xs font-black text-slate-600 uppercase tracking-widest">Kapsul Baru</p>
                </a>
            </div>
        </div>
    </main>
</div>

<div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6">

    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-md transition-opacity duration-300 opacity-0" id="modalBackdrop"></div>
    
    <!-- Modal Delete -->
    <div class="relative glass p-10 rounded-[2.5rem] w-full max-w-sm text-center transform scale-90 opacity-0 transition-all duration-300" id="modalContent">
        <div class="w-20 h-20 bg-red-500/10 rounded-3xl flex items-center justify-center text-red-500 mx-auto mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
        </div>
        
        <h3 class="text-3xl font-serif italic mb-4">Hapus Kenangan?</h3>
        <p class="text-slate-400 text-sm leading-relaxed mb-10">
            Kapsul <span class="text-white font-bold" id="capsuleNamePlaceholder">"..."</span> akan dihapus selamanya dari jaringan waktu dan tidak dapat dipulihkan.
        </p>
        
        <div class="space-y-3">
            <button onclick="confirmDeletion()" class="w-full py-4 cursor-pointer bg-red-600 hover:bg-red-500 text-white rounded-2xl font-bold transition-all active:scale-95 shadow-xl shadow-red-600/20">
                Ya, Hapus Selamanya
            </button>
            <button onclick="closeDeleteModal()" class="w-full py-4 bg-white/5 cursor-pointer hover:bg-white/10 text-slate-400 hover:text-white rounded-2xl font-bold transition-all active:scale-95">
                Batalkan
            </button>
        </div>
    </div>
</div>


<script>
    let currentLinkDelete = null;

    function openDeleteModal(name, url) {
        currentLinkDelete = url;
        document.getElementById('capsuleNamePlaceholder').innerText = `"${name}"`;
        const modal = document.getElementById('deleteModal');
        const backdrop = document.getElementById('modalBackdrop');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    
        setTimeout(() => {
            backdrop.classList.replace('opacity-0', 'opacity-100');
            content.classList.replace('scale-90', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const backdrop = document.getElementById('modalBackdrop');
        const content = document.getElementById('modalContent');
        
        backdrop.classList.replace('opacity-100', 'opacity-0');
        content.classList.replace('scale-100', 'scale-90');
        content.classList.replace('opacity-100', 'opacity-0');
        
        setTimeout(() => {
            document.getElementById('deleteModal').classList.replace('flex', 'hidden');
            currentLinkDelete = null;
        }, 300);
    }

    function confirmDeletion() {
        if (currentLinkDelete) {
            window.location.href = `${currentLinkDelete}`;
        }
    }

    document.getElementById('modalBackdrop').addEventListener('click', closeDeleteModal);
</script>

@endsection
