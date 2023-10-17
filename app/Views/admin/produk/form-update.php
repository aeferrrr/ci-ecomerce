<form action="<?= base_url('admin/produk/update/' . $produk['id_produk']) ?>" method="post" class="needs-validation">
     <!-- Display error message if available -->
     <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <h5 class="card-title"><strong>Informasi Produk</strong></h5>
    <div class="form-group row">
    <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Produk</label>
    <div class="col-sm-10">
        <select class="form-control <?php echo session('field_error.id_kategori') ? 'is-invalid' : ''; ?>" id="id_kategori" name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategoriList as $kategori) : ?>
                <option value="<?= $kategori['id_kategori']; ?>" <?= ($kategori['id_kategori'] == $produk['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $kategori['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (session('field_error.id_kategori')) : ?>
            <div class="invalid-feedback">
                <?php echo session('field_error.id_kategori'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
    <div class="form-group row">
        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" placeholder="Pensil 2B" name="nama_produk" value="<?= $produk['nama_produk']; ?>" >
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
                <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('harga')) ? 'is-invalid' : ''; ?>" placeholder="9.900" name="harga" value="<?= $produk['harga']; ?>">
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
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" placeholder="Stok barang" name="stok" min="1" value="<?= $produk['stok']; ?>">
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
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('berat')) ? 'is-invalid' : ''; ?>" id="berat" placeholder="gram" name="berat" value="<?= $produk['berat']; ?>">
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
            <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" placeholder="Deskripsi Produk" name="deskripsi" rows="3" value=""><?= $produk['deskripsi']; ?></textarea>
            <?php if (session('validation') && session('validation')->hasError('deskripsi')): ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('deskripsi'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Simpan Produk</button>
</form>

