<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">
    <!-- Welcome Hero & Profile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2 relative overflow-hidden bg-primary rounded-[3rem] p-12 text-white shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-4xl font-black tracking-tight mb-4">Halo, <?= $pasien['nama'] ?? session()->get('username') ?>!</h2>
                <p class="text-slate-400 text-lg max-w-xl font-medium leading-relaxed">
                    Selamat datang di portal pasien SIMRS Pro. Anda dapat memantau riwayat kesehatan dan detail resep Anda di sini.
                </p>
                <div class="mt-8 flex gap-4">
                    <div class="px-6 py-3 bg-white/10 backdrop-blur-md text-white border border-white/20 font-bold rounded-2xl flex items-center gap-2">
                        <i class="fas fa-id-card text-blue-400"></i> No. RM: <?= $pasien['nomor_rm'] ?? 'Belum Terdaftar' ?>
                    </div>
                </div>
            </div>
            <!-- Decorative background circles -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="bg-white p-10 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            <h3 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-3">
                <i class="fas fa-user-circle text-blue-500"></i> Profil Saya
            </h3>
            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Email Terdaftar</span>
                    <p class="text-sm font-bold text-slate-700"><?= session()->get('email') ?></p>
                </div>
                <div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Alamat Domisili</span>
                    <p class="text-sm font-medium text-slate-600"><?= $pasien['alamat'] ?? 'Alamat belum diisi' ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Medis Section -->
    <div class="card">
        <div class="px-8 py-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fas fa-history text-blue-500"></i> Riwayat Peresepan Obat
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] border-b border-slate-100">
                        <th class="px-8 py-4">Tanggal</th>
                        <th class="px-8 py-4">Dokter</th>
                        <th class="px-8 py-4 text-right">Total Biaya</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(!empty($riwayat)): ?>
                        <?php foreach($riwayat as $r): ?>
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <span class="text-sm font-bold text-slate-700"><?= date('d M Y', strtotime($r['tanggal'])) ?></span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-medium text-slate-600 italic"><?= $r['nama_dokter'] ?></div>
                                </td>
                                <td class="px-8 py-5 text-right font-black text-slate-900 text-sm">
                                    Rp <?= number_format($r['total_harga'], 0, ',', '.') ?>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <a href="<?= base_url('user/peresepan/show/' . $r['id']) ?>" class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-lg uppercase tracking-widest border border-blue-100 hover:bg-blue-600 hover:text-white transition-all">
                                        Lihat Struk
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <p class="text-slate-400 italic text-sm">Belum ada riwayat peresepan ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
