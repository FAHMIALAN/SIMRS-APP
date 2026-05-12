<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMRS Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-100 via-slate-100 to-emerald-50">
        <div class="w-full max-w-[440px]">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-2xl shadow-xl shadow-blue-200 mb-4 text-2xl">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">SIMRS<span class="text-blue-600">Pro</span></h1>
                <p class="text-slate-500 mt-2 font-medium">Sistem Manajemen Rumah Sakit Terintegrasi</p>
            </div>

            <!-- Card Section -->
            <div class="bg-white p-10 rounded-[2rem] shadow-2xl shadow-slate-200/60 border border-white">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Silakan Login</h2>
                
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-sm flex items-center gap-3">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl text-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('errors')): ?>
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl text-sm">
                        <ul class="list-disc list-inside space-y-1">
                        <?php foreach(session()->getFlashdata('errors') as $err): ?>
                            <li><?= $err ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login/process') ?>" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="email" name="email" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400" value="<?= old('email') ?>" required placeholder="nama@email.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-semibold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lupa Password?</a>
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="password" name="password" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400" required placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 transition-all duration-200 active:scale-[0.98] mt-4 flex items-center justify-center gap-2">
                        Masuk ke Aplikasi <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </form>
                
                <div class="mt-10 pt-8 border-t border-slate-100 text-center text-sm text-slate-500 font-medium">
                    Belum memiliki akun? <a href="<?= base_url('register') ?>" class="text-blue-600 font-bold hover:underline">Daftar Sekarang</a>
                </div>
            </div>
            
            <p class="text-center text-slate-400 text-xs mt-10">
                &copy; <?= date('Y') ?> SIMRS Pro Team.
            </p>
        </div>
    </div>
</body>
</html>
