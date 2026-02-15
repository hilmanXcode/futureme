
@extends('layouts.main')
@section('title', 'Daftar')

@section('content')
<main class="min-h-screen w-full flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md reveal">
        <!-- Back Link -->
        <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-white transition-colors mb-8 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            <span class="text-sm font-medium">Kembali ke Beranda</span>
        </a>

        <div class="glass p-8 md:p-10 rounded-3xl shadow-2xl">
            <!-- Global Error Alert -->
            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center gap-3 animate-shake">
                <div class="w-8 h-8 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                </div>
                <p class="text-red-400 font-bold text-[11px] uppercase tracking-wider">Mohon periksa form pendaftaran</p>
            </div>
            @endif

            <h2 class="text-3xl font-serif font-medium mb-2 italic">Buat Akun</h2>
            <p class="text-slate-400 text-sm mb-8">Mulai tulis pesan untukmu di masa depan hari ini.</p>

            <form action="{{ route('register.create') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2 @error('name') text-red-400 @enderror">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="w-full px-5 py-4 rounded-xl input-dark text-sm @error('name') input-error @enderror">
                    @error('name')
                        <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2 @error('email') text-red-400 @enderror">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full px-5 py-4 rounded-xl input-dark text-sm @error('email') input-error @enderror">
                    @error('email')
                        <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2 @error('password') text-red-400 @enderror">Kata Sandi Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full px-5 py-4 rounded-xl input-dark text-sm @error('password') input-error @enderror">
                    @error('password')
                        <p class="text-red-400 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-4 cursor-pointer bg-white text-slate-950 rounded-xl font-bold hover:bg-slate-200 transition-all active:scale-[0.98] mt-2">
                    Buat Akun Baru
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-white/5 text-center">
                <p class="text-slate-500 text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-white font-semibold hover:underline ml-2">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
