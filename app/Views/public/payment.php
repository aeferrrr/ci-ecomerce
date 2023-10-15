<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">FORM PEMESANAN</h2>
                </div>
                <div class="card-header">
                    <div class="mb-4">
                        <center>
                        <label for="saldo" class="form-label">TERIMAKASIH SUDAH BERBELANJA</label> <br>
                        </center>
                        <h1 class="text-center">
                            <p class="booking-code"><?php echo $transaksi['nama'] ?> </p>
                        </h1>
                    </div>
                    <div class="mb-4">
                        <center>
                        <label for="denda" class="form-label">Total Pembayaran:</label> <br>
                        </center>
                        <h1 class="text-center">
                            <p class="nominal">Rp.<?php echo number_format($transaksi['total_harga'], 2, ',', '.'); ?><button class="btn copy-button"><img src="https://cdn-icons-png.flaticon.com/512/54/54702.png" alt="Copy " title="Copy " width="20" height="20"></button></p>
                        </h1>
                    </div>
                        <div class="mb-4 text-center">
                            <label for="rekening" class="form-label">No Rekening:</label>
                            <br>
                            <img src="https://mandiri-investasi.co.id/wp-content/uploads/2021/11/bsi-PNG.png" width="90px">
                            <p style="font-size: 20px;">7195540521 <button class="btn copy-button"><img src="https://cdn-icons-png.flaticon.com/512/54/54702.png" alt="Copy " title="Copy " width="20" height="20"></button></p>
                            <p style="font-size: 20px;">YAYASAN KEMAKMURAN DAN KESEJAHTERAAN ANAK BANGSA</p>
                        </div>
                        <div class="card-header text-white bg-warning mb-4">
                            <p class="text-center">Harap Melakukan Transfer Sesuai Total Pembayaran</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>