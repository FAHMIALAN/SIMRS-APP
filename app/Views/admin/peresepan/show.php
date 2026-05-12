<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">
    <div class="card p-0" id="print-area">
        <!-- Receipt Header -->
        <div class="p-10 border-b-2 border-dashed border-slate-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">SIMRS <span class="text-blue-600">PRO</span></h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 uppercase tracking-widest">Digital Prescription System</p>
                </div>
                <div class="text-right">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Nomor Referensi</div>
                    <div class="text-lg font-black text-slate-800">#PRS-<?= str_pad($peresepan['id'], 5, '0', STR_PAD_LEFT) ?></div>
                </div>
            </div>
            
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Tanggal Resep</span>
                    <span class="text-sm font-bold text-slate-800"><?= date('d F Y', strtotime($peresepan['tanggal'])) ?></span>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Nama Pasien</span>
                    <span class="text-sm font-bold text-slate-800 uppercase"><?= $peresepan['nama_pasien'] ?></span>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Dokter Pemeriksa</span>
                    <span class="text-sm font-bold text-slate-800 italic"><?= $peresepan['nama_dokter'] ?></span>
                </div>
            </div>
        </div>
        
        <!-- Items Table -->
        <div class="p-10">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                        <th class="py-4 w-12 text-center">#</th>
                        <th class="py-4 px-4">Deskripsi Obat</th>
                        <th class="py-4 px-4 text-right">Harga</th>
                        <th class="py-4 px-4 text-center">Qty</th>
                        <th class="py-4 px-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php $i = 1; foreach($details as $d): ?>
                        <tr class="text-sm text-slate-700">
                            <td class="py-5 text-center text-slate-400 font-medium"><?= $i++ ?></td>
                            <td class="py-5 px-4 font-bold text-slate-800"><?= $d['nama_obat'] ?></td>
                            <td class="py-5 px-4 text-right">Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                            <td class="py-5 px-4 text-center font-semibold"><?= $d['jumlah'] ?></td>
                            <td class="py-5 px-4 text-right font-black text-slate-900">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="mt-10 pt-10 border-t-2 border-slate-100 flex flex-col items-end">
                <div class="w-full max-w-[280px] space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 font-medium">Total Item</span>
                        <span class="text-slate-800 font-bold"><?= count($details) ?> Macam</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <span class="text-slate-900 font-black uppercase tracking-widest text-xs">Total Pembayaran</span>
                        <span class="text-2xl font-black text-blue-600">Rp <?= number_format($peresepan['total_harga'], 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center">
                <p class="text-xs text-slate-400 font-medium italic">Resep ini adalah dokumen sah digital dari SIMRS Pro System.</p>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="mt-10 flex items-center justify-center gap-4 no-print">
        <button onclick="window.print()" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-200 transition-all active:scale-[0.98] flex items-center gap-2">
            <i class="fas fa-print"></i> Cetak Struk Resep
        </button>
        <a href="<?= base_url('admin/peresepan') ?>" class="px-8 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-2xl transition-all flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>
</div>

<style>
@media print {
    body { background-color: white !important; }
    .no-print, nav, header, aside, footer { display: none !important; }
    .card { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; }
    .lg\:ml-64 { margin-left: 0 !important; }
    #print-area { width: 100% !important; margin: 0 !important; }
    main { padding: 0 !important; }
}
</style>

<?= $this->endSection() ?>
