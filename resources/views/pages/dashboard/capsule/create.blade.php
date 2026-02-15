@extends('layouts.main')
@section('title', 'Kunci Pesan Baru')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-6 py-20">
    <a href="{{ route('dashboard') }}" class="fixed top-8 left-8 w-12 h-12 rounded-full glass flex items-center justify-center text-slate-400 hover:text-white hover:scale-110 transition-all z-50">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
    </a>

    <div class="w-full max-w-3xl reveal">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="mb-8 p-6 rounded-3xl bg-emerald-500/10 border border-emerald-500/20 flex items-center gap-4 animate-slide-down-inline toast-success-inline">
            <div class="w-10 h-10 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-emerald-500 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
                <h5 class="text-emerald-400 font-bold text-sm">Kenangan Berhasil Dikunci</h5>
                <p class="text-emerald-400/60 text-xs">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Global Error Alert -->
        @if($errors->any())
        <div class="mb-8 p-6 rounded-3xl bg-red-500/10 border border-red-500/20 flex items-center gap-4 animate-shake">
            <div class="w-10 h-10 rounded-2xl bg-red-500/20 flex items-center justify-center text-red-500 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            </div>
            <div>
                <h5 class="text-red-400 font-bold text-sm">Ada masalah dengan input Anda</h5>
                <p class="text-red-400/60 text-xs">Mohon periksa kembali field yang ditandai di bawah ini.</p>
            </div>
        </div>
        @endif

        <!-- Step Indicator -->
        <div class="flex items-center gap-4 mb-12 opacity-40">
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Draft Kapsul</span>
            <div class="h-[1px] w-20 bg-white"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Masa Depan</span>
        </div>

        <form action="{{ route('dashboard.capsule.store') }}" method="POST" class="space-y-12">
            @csrf
            <div class="group">
                <input type="text" name="title" placeholder="Berikan Judul Momen Ini..." class="w-full bg-transparent border-none text-4xl md:text-5xl font-serif italic text-white placeholder:text-slate-800 focus:outline-none focus:placeholder:text-slate-700 transition-all @error('title') text-red-400 @enderror" value="{{ old('title') }}">
                <div class="h-[1px] w-0 group-focus-within:w-full bg-blue-500 transition-all duration-700 mt-4 @error('title') bg-red-500 w-full @enderror"></div>
                @error('title')
                    <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <textarea name="note" rows="8" placeholder="Tuliskan pesanmu untuk masa depan di sini..." class="w-full bg-transparent border-none text-xl text-slate-400 placeholder:text-slate-800 focus:outline-none leading-relaxed resize-none @error('note') text-red-400/80 @enderror">{{ old('note') }}</textarea>
                @error('note')
                    <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-12 border-t border-white/5">
                <div class="w-full space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Tanggal Pelepasan</label>
                    <div class="relative">
                        <input type="date" name="unlock_date" class="w-full px-6 py-4 rounded-2xl input-dark text-sm appearance-none @error('unlock_date') input-error @enderror" value="{{ old('unlock_date') }}">
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        </div>
                    </div>
                    @error('unlock_date')
                        <p class="text-red-400 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pt-8">
                <p class="text-xs text-slate-600 max-w-xs">Pesan Anda hanya dapat di akses di masa depan.</p>
                <button type="submit" class="px-10 py-5 cursor-pointer bg-white text-slate-950 rounded-2xl font-bold flex items-center justify-center gap-3 hover:bg-blue-500 hover:text-white transition-all shadow-2xl hover:shadow-blue-500/40 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span>Kunci Pesan</span>
                </button>
            </div>
        </form>
    </div>

    <div class="fixed top-1/2 right-0 -translate-y-1/2 opacity-20 pointer-events-none select-none">
        <span class="text-[20vh] font-serif italic text-white/5 whitespace-nowrap">Future Memory</span>
    </div>
</div>
@endsection