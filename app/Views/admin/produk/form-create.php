<form action="<?= base_url('admin/produk/create') ?>" method="post">
    <h5 class="card-title"><strong>Informasi Produk</strong></h5>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <div class="input-group mb-0">
                <select class="custom-select" name="id_kategori" required>
                    <option disabled selected aria-describedby="button-addon1">Pilih Kategori...</option>
                    <option value="1">One</option>
                    <?php foreach ($kategori as $kategori) : ?>
                        <option value="<?= $kategori['id_kategori']; ?>"><?= ucfirst($kategori['nama_kategori']); ?></option>
                    <?php endforeach ?>
                </select>
                <div class="input-group-append">
                <a href="<?= base_url('admin/kategori/create') ?>"> <button class="btn btn-outline-primary" type="button" id="button-addon2">Tambah Kategori</button> </a>

                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="sku" class="col-sm-2 col-form-label">SKU</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="" placeholder="24124124" name="nama_produk">
        </div>
    </div>
    <div class="form-group row">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="" placeholder="Pensil 2B" name="nama_produk">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Harga Produk</label>
        <div class="col-sm-10">
            <div class="input-group mb-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" class="form-control" placeholder="9.900" name="harga">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="stok" placeholder="Stok barang" name="stok">
        </div>
    </div>
    <div class="form-group row">
        <label for="berat" class="col-sm-2 col-form-label">Berat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="berat" placeholder="gram" name="berat">
        </div>
    </div>
    <div class="form-group row">
    <label for="gambar" class="col-sm-2 col-form-label">Gambar Produk</label>
    <div class="col-sm-10">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="gambar" name="gambar_produk">
            <label class="custom-file-label" for="gambar">Pilih file gambar...</label>
        </div>
    </div>
</div>
    <div class="form-group row">
    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Produk</label>
    <div class="col-sm-10">
        <textarea class="form-control <?php echo session('field_error.alamat_pegawai') ? 'is-invalid' : ''; ?>" id="deskripsi" placeholder="Deskripsi Produk" name="deskripsi" rows="3"></textarea>
        <?php if (session()->has('field_error.alamat_pegawai')) : ?>
                <div class="invalid-feedback">
                    <?php echo session('field_error.alamat_pegawai'); ?>
                </div>
            <?php endif; ?>
    </div>
</div>
    <button class="btn btn-primary" type="submit">Simpan Produk</button>
</form>

<!-- css gambar produk -->
<style>
/* CSS for custom file input */
.custom-file-label::after {
    content: "Pilih file"; /* Label default */
}

.custom-file-input::before {
    content: "Telusuri"; /* Tombol "Browse" */
}

.custom-file-label::after {
    content: "Pilih file"; /* Label setelah memilih file */
}

.custom-file-input {
    color: transparent;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>