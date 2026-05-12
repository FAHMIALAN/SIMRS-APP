<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="card p-10">
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-bold text-slate-800">Edit User</h2>
            <p class="text-slate-500 mt-1">Perbarui informasi akun pengguna.</p>
        </div>
        
        <form action="<?= base_url('admin/user/update/'.$user['id']) ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" class="input-field" value="<?= old('username', $user['username']) ?>" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" class="input-field" value="<?= old('email', $user['email']) ?>" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" class="input-field" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                <p class="mt-2 text-xs text-slate-400 italic italic">Kosongkan jika tidak ingin merubah password.</p>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Role Akses</label>
                <select name="role" class="input-field bg-slate-50" required>
                    <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : '' ?>>User / Pasien</option>
                    <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Administrator</option>
                </select>
            </div>
            
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/user') ?>" class="px-6 py-2.5 text-slate-600 font-bold hover:bg-slate-100 rounded-lg transition-all text-sm">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary px-8">
                    <i class="fas fa-sync-alt"></i> Perbarui User
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
