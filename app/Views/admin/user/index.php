<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-800">Manajemen Pengguna (User)</h3>
        <a href="<?= base_url('admin/user/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Username</th>
                    <th class="px-8 py-4">Email</th>
                    <th class="px-8 py-4">Role</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(!empty($users)): ?>
                    <?php $i = 1; foreach($users as $u): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 text-sm text-slate-400 font-medium"><?= $i++ ?></td>
                            <td class="px-8 py-5 font-bold text-slate-800 text-sm"><?= $u['username'] ?></td>
                            <td class="px-8 py-5 text-sm text-slate-600"><?= $u['email'] ?></td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 <?= $u['role'] == 'admin' ? 'bg-indigo-50 text-indigo-700 border-indigo-100' : 'bg-slate-50 text-slate-600 border-slate-100' ?> text-[10px] font-bold rounded-lg border uppercase tracking-widest">
                                    <?= $u['role'] ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right flex justify-end gap-2">
                                <a href="<?= base_url('admin/user/edit/'.$u['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg transition-all">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <?php if($u['id'] != session()->get('user_id')): ?>
                                <form action="<?= base_url('admin/user/delete/'.$u['id']) ?>" method="post" onsubmit="return confirm('Hapus user ini?');">
                                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-all">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Tidak ada user terdaftar</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 p-6 bg-blue-50 rounded-2xl border border-blue-100">
    <div class="flex gap-4">
        <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shrink-0">
            <i class="fas fa-database"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-blue-900">Input via phpMyAdmin?</h4>
            <p class="text-sm text-blue-700 mt-1 leading-relaxed">
                Anda juga bisa menginput user secara manual di tabel <code>users</code> via phpMyAdmin. Pastikan kolom <code>password</code> diisi dengan hash <strong>Bcrypt</strong> (atau gunakan sistem ini untuk enkripsi otomatis).
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
