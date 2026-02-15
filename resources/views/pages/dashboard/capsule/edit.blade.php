
@extends('layouts.main')
@section('title', 'Edit Pesan')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-6 py-20">

    <a href="{{ route('dashboard') }}" class="fixed top-8 left-8 w-12 h-12 rounded-full glass flex items-center justify-center text-slate-400 hover:text-white hover:scale-110 transition-all z-50">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>

    <div class="w-full max-w-3xl reveal">
        
        @if($errors->any())
        <div class="mb-8 p-6 rounded-3xl bg-red-500/10 border border-red-500/20 flex items-center gap-4 animate-shake">
            <div class="w-10 h-10 rounded-2xl bg-red-500/20 flex items-center justify-center text-red-500 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            </div>
            <div>
                <h5 class="text-red-400 font-bold text-sm">Gagal memperbarui kenangan</h5>
                <p class="text-red-400/60 text-xs">Periksa kembali data yang Anda masukkan.</p>
            </div>
        </div>
        @endif

        <div class="flex items-center gap-4 mb-12 opacity-40">
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">Edit Kenangan</span>
            <div class="h-[1px] w-20 bg-white"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.4em]">ID: {{ $capsule[0]->id }}</span>
        </div>

        <form action="{{ route('dashboard.capsule.update', $capsule[0]->id) }}" method="POST" class="space-y-12">
            @csrf
            
            <div class="group">
                <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-blue-500 mb-2 @error('title') text-red-500 @enderror">Judul Kapsul</label>
                <input type="text" name="title" value="{{ old('title', $capsule[0]->title) }}" placeholder="Berikan Judul..." class="w-full bg-transparent border-none text-4xl md:text-5xl font-serif italic text-white focus:outline-none transition-all @error('title') text-red-400 @enderror">
                <div class="h-[1px] w-full bg-white/10 mt-4 @error('title') bg-red-500 @enderror"></div>
                @error('title')
                    <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-600 mb-4 @error('note') text-red-500 @enderror">Isi Pesan</label>
                <textarea name="note" rows="8" class="w-full bg-transparent border-none text-xl text-slate-400 focus:outline-none leading-relaxed resize-none @error('note') text-red-400/80 @enderror">{{ old('note', $capsule[0]->note) }}</textarea>
                @error('note')
                    <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-12 border-t border-white/5">
                <div class="w-full space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500">Ubah Tanggal Buka</label>
                    <div class="relative">
                        <input type="date" name="unlock_date" value="{{ old('unlock_date', $capsule[0]->unlock_date) }}" class="w-full px-6 py-4 rounded-2xl input-dark text-sm @error('unlock_date') input-error @enderror">
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        </div>
                    </div>
                    @error('unlock_date')
                        <p class="text-red-400 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between pt-8">
                <button type="button" onclick="window.history.back()" class="text-xs font-bold text-slate-500 hover:text-white transition-colors">Batalkan Perubahan</button>
                <button type="submit" class="px-10 py-5 cursor-pointer bg-blue-600 text-white rounded-2xl font-bold flex items-center gap-3 hover:bg-blue-500 transition-all shadow-2xl shadow-blue-500/40 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
