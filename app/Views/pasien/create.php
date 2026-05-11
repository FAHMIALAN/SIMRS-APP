<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Pasien Baru</h5>
                </div>
                <div class="card-body">
                    <form action="/pasien/store" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekam Medis (RM)</label>
                            <input type="text" name="nomor_rm" class="form-control <?= ($validation->hasError('nomor_rm')) ? 'is-invalid' : ''; ?>" value="<?= old('nomor_rm'); ?>" autofocus>
                            <div class="invalid-feedback"><?= $validation->getError('nomor_rm'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3"><?= old('alamat'); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/pasien" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>