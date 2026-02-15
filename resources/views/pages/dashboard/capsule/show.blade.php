@extends('layouts.main')
@section('title', 'Membaca Kenangan')

@section('content')
<div class="min-h-screen flex flex-col relative overflow-hidden">
    <!-- Immersive Background Elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[20%] left-[10%] w-[40%] h-[40%] bg-blue-500/10 blur-[150px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[20%] right-[10%] w-[40%] h-[40%] bg-indigo-500/10 blur-[150px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        <!-- Grain Texture Overlay -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[url('https://grainy-gradients.vercel.app/noise.svg')]"></div>
    </div>

    <!-- Top Navigation -->
    <nav class="relative z-50 flex items-center justify-between px-8 py-8 md:px-12 reveal">
        <a href="/dashboard" class="flex items-center gap-3 text-slate-500 hover:text-white transition-all group">
            <div class="w-10 h-10 rounded-full glass flex items-center justify-center group-hover:bg-white/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </div>
            <span class="text-xs font-black uppercase tracking-[0.2em]">Kembali</span>
        </a>
        
    </nav>

    <main class="relative z-10 flex-grow flex flex-col items-center px-6 py-12 md:py-24 max-w-4xl mx-auto w-full">
        <!-- Metadata Header -->
        <div class="text-center mb-16 reveal delay-1">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 mb-8">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                <span class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em]">Kapsul Terbuka</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-serif font-medium mb-6 italic leading-tight text-white">
                "{{ $capsule[0]->title }}"
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                <div class="flex items-center gap-2">
                    <span class="text-slate-700">Dikunci:</span>
                    <span class="text-slate-300">{{ $capsule[0]->created_at }}</span>
                </div>
                <div class="w-1 h-1 rounded-full bg-slate-800 hidden sm:block"></div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-700">Dibuka:</span>
                    <span class="text-blue-400">{{ $capsule[0]->readed_at ?? 'Hari Ini'  }}</span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="w-full reveal delay-2">
            <div class="relative">
                <!-- Decorative Quotes -->
                <div class="absolute -top-10 -left-6 text-8xl font-serif text-white/5 pointer-events-none">“</div>
                
                <div class="glass p-10 md:p-16 rounded-[3rem] border-white/5 relative overflow-hidden">
                    <!-- Subtle pattern -->
                    <div class="absolute top-0 right-0 p-8 opacity-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>

                    <div class="prose prose-invert max-w-none">
                        {{-- <p class="text-xl md:text-2xl text-slate-300 leading-[1.8] font-light italic mb-8">
                            Halo diriku di masa depan,
                        </p> --}}
                        <p class="text-lg md:text-xl text-slate-400 leading-[2] mb-8">
                            {{ $capsule[0]->note }} 
                        </p>
                        {{-- <p class="text-lg md:text-xl text-slate-400 leading-[2] mb-8">
                            Apakah kau masih memiliki semangat yang sama? Apakah kau sudah mencapai semua yang kita mimpikan di umur 20-an? Aku harap kau tetap menjadi versi terbaik dari dirimu sendiri, tetap rendah hati, dan tidak pernah berhenti belajar.
                        </p>
                        <p class="text-lg md:text-xl text-slate-400 leading-[2] mb-12">
                            Ingatlah hari ini, hari dimana segalanya terasa mungkin. Jangan lupakan rasa syukur yang kita miliki saat ini. Sampai jumpa di memori berikutnya.
                        </p> --}}
                        
                        <div class="pt-12 border-t border-white/5 flex flex-col items-end">
                            <p class="text-xs font-black uppercase tracking-[0.3em] text-slate-600 mb-2">Tertanda,</p>
                            <p class="font-serif text-3xl italic text-white">Dirimu di Masa Lalu</p>
                        </div>
                    </div>
                </div>
                
                <div class="absolute -bottom-10 -right-6 text-8xl font-serif text-white/5 pointer-events-none">”</div>
            </div>
        </div>

        
    </main>

    <!-- Bottom Background Text -->
    <div class="fixed bottom-0 left-0 w-full opacity-[0.02] pointer-events-none select-none">
        <p class="text-[30vh] font-serif italic text-white leading-none -mb-10 transform translate-y-1/2">Memory</p>
    </div>
</div>
@endsection