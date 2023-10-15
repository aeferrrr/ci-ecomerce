<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>
<header>
<!-- Content -->

<?php foreach ($produk as $pk): ?>
    <?php $id_produk = base64_encode($pk['id_produk']); ?>
    <form action="<?= base_url('/cart/add/') ?>" method="post">
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygallery" class="rounded-4" target="_blank" data-type="image">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?= base_url('uploads/' . $pk['gambar_produk']); ?>" />
                        </a>
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            <?= $pk['nama_produk'] ?>
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i><?php echo $penjualan ?> Penjualan</span>
                            <?php if ($pk['stok'] <= 0): ?>
                                <span class="text-danger ms-2">Stok Habis</span>
                            <?php elseif ($pk['stok'] <= 5): ?>
                                <span class="text-warning ms-2">Stok Terbatas</span>
                            <?php else: ?>
                                <span class="text-success ms-2">Stok Tersedia</span>
                            <?php endif; ?>

                        </div>

                        <div class="mb-3">
                            <span class="h5">Rp<?= number_format($pk['harga'], 0, ',', '.') ?></span>
                            <span class="text-muted">/per pcs</span>
                        </div>

                        <p>
                            <?= $pk['deskripsi'] ?>
                        </p>

                        <div class="row">
                            <dt class="col-3">Kategori:</dt>
                            <dd class="col-9"><?= $pk['nama_kategori'] ?></dd>

                            <dt class="col-3">Berat</dt>
                            <dd class="col-9"><?= $pk['berat'] ?> Gram</dd>
                        </div>

                        <hr />
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="colorChoice" class="form-label">Catatan</label>
                                <input type="text" class="form-control" id="colorChoice" name="colorChoice" placeholder="Tulis Catatan untuk Penjual disini">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4 col-6 mb-3">
                                <label class="mb-2 d-block">Jumlah</label>
                                <div class="input-group mb-3" style="width: 170px;">
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="jumlah_produk" class="form-control text-center border border-secondary" value="1" min="1" max="<?= $pk['stok'] ?>"  />
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    
                        <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                        <input type="hidden" name="id_akun" value="<?= session()->get('id_akun') ?>">
                        <?php if ($pk['stok'] <= 0): ?>
                            <a class="btn btn-danger shadow-0">
                            </i> STOK HABIS
                        </a>
                        <?php else: ?>
                        <button type="submit" class="btn btn-primary shadow-0">
                            <i class="me-1 fa fa-shopping-basket"></i> Masukan Keranjang
                        </button>
                        <?php endif; ?>
                    </form>

                    </div>
                </main>
            </div>
        </div>
                            
    </section>
<?php endforeach; ?>
<div class="cart-container">
  <a href="<?= base_url('/cart') ?>">
    <div class="cart-icon">
      <i class="fa fa-shopping-cart"></i>
      <span class="item-count"><?php echo $keranjang?></span>
    </div>
  </div>

<?php $this->endSection(); ?>
