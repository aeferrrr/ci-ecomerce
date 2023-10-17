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
                        <th>Nama</th>
                        <th>Id Transaksi</th>
                        <th>Alamat</th>
                        <th>Produk</th>
                        <th>Resi</th>
                        <th>Catatan</th>
                        <th>Total Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($transaksi as $tr) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $tr['id_transaksi']; ?></td>

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