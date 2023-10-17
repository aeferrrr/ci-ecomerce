<?= $this->extend('template-admin/index'); ?>

<?= $this->section('container'); ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Transaksi</h1>
    <div class="d-none d-sm-inline-block filter-container">
        <input type="date" id="dateFrom" placeholder="Dari Tanggal" required>
        ->
        <input type="date" id="dateTo" placeholder="Hingga Tanggal" required>
        <button id="filterButton">Filter</button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white" id="dataTable">
            <thead class="bg-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Id Transaksi</th>
                        <th>Resi</th>
                        <th>Alamat</th>
                        <th>Produk</th>
                        <th></th>
                        <th>Ekspedisi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pembayaran</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                                <?php $i = 1;
                foreach ($transaksi as $tr) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= base64_encode($tr['id_transaksi']) ?></td>
                        <?php $addressDisplayed = false; ?>
                        <?php foreach ($alamat as $addr): ?>
                        <?php if ($addr['id_transaksi'] == $tr['id_transaksi'] && !$addressDisplayed): ?>
                        <td><?= $addr['resi'] ?></td>
                        <td><?= $addr['alamat'] ?><br><?= $addr['kota'] ?><br><?= $addr['kecamatan'] ?><br><?= $addr['kelurahan'] ?><br><?= $addr['provinsi'] ?><br><?= $addr['kode_pos'] ?><br></td>
                        <?php $addressDisplayed = true; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php $productCount = count($tr['items']); // Count the number of products in the transaction ?>
                        <td colspan="2"> <!-- Combine two cells for Product and Notes -->
                            <?php foreach ($tr['items'] as $index => $item): ?>
                                <?= $item['nama_produk'] ?> <?= $item['qty'] ?>pcs<br>
                                Note:<?= $item['catatan'] ?><br>
                                <?php if ($index < $productCount - 1): // Add a separator if there are more products ?>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $tr['ekspedisi'] ?></td>
                        <td><?= $tr['tanggal_pengiriman'] ?></td>
                        <td><?= number_format($tr['items'][0]['total_harga'], 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_url('koperasi/riwayat/detail/' . $tr['id_transaksi']) ?>" class="btn btn-sm btn-success btn-circle update">
                                <i class="fas fa-info"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>