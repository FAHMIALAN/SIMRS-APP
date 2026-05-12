<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-800">Daftar Pasien</h3>
        <a href="<?= base_url('pasien/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pasien
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">No. Rekam Medis</th>
                    <th class="px-8 py-4">Nama Lengkap</th>
                    <th class="px-8 py-4">Alamat</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($pasien)): ?>
                    <?php $i = 1; foreach($pasien as $p): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 text-sm text-slate-500"><?= $i++ ?></td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-lg border border-slate-200">
                                    <?= $p['nomor_rm'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 font-bold text-slate-800 text-sm"><?= $p['nama'] ?></td>
                            <td class="px-8 py-5 text-sm text-slate-600 truncate max-w-xs"><?= $p['alamat'] ?></td>
                            <td class="px-8 py-5 text-right flex justify-end gap-2">
                                <a href="<?= base_url('pasien/edit/'.$p['id_pasien']) ?>" class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="<?= base_url('pasien/delete/'.$p['id_pasien']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus pasien ini?');">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-all" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Data pasien tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>