<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-800">Manajemen Stok Obat</h3>
        <a href="<?= base_url('admin/obat/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Obat
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4 text-center">No</th>
                    <th class="px-8 py-4">Nama Obat</th>
                    <th class="px-8 py-4">Jenis</th>
                    <th class="px-8 py-4 text-center">Stok</th>
                    <th class="px-8 py-4 text-right">Harga Satuan</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($obat)): ?>
                    <?php $i = 1; foreach($obat as $o): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-5 text-sm text-slate-400 text-center"><?= $i++ ?></td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-slate-800"><?= $o['nama_obat'] ?></div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-purple-50 text-purple-700 text-[10px] font-bold rounded-lg border border-purple-100 uppercase tracking-wider">
                                    <?= $o['jenis'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <?php if($o['stok'] <= 10): ?>
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-rose-50 text-rose-600 text-sm font-bold rounded-full">
                                        <?= $o['stok'] ?> <i class="fas fa-exclamation-triangle text-[10px]"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="text-sm font-bold text-emerald-600"><?= $o['stok'] ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-8 py-5 text-right font-semibold text-slate-700 text-sm">
                                Rp <?= number_format($o['harga'], 0, ',', '.') ?>
                            </td>
                            <td class="px-8 py-5 text-right flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="<?= base_url('admin/obat/edit/'.$o['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="<?= base_url('admin/obat/delete/'.$o['id']) ?>" method="post" onsubmit="return confirm('Hapus data obat ini?');">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-all" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-slate-400 italic">Inventaris obat kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
