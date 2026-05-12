<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Statistics Section -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Pasien -->
    <a href="<?= base_url('pasien') ?>" class="card p-6 flex items-center group hover:border-blue-500 transition-all">
        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
            <i class="fas fa-users"></i>
        </div>
        <div class="ml-5">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Pasien</p>
            <h3 class="text-2xl font-bold text-slate-800"><?= $total_pasien ?></h3>
        </div>
    </a>
    
    <!-- Total Dokter -->
    <a href="<?= base_url('admin/dokter') ?>" class="card p-6 flex items-center group hover:border-emerald-500 transition-all">
        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all">
            <i class="fas fa-user-md"></i>
        </div>
        <div class="ml-5">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Dokter</p>
            <h3 class="text-2xl font-bold text-slate-800"><?= $total_dokter ?></h3>
        </div>
    </a>
    
    <!-- Total Obat -->
    <a href="<?= base_url('admin/obat') ?>" class="card p-6 flex items-center group hover:border-purple-500 transition-all">
        <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-purple-600 group-hover:text-white transition-all">
            <i class="fas fa-pills"></i>
        </div>
        <div class="ml-5">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Obat</p>
            <h3 class="text-2xl font-bold text-slate-800"><?= $total_obat ?></h3>
        </div>
    </a>
    
    <!-- Total Peresepan -->
    <a href="<?= base_url('admin/peresepan') ?>" class="card p-6 flex items-center group hover:border-amber-500 transition-all">
        <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-amber-600 group-hover:text-white transition-all">
            <i class="fas fa-file-prescription"></i>
        </div>
        <div class="ml-5">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Peresepan</p>
            <h3 class="text-2xl font-bold text-slate-800"><?= $total_peresepan ?></h3>
        </div>
    </a>

    <!-- Total Penjualan -->
    <a href="<?= base_url('admin/peresepan/report') ?>" class="card p-6 flex items-center group hover:border-emerald-500 transition-all">
        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="ml-5">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Penjualan</p>
            <h3 class="text-2xl font-bold text-slate-800">Rp <?= number_format($total_penjualan, 0, ',', '.') ?></h3>
        </div>
    </a>
</div>

<!-- Recent Activities Table -->
<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-800">Peresepan Terbaru</h3>
        <a href="<?= base_url('admin/peresepan') ?>" class="text-blue-600 text-sm font-bold hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Dokter Pemeriksa</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Total Biaya</th>
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($recent_peresepan)): ?>
                    <?php foreach($recent_peresepan as $p): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 text-sm font-medium text-slate-600">
                                <?= date('d M Y', strtotime($p['tanggal'])) ?>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-slate-800"><?= $p['nama_pasien'] ?? 'N/A' ?></div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm text-slate-600"><?= $p['nama_dokter'] ?? 'N/A' ?></div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">
                                    Rp <?= number_format($p['total_harga'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="<?= base_url('admin/peresepan/show/'.$p['id']) ?>" class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm hover:text-blue-700 transition-colors">
                                    Detail <i class="fas fa-chevron-right text-[10px]"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data peresepan terbaru</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
