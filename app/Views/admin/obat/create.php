<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="card p-10">
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Inventaris Obat</h2>
            <p class="text-slate-500 mt-1">Daftarkan obat baru ke dalam sistem pergudangan.</p>
        </div>
        
        <form action="<?= base_url('admin/obat/store') ?>" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Obat</label>
                <div class="relative group">
                    <i class="fas fa-capsules absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="nama_obat" class="input-field pl-11" value="<?= old('nama_obat') ?>" required placeholder="Cth: Paracetamol 500mg">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Jenis / Satuan</label>
                <div class="relative group">
                    <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <select name="jenis" class="input-field pl-11 appearance-none bg-slate-50" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Tablet" <?= old('jenis') == 'Tablet' ? 'selected' : '' ?>>Tablet</option>
                        <option value="Kapsul" <?= old('jenis') == 'Kapsul' ? 'selected' : '' ?>>Kapsul</option>
                        <option value="Sirup" <?= old('jenis') == 'Sirup' ? 'selected' : '' ?>>Sirup</option>
                        <option value="Salep" <?= old('jenis') == 'Salep' ? 'selected' : '' ?>>Salep</option>
                        <option value="Injeksi" <?= old('jenis') == 'Injeksi' ? 'selected' : '' ?>>Injeksi</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Stok Awal</label>
                    <div class="relative group">
                        <i class="fas fa-boxes absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="number" name="stok" class="input-field pl-11" value="<?= old('stok', 0) ?>" required min="0">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Harga (Rp)</label>
                    <div class="relative group">
                        <i class="fas fa-money-bill-wave absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="number" name="harga" class="input-field pl-11" value="<?= old('harga', 0) ?>" required min="0">
                    </div>
                </div>
            </div>
            
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/obat') ?>" class="px-6 py-2.5 text-slate-600 font-bold hover:bg-slate-100 rounded-lg transition-all text-sm">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary px-8 shadow-lg shadow-blue-200">
                    <i class="fas fa-save text-xs"></i> Simpan Inventaris
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
