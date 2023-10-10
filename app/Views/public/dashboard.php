<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>

<div class="row">
                <?php foreach ($produk as $pk): 
                $id_produk = base64_encode($pk['id_produk']);
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm custom-card">
                            <img src="<?= base_url('uploads/' . $pk['gambar_produk']); ?>" class="card-img-top custom-img" alt="<?= $pk['nama_produk'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $pk['nama_produk'] ?></h5>
                                <p class="card-text"><?= $pk['nama_kategori'] ?></p>
                                <p class="card-text"><strong>Rp<?= number_format($pk['harga'], 0, ',', '.') ?></strong></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                            <a href="<?= base_url('admin/knowledge/' . $id_produk) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>





<div class="cart-container">
<a href="/cart">
  <div class="cart-icon">
    <i class="fa fa-shopping-cart"></i>
    <span class="item-count">0</span>
  </div>
</div>

<style>
    .cart-container {
  position: fixed;
  bottom: 20px; /* Sesuaikan dengan posisi vertikal yang Anda inginkan */
  right: 20px; /* Sesuaikan dengan posisi horizontal yang Anda inginkan */
  z-index: 1000; /* Atur z-index sesuai kebutuhan */
}

.cart-icon {
  cursor: pointer;
  background-color: #ff0000; /* Warna latar belakang ikon */
  color: #fff; /* Warna teks ikon */
  border-radius: 50%;
  padding: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan */
}

.fa-shopping-cart {
  font-size: 24px;
}

.item-count {
  font-size: 14px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style>
<?php $this->endSection(); ?>