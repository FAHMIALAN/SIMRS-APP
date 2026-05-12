<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="card p-10">
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-bold text-slate-800">Edit Data Pasien</h2>
            <p class="text-slate-500 mt-1">Perbarui informasi rekam medis pasien.</p>
        </div>
        
        <form action="<?= base_url('pasien/update/'.$pasien['id_pasien']) ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nomor Rekam Medis (RM)</label>
                <div class="relative group">
                    <i class="fas fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="nomor_rm" class="input-field pl-11 bg-slate-100 cursor-not-allowed opacity-80" value="<?= old('nomor_rm', $pasien['nomor_rm']) ?>" readonly>
                </div>
                <p class="mt-2 text-xs text-slate-500 flex items-center gap-2">
                    <i class="fas fa-info-circle"></i> Nomor RM tidak dapat diubah untuk integritas data.
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Lengkap Pasien</label>
                <div class="relative group">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="nama" class="input-field pl-11" value="<?= old('nama', $pasien['nama']) ?>" required>
                </div>
                <?php if($validation->hasError('nama')): ?>
                    <p class="mt-2 text-xs font-medium text-rose-500"><?= $validation->getError('nama') ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Alamat Lengkap</label>
                <textarea name="alamat" class="input-field min-h-[120px] py-3" placeholder="Masukkan alamat pasien"><?= old('alamat', $pasien['alamat']) ?></textarea>
            </div>
            
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('pasien') ?>" class="px-6 py-2.5 text-slate-600 font-bold hover:bg-slate-100 rounded-lg transition-all text-sm">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-8">
                    <i class="fas fa-sync-alt"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>