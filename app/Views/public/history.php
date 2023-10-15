<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>
<div class="container">
<div class="row">
  <div class="col-xxl-8 col-12">
    <!-- Start of foreach loop to display transactions -->
    <?php foreach ($transaksi as $tr): ?>
      <!-- card -->
      <div class="card mb-3">
        <!-- card body-->
        <div class="card-body">
          <div class="mb-6">
          <div class="d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Order #<?= $tr['id_transaksi'] ?></h4>
            <?php $nomorResi = $tr['resi'] ?? 0; // Jika 'resi' adalah null, maka nilainya adalah 0 ?>
            
            <span class="ms-2">Pesanan di Proses</span>
            <div>
                  <!-- link -->
                  <a href="#">Manage Order</a>
                  <a href="#" class="ms-6">View Invoice</a>
                </div>
          </div>
          <span class="ms-2">Nomor Resi: <?= $nomorResi ?></span>
          </div>
         <span class="ms-2">Alamat Penerima: <?= isset($tr['id_alamat']) ? $tr['id_alamat'] : 'Alamat not available' ?></span>


          <!-- Start of foreach loop to display items in the transaction -->
          <?php foreach ($tr['items'] as $item): ?>
            <div class="border-bottom mb-3 pb-3 d-lg-flex align-items-center justify-content-between">
              <div class="col-lg-8 col-12">
                <div class="d-md-flex">
                  <div>
                    <!-- img -->
                    <img src="<?=base_url('uploads/' . $item['gambar_produk']);  ?>" alt=""
                      class="img-4by3-xl rounded" style="width: 96px; height: 96px;">
                  </div>
                  <div class="ms-md-4 mt-2 mt-lg-0">
                    <!-- heading -->
                    <h5 class="mb-1">
                      <?= $item['nama_produk'] ?>
                    </h5>
                    <!-- text -->
                    <span>Notes: <?= $item['catatan'] ?></span>
                    <!-- text -->
                    <div class="mt-3">
                      <h4>Rp.<?= number_format($item['total'], 0, ',', '.') ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- End of foreach loop to display items -->
           
          <div class="text-end mt-4">
          <h5 class="mb-0">Total Pembayaran: Rp.<?= number_format($item['total_harga'], 0, ',', '.') ?></h5>
          </div>
        </div>
      </div>
      <!-- End of card -->
    <?php endforeach; ?>
    <!-- End of foreach loop to display transactions -->
  </div>
</div>
</div>
<?= $this->endSection(); ?>
