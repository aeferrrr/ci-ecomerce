<form action="<?= base_url('admin/kategori/create') ?>" method="post" class="needs-validation">

    <h5 class="card-title"><strong>Informasi Kategori </strong></h5>

    <div class="form-group row">
        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?php echo session()->has('field_error.nama_kategori') ? 'is-invalid' : ''; ?>" id="nama_kategori" placeholder="Pakaian" name="nama_kategori">
            <?php if (session()->has('field_error.nama_kategori')) : ?>
                <div class="invalid-feedback">
                    <?php echo session('field_error.nama_kategori'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
            <!-- Tombol Simpan di pojok kanan bawah -->
            <button class="btn btn-primary" type="submit" id="save" >Simpan</button>
</form>