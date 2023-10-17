<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>
<!-- Konten Utama -->
<div class="cart-container">
  <a href="/cart">
    <div class="cart-icon">
      <i class="fa fa-shopping-cart"></i>
      <span class="item-count"><?php echo $keranjang ?></span>
    </div>
  </div>
<div class="container mt-5">
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://img.freepik.com/free-photo/medium-shot-woman-chair-single-s-day-banner_23-2149520222.jpg" class="d-block w-100" alt="https://img.freepik.com/free-photo/medium-shot-woman-chair-single-s-day-banner_23-2149520222.jpg">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/free-photo/big-sale-discounts-products_23-2150336658.jpg" class="d-block w-100" alt="https://img.freepik.com/free-photo/big-sale-discounts-products_23-2150336658.jpg">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/premium-psd/creative-dj-hallowen-party-promotion-instagram-post-template_417074-137.jpg" class="d-block w-100" alt="https://img.freepik.com/premium-psd/creative-dj-hallowen-party-promotion-instagram-post-template_417074-137.jpg">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
            <div class="row">
            <?php
               foreach ($produk as $pk): 
                  $id_produk = base64_encode($pk['id_produk']);
                  ?>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm custom-card">
                            <a href="<?= base_url('/detail/' . $id_produk) ?>" class="card-link">
                                <img src="<?= base_url('uploads/' . $pk['gambar_produk']); ?>" class="card-img-top custom-img" alt="<?= $pk['nama_produk'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $pk['nama_produk'] ?></h5>
                                    <p class="card-text"><?= $pk['nama_kategori'] ?></p>
                                    <p class="card-text"><strong>Rp<?= number_format($pk['harga'], 0, ',', '.') ?></strong></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        

<!-- JavaScript untuk menetapkan tinggi yang sama ke kolom-kolom dalam satu baris -->
<style>
    /* Gaya CSS khusus untuk tautan */
    a.card-link {
        color: black; /* Warna teks menjadi hitam */
        text-decoration: none; /* Menghapus garis bawah tautan */
    }

    .custom-card {
    display: flex;
    flex-direction: column;
    height: 100%; /* Setel tinggi kartu menjadi 100% tinggi parentnya */
}

.custom-card .card-img-top {
    height: 200px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
}
</style>

<?php $this->endSection(); ?>
