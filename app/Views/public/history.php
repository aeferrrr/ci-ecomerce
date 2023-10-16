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
                <h4 class="mb-0">Order #<?= base64_encode($tr['id_transaksi']) ?></h4>
                <span class="ms-2">Terimakasih Sudah berbelanja</span>
              </div>

              <!-- Display the address only once for this transaction -->
              <?php $addressDisplayed = false; ?>
              <?php foreach ($alamat as $addr): ?>
                <?php if ($addr['id_transaksi'] == $tr['id_transaksi'] && !$addressDisplayed): ?>
                  <span class="ms-2">Nomor Resi: <?= $addr['resi'] ?></span>
                  <br>
                  <span class="ms-2">Alamat Penerima: </span>
                  <div>
                    <?= $addr['alamat'] ?><br>
                    <?= $addr['kota'] ?><br>
                    <?= $addr['kode_pos'] ?><br>
                  </div>
                  <?php $addressDisplayed = true; ?>
                <?php endif; ?>
              <?php endforeach; ?>

            </div>

            <!-- Start of foreach loop to display items in the transaction -->
            <?php foreach ($tr['items'] as $item): ?>
              <div class="border-bottom mb-3 pb-3 d-lg-flex align-items-center justify-content-between">
                <div class="col-lg-8 col-12">
                  <div class="d-md-flex">
                    <div>
                      <!-- img -->
                      <img src="<?= base_url('uploads/' . $item['gambar_produk']); ?>" alt=""
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
              <h5 class="mb-0">Total Pembayaran: Rp.<?= number_format($tr['items'][0]['total_harga'], 0, ',', '.') ?></h5>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- End of card -->
      <!-- End of foreach loop to display transactions -->
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
