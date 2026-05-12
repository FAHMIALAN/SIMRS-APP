<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Riwayat Peresepan</h3>
            <p class="text-xs text-slate-500 mt-1">Daftar semua resep yang telah dikeluarkan sistem.</p>
        </div>
        <a href="<?= base_url('admin/peresepan/create') ?>" class="btn btn-primary shadow-lg shadow-blue-200">
            <i class="fas fa-plus"></i> Buat Peresepan Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Tanggal Transaksi</th>
                    <th class="px-8 py-4">Pasien</th>
                    <th class="px-8 py-4">Dokter</th>
                    <th class="px-8 py-4">Admin Pengelola</th>
                    <th class="px-8 py-4 text-right">Total Tagihan</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($peresepan)): ?>
                    <?php $i = 1; foreach($peresepan as $p): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 text-sm text-slate-400 font-medium"><?= $i++ ?></td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <i class="far fa-calendar-alt text-blue-500 text-xs"></i>
                                    <span class="text-sm font-semibold text-slate-700"><?= date('d M Y', strtotime($p['tanggal'])) ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-slate-800"><?= $p['nama_pasien'] ?></div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm text-slate-600 italic"><?= $p['nama_dokter'] ?></div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-xs font-bold text-slate-500 uppercase"><?= $p['nama_admin'] ?? 'System' ?></div>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-emerald-600 text-sm">
                                Rp <?= number_format($p['total_harga'], 0, ',', '.') ?>
                            </td>
                            <td class="px-8 py-5 text-right flex justify-end gap-2">
                                <a href="<?= base_url('admin/peresepan/show/'.$p['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-all" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="<?= base_url('admin/peresepan/edit/'.$p['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="<?= base_url('admin/peresepan/delete/'.$p['id']) ?>" method="post" onsubmit="return confirm('Hapus transaksi ini dan kembalikan stok?');" class="inline">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-all" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-slate-400 italic">Belum ada data peresepan yang tersimpan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
