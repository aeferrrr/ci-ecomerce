<form action="<?= base_url('admin/kategori/create') ?>" method="post" class="needs-validation">

    <h5 class="card-title"><strong>Informasi Kategori</strong></h5>

    <div class="form-group row">
        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" placeholder="Pakaian" name="nama_kategori" value="<?= old('nama_kategori'); ?>">
            <?php if (session('validation') && session('validation')->hasError('nama_kategori')) : ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('nama_kategori'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Tombol Simpan di pojok kanan bawah -->
    <button class="btn btn-primary" type="submit" id="save">Simpan</button>
</form>
