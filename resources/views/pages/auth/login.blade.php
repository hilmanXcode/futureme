
@extends('layouts.main')
@section('title', 'Masuk')

@section('content')
<main class="min-h-screen w-full flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md reveal">
        <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-white transition-colors mb-8 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            <span class="text-sm font-medium">Kembali ke Beranda</span>
        </a>

        <div class="glass p-8 md:p-10 rounded-3xl shadow-2xl">
            <!-- Success Alert -->
            @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center gap-3 animate-slide-down-inline toast-success-inline">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-500 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <p class="text-emerald-400 font-bold text-[11px] uppercase tracking-wider">{{ session('success') }}</p>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center gap-3 animate-shake">
                <div class="w-8 h-8 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <p class="text-red-400 font-bold text-[11px] uppercase tracking-wider">Kredensial tidak valid</p>
            </div>
            @endif

            <h2 class="text-3xl font-serif font-medium mb-2 italic">Selamat Datang</h2>
            <p class="text-slate-400 text-sm mb-8">Masuk untuk melihat kapsul waktu Anda.</p>

            <form action="{{ route('auth') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2 @error('email') text-red-400 @enderror">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="johndoe@email.com" class="w-full px-5 py-4 rounded-xl input-dark text-sm @error('email') input-error @enderror">
                    @error('email')
                        <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Kata Sandi</label>
                    <input type="password" name="password" placeholder="********" class="w-full px-5 py-4 rounded-xl input-dark text-sm @error('password') input-error @enderror">
                    
                </div>

                <button type="submit" class="w-full cursor-pointer py-4 bg-white text-slate-950 rounded-xl font-bold hover:bg-slate-200 transition-all active:scale-[0.98] mt-2">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-white/5 text-center">
                <p class="text-slate-500 text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-white font-semibold hover:underline ml-2">Daftar Gratis</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
