<?php 
$months = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
?>

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card mb-8">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30">
        <h3 class="text-lg font-bold text-slate-800">Filter Laporan Peresepan</h3>
        <p class="text-xs text-slate-500 mt-1">Pilih periode laporan untuk melihat statistik transaksi.</p>
    </div>
    <div class="p-8">
        <form action="<?= base_url('admin/peresepan/report') ?>" method="GET" class="flex flex-wrap items-end gap-6">
            <div class="w-full sm:w-48">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Pilih Tanggal (Harian)</label>
                <input type="date" name="tanggal" class="input-field py-2 text-sm" value="<?= $tanggal_filter ?>">
            </div>
            <div class="w-full sm:w-40">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Bulan (Bulanan)</label>
                <select name="bulan" class="input-field py-2 text-sm">
                    <option value="">-- Pilih Bulan --</option>
                    <?php foreach($months as $k => $v): ?>
                        <option value="<?= $k ?>" <?= $bulan == $k ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full sm:w-32">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tahun</label>
                <select name="tahun" class="input-field py-2 text-sm">
                    <?php for($y=date('Y'); $y>=2020; $y--): ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="btn btn-primary px-6">
                    <i class="fas fa-filter text-xs"></i> Tampilkan Laporan
                </button>
                <button type="button" onclick="window.print()" class="px-6 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-lg transition-all font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-print text-xs"></i> Cetak Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card p-0 overflow-hidden" id="report-print-area">
    <div class="hidden print:block p-10 border-b-2 border-slate-900 text-center">
        <h1 class="text-4xl font-black tracking-tighter">SIMRS <span class="text-blue-600">PRO</span></h1>
        <h2 class="text-xl font-bold mt-2 uppercase tracking-widest text-slate-700">Laporan <?= $tanggal_filter ? 'Harian' : 'Bulanan' ?> Peresepan Obat</h2>
        <p class="text-slate-500 font-medium mt-1">
            Periode: <?= $tanggal_filter ? date('d M Y', strtotime($tanggal_filter)) : ($bulan ? $months[str_pad($bulan, 2, '0', STR_PAD_LEFT)] . ' ' . $tahun : $tahun) ?>
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                    <th class="px-8 py-5">No</th>
                    <th class="px-8 py-5">Tanggal</th>
                    <th class="px-8 py-5">Nama Pasien</th>
                    <th class="px-8 py-5">Dokter Pemeriksa</th>
                    <th class="px-8 py-5 text-right">Nilai Transaksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php 
                $total_pendapatan = 0;
                if(!empty($peresepan)): 
                    $i = 1; 
                    foreach($peresepan as $p): 
                        $total_pendapatan += $p['total_harga'];
                ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-5 text-sm text-slate-400 font-medium"><?= $i++ ?></td>
                            <td class="px-8 py-5 text-sm font-semibold text-slate-700">
                                <?= date('d M Y', strtotime($p['tanggal'])) ?>
                            </td>
                            <td class="px-8 py-5 text-sm font-bold text-slate-800"><?= $p['nama_pasien'] ?></td>
                            <td class="px-8 py-5 text-sm text-slate-600 italic"><?= $p['nama_dokter'] ?></td>
                            <td class="px-8 py-5 text-right font-black text-slate-900 text-sm">
                                Rp <?= number_format($p['total_harga'], 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-slate-400 italic font-medium">
                            <i class="fas fa-folder-open text-3xl block mb-4"></i>
                            Tidak ada data transaksi peresepan pada periode ini.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if(!empty($peresepan)): ?>
            <tfoot>
                <tr class="bg-slate-900 text-white">
                    <td colspan="4" class="px-8 py-6 text-right font-bold uppercase tracking-widest text-xs">Total Pendapatan Terakumulasi</td>
                    <td class="px-8 py-6 text-right font-black text-xl">
                        Rp <?= number_format($total_pendapatan, 0, ',', '.') ?>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<style>
@media print {
    body { background-color: white !important; }
    .no-print, nav, header, aside, footer, .card:not(#report-print-area) { display: none !important; }
    .card#report-print-area { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; }
    .lg\:ml-64 { margin-left: 0 !important; }
    main { padding: 0 !important; }
    tfoot tr { background-color: #000 !important; color: white !important; -webkit-print-color-adjust: exact; }
}
</style>

<?= $this->endSection() ?>
