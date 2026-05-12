<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-800">Manajemen Dokter</h3>
        <a href="<?= base_url('admin/dokter/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dokter
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Nama Dokter</th>
                    <th class="px-8 py-4">Spesialisasi</th>
                    <th class="px-8 py-4">No. Telepon</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($dokter)): ?>
                    <?php $i = 1; foreach($dokter as $d): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-5 text-sm text-slate-500"><?= $i++ ?></td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                                        <?= strtoupper(substr($d['nama'], 0, 1)) ?>
                                    </div>
                                    <div class="text-sm font-bold text-slate-800"><?= $d['nama'] ?></div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-100">
                                    <?= $d['spesialis'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-sm text-slate-600">
                                <i class="fas fa-phone text-xs text-slate-400 mr-2"></i><?= $d['no_telp'] ?>
                            </td>
                            <td class="px-8 py-5 text-right flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="<?= base_url('admin/dokter/edit/'.$d['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="<?= base_url('admin/dokter/delete/'.$d['id']) ?>" method="post" onsubmit="return confirm('Hapus data dokter ini?');">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-all">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Data dokter tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
