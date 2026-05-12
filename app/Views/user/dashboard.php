<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">
    <!-- Welcome Hero -->
    <div class="relative overflow-hidden bg-primary rounded-[3rem] p-12 text-white shadow-2xl mb-12">
        <div class="relative z-10">
            <h2 class="text-4xl font-black tracking-tight mb-4">Halo, <?= session()->get('username') ?>!</h2>
            <p class="text-slate-400 text-lg max-w-xl font-medium leading-relaxed">
                Selamat datang di portal pasien SIMRS Pro. Di sini Anda dapat memantau riwayat medis dan mengelola profil kesehatan Anda dengan mudah.
            </p>
            <div class="mt-8 flex gap-4">
                <button class="px-6 py-3 bg-white text-primary font-bold rounded-2xl hover:bg-slate-100 transition-all flex items-center gap-2">
                    <i class="fas fa-id-card text-blue-500"></i> Profil Saya
                </button>
            </div>
        </div>
        <!-- Decorative background circles -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Quick Actions / Features -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                <i class="fas fa-notes-medical"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Riwayat Medis</h3>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-6">
                Lihat daftar pemeriksaan, diagnosa, dan catatan medis Anda dari kunjungan sebelumnya.
            </p>
            <span class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-4 py-2 rounded-lg">
                <i class="fas fa-lock text-[10px]"></i> Coming Soon
            </span>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Jadwal Dokter</h3>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-6">
                Cek jadwal ketersediaan dokter spesialis dan buat janji temu secara online.
            </p>
            <span class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-4 py-2 rounded-lg">
                <i class="fas fa-lock text-[10px]"></i> Coming Soon
            </span>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
