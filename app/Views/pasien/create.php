<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="card p-10">
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Pasien Baru</h2>
            <p class="text-slate-500 mt-1">Input data rekam medis pasien dengan lengkap.</p>
        </div>
        
        <form action="<?= base_url('pasien/store') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Rekam Medis (RM)</label>
                <div class="relative">
                    <i class="fas fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="nomor_rm" class="input-field pl-11" value="<?= old('nomor_rm') ?>" required placeholder="Cth: RM001">
                </div>
                <?php if($validation->hasError('nomor_rm')): ?>
                    <p class="mt-2 text-xs font-medium text-rose-500"><?= $validation->getError('nomor_rm') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap Pasien</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="nama" class="input-field pl-11" value="<?= old('nama') ?>" required placeholder="Masukkan nama lengkap">
                </div>
                <?php if($validation->hasError('nama')): ?>
                    <p class="mt-2 text-xs font-medium text-rose-500"><?= $validation->getError('nama') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" class="input-field min-h-[120px] py-3" placeholder="Masukkan alamat pasien"><?= old('alamat') ?></textarea>
            </div>
            
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('pasien') ?>" class="px-6 py-2.5 text-slate-600 font-bold hover:bg-slate-100 rounded-lg transition-all text-sm">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary px-8">
                    <i class="fas fa-save"></i> Simpan Data Pasien
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>