<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="card p-10">
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-bold text-slate-800">Edit Data Dokter</h2>
            <p class="text-slate-500 mt-1">Perbarui profil dan kontak dokter pemeriksa.</p>
        </div>
        
        <form action="<?= base_url('admin/dokter/update/'.$dokter['id']) ?>" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tight">Nama Lengkap Dokter</label>
                <div class="relative group">
                    <i class="fas fa-user-md absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="nama" class="input-field pl-11" value="<?= old('nama', $dokter['nama']) ?>" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tight">Spesialisasi</label>
                <div class="relative group">
                    <i class="fas fa-stethoscope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="spesialis" class="input-field pl-11" value="<?= old('spesialis', $dokter['spesialis']) ?>" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tight">Nomor Telepon</label>
                <div class="relative group">
                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="no_telp" class="input-field pl-11" value="<?= old('no_telp', $dokter['no_telp']) ?>" required>
                </div>
            </div>
            
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/dokter') ?>" class="px-6 py-2.5 text-slate-600 font-bold hover:bg-slate-100 rounded-lg transition-all text-sm">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-8 shadow-lg shadow-blue-200">
                    <i class="fas fa-sync-alt text-xs"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
