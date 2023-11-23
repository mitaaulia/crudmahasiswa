<div id="layoutSidenav_content">
    <div class="container-fluid">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Prestasi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('Profil') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('Prestasi') ?>">Prestasi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            Form Edit Pencatatan Prestasi
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $prestasi['id']; ?>">
                                <div class="form-group">
                                    <label for="judul_kegiatan">Judul Kegiatan</label>
                                    <input type="text" name="judul_kegiatan" value="<?= $prestasi['judul_kegiatan']; ?>" 
                                    class="form-control" value="<?= set_value('judul_kegiatan') ?>"
                                     id="judul_kegiatan" placeholder="Judul Kegiatan">
                                    <?= form_error('judul_kegiatan', '<small class="text-danger p1-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="aktifitas">Aktifitas</label>
                                    <input type="text" name="aktifitas" value="<?= $prestasi['aktifitas']; ?>"
                                    class="form-control" value="<?= set_value('aktifitas') ?>"
                                     id="aktifitas" placeholder="Aktifitas">
                                    <?= form_error('aktifitas', '<small class="text-danger p1-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="penilai_kegiatan">Penilai Kegiatan</label>
                                    <input type="text" name="penilai_kegiatan" value="<?= $prestasi['penilai_kegiatan']; ?>"
                                    class="form-control" value="<?= set_value('penilai_kegiatan') ?>"
                                     id="aktifitas" placeholder="penilai_kegiatan">
                                    <?= form_error('penilai_kegiatan', '<small class="text-danger p1-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/img/prodi') . $prestasi['gambar']; ?>" style="width: 100px;"
                                    class="img-thumbnail"
                                    alt="">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                        <label for="gambar" class="custom-file-label">Choose file</label>
                                        <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <a href="<?= base_url('Prestasi') ?>" class="btn btn-danger">Tutup</a>
                                <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Prestasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>