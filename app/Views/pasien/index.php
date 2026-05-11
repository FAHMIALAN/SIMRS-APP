<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Pasien SIMRS</h4>
            <a href="/pasien/create" class="btn btn-light btn-sm fw-bold">+ Tambah Pasien</a>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">No. RM</th>
                            <th width="25%">Nama Pasien</th>
                            <th width="35%">Alamat</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($pasien as $p) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><span class="badge bg-secondary"><?= $p['nomor_rm']; ?></span></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td>
                                <a href="/pasien/edit/<?= $p['id_pasien']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/pasien/delete/<?= $p['id_pasien']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pasien ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>