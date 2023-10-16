<form action="<?= base_url('admin/produk/create') ?>" method="post" enctype="multipart/form-data" class="needs-validation">


     <!-- Display error message if available -->
     <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <h5 class="card-title"><strong>Informasi Produk</strong></h5>
    <div class="form-group row">
        <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
            <div class="input-group mb-0">
                <select class="custom-select <?= (session('validation') && session('validation')->hasError('id_kategori')) ? 'is-invalid' : ''; ?>" name="id_kategori">
                    <option disabled selected aria-describedby="button-addon1">Pilih Kategori...</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= ucfirst($k['nama_kategori']); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group-append">
                    <a href="<?= base_url('admin/kategori/create') ?>"><button class="btn btn-outline-primary" type="button" id="button-addon2">Tambah Kategori</button></a>
                </div>
                <?php if (session('validation') && session('validation')->hasError('id_kategori')): ?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('id_kategori'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="sku" class="col-sm-2 col-form-label">SKU</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('sku')) ? 'is-invalid' : ''; ?>" placeholder="24124124" name="sku">
            <?php if (session('validation') && session('validation')->hasError('sku')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('sku'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" placeholder="Pensil 2B" name="nama_produk">
            <?php if (session('validation') && session('validation')->hasError('nama_produk')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('nama_produk'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Harga Produk</label>
        <div class="col-sm-10">
            <div class="input-group mb-0">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('harga')) ? 'is-invalid' : ''; ?>" placeholder="9.900" name="harga">
                <?php if (session('validation') && session('validation')->hasError('harga')): ?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('harga'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" placeholder="Stok barang" name="stok">
            <?php if (session('validation') && session('validation')->hasError('stok')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('stok'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="berat" class="col-sm-2 col-form-label">Berat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('berat')) ? 'is-invalid' : ''; ?>" id="berat" placeholder="gram" name="berat">
            <?php if (session('validation') && session('validation')->hasError('berat')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('berat'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Produk</label>
        <div class="col-sm-10">
            <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" placeholder="Deskripsi Produk" name="deskripsi" rows="3"></textarea>
            <?php if (session('validation') && session('validation')->hasError('deskripsi')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('deskripsi'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="gambar_produk" class="col-sm-2 col-form-label">Gambar Produk</label>
        <div class="col-sm-10">
            <input type="file" class="form-control <?= (session('validation') && session('validation')->hasError('gambar_produk')) ? 'is-invalid' : ''; ?>" id="gambar_produk" name="gambar_produk">
            <?php if (session('validation') && session('validation')->hasError('gambar_produk')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('gambar_produk'); ?>
                </div>
            <?php endif; ?>
            <!-- Additional error message for missing image -->
            <?php if (session('error') && session('error') === 'Anda harus mengunggah gambar produk.'): ?>
                <div class="text-danger">Anda harus mengunggah gambar produk.</div>
            <?php endif; ?>
            <?php if (session('error') && session('error') === 'File harus berupa JPG, JPEG, atau PNG.'): ?>
                <div class="text-danger">File harus berupa JPG, JPEG, atau PNG.</div>
            <?php endif; ?>
            <?php if (session('error') && session('error') === 'Ukuran file harus kurang dari 2 MB.'): ?>
                <div class="text-danger">Ukuran file harus kurang dari 2 MB.</div>
            <?php endif; ?>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Simpan Produk</button>
</form>

