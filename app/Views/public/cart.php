<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>

<!-- cart + summary -->
<section class="bg-light my-5">
    <div class="container">
        <div class="row">
            <!-- cart -->
            <div class="col-lg-9">
                <div class="card border shadow-0">
                    <div class="m-4">
                        <h4 class="card-title mb-4">Keranjang Saya</h4>
                        
                        <?php $totalHargaSemuaProduk = 0; 
                        $totalBerat = 0;?>
                        <?php foreach ($keranjang as $index => $pk): 
                        
                          $totalBerat += $pk['berat'];?>
                          <?php $id_produk = base64_encode($pk['id_produk']);?>
                          <?php $id_keranjang = base64_encode($pk['id_keranjang']);?>


                            <?php
                            $harga = $pk['harga'];
                            $qty = $pk['qty'];
                            $hasilPerkalian = $qty * $harga;
                            $totalHargaSemuaProduk += $hasilPerkalian;
                            ?>

                            <div class="row gy-3 mb-4">
                                <div class="col-lg-5">
                                    <div class="me-lg-5">
                                        <div class="d-flex">
                                            <img src="<?= base_url('uploads/' . $pk['gambar_produk']); ?>"
                                                class="border rounded me-3" style="width: 96px; height: 96px;" />
                                            <div class="">
                                                <a href="<?= base_url('/detail/' . $id_produk) ?>" class="nav-link"><?= $pk['nama_produk']; ?></a>
                                                <p class="text-muted"><?= $pk['catatan']; ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                    <div class="input-container">
                                    <div class="input-container">
                                    <button class="decrement-button" data-product-id="<?= $pk['id_produk']; ?>">-</button>
                                    <form id="cart-update-form" action="<?= base_url('/cart/update/') ?>" method="post">
                                        <input type="text" id="input-number-<?= $pk['id_produk']; ?>" value="<?= $qty; ?>" data-harga="<?= $harga; ?>" name="jumlah_produk">
                                    </form>

                                    <button class="increment-button" data-product-id="<?= $pk['id_produk']; ?>" data-max-qty="<?= $pk['stok']; ?>">+</button>
                                    </div>
                                    </div>
                                    <div class="">
                                        <text class="h6"> Rp.<span id="subtotal-<?= $pk['id_produk']; ?>">
                                                <?= number_format($hasilPerkalian, 0, ',', '.'); ?></span></text> <br />
                                        <small class="text-muted text-nowrap">Rp.<?= number_format($harga); ?>/ per
                                            item</small>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                    <div class="float-md-end">
                                    <form action="<?= base_url('/cart/delete/') ?>" method="post">
                                    <input type="hidden" value="<?= $id_keranjang?>" name="id_keranjang">
                                        <button type="submit" class="btn btn-light border text-danger icon-hover-danger"> Hapus</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        </form>
                    </div>

                </div>
            </div>
        

            <!-- cart -->
            <!-- summary -->
            <div class="col-lg-3">
                <div class="card shadow-0 border">
                    <div class="card-body">
                        <!-- Your summary section here -->
                        <div class="d-flex justify-content-between">
                            <p class="mb-2">Total Harga:</p>
                            <p class="mb-2 fw-bold" id="totalHargaSummary">
                                Rp.<?= number_format($totalHargaSemuaProduk, 0, ',', '.'); // Total harga semua produk ?>
                            </p>
                        </div>
                        <!-- Other summary elements here -->
                    </div>
                </div>
                <!-- Buttons for purchase and back to shop -->
                <form action="<?= base_url('/transaction/add') ?>" method="post">
                    <input type="hidden" name="id_akun" value="<?= base64_encode(session()->get('id_akun')) ?>">
                    <button type="submit" class="btn btn-success w-100 shadow-0 mb-2">Beli Sekarang</button>
                </form>
                <a href="<?= base_url('/') ?>" class="btn btn-light w-100 border mt-2">Kembali</a>
            </div>
            <!-- summary -->
        </div>
    </div>
</section>

<style>
.input-container {
  display: flex;
  align-items: center;
}

.increment-button,
.decrement-button {
  padding: 10px 15px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  font-size: 16px;
  border-radius: 4px;
}

.increment-button:hover,
.decrement-button:hover {
  background-color: #0056b3;
}

input {
  padding: 10px 15px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  text-align: center;
  width: 50px; /* Sesuaikan lebar dengan kebutuhan Anda */
}

/* Anda dapat menyesuaikan warna, padding, dan ukuran sesuai preferensi Anda. */

</style>

<!-- Script untuk handle penambahan dan pengurangan -->
<script>
    // Ambil semua tombol increment
// Ambil semua tombol increment
const incrementButtons = document.querySelectorAll('.increment-button');

// Tambahkan event listener untuk setiap tombol increment
incrementButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        const inputElement = document.getElementById('input-number-' + productId);
        const currentQty = parseInt(inputElement.value);
        const maxQty = this.getAttribute('data-max-qty'); // Ambil stok maksimum dari atribut data

        if (currentQty < maxQty) { // Batasi kuantitas sesuai stok maksimum
            inputElement.value = currentQty + 1;
            updateSubtotal(productId);
            updateTotalHarga();
            updateFormAction(productId, inputElement.value); // Panggil fungsi untuk memperbarui aksi formulir
        }
    });
});


    // Ambil semua tombol decrement
    const decrementButtons = document.querySelectorAll('.decrement-button');

// Tambahkan event listener untuk setiap tombol decrement
    decrementButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const inputElement = document.getElementById('input-number-' + productId);
            const currentQty = parseInt(inputElement.value);

            if (currentQty > 0) { // Pastikan tidak kurangi jumlah jika sudah 0
                inputElement.value = currentQty - 1;
                updateSubtotal(productId);
                updateTotalHarga();
                updateFormAction(productId, inputElement.value); // Panggil fungsi untuk memperbarui aksi formulir
            }
        });
        });

        // Contoh menggunakan jQuery untuk mengirim permintaan AJAX ke server
        function updateFormAction(productId, newQty) {
            const form = document.getElementById('cart-update-form');
            const newAction = `${form.getAttribute('action')}?product_id=${productId}&new_qty=${newQty}`;

            $.ajax({
                url: newAction,
                type: 'POST',
                data: {
                    product_id: productId,
                    new_qty: newQty
                },
                success: function (response) {
                    // Proses respons dari server, misalnya, perbarui tampilan keranjang belanja.
                },
                error: function (error) {
                    // Penanganan kesalahan, misalnya, tampilkan pesan kesalahan kepada pengguna.
                }
            });
        }

    // Fungsi untuk mengupdate subtotal per produk
    function updateSubtotal(productId) {
        const inputElement = document.getElementById('input-number-' + productId);
        const harga = inputElement.getAttribute('data-harga');
        const qty = inputElement.value;
        const subtotal = qty * harga;
        document.getElementById('subtotal-' + productId).textContent = 'Rp.' + subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    // Fungsi untuk mengupdate total harga semua produk
    function updateTotalHarga() {
        let totalHarga = 0;
        <?php foreach ($keranjang as $pk): ?>
            const qty<?= $pk['id_produk']; ?> = document.getElementById('input-number-<?= $pk['id_produk']; ?>').value;
            const harga<?= $pk['id_produk']; ?> = <?= $pk['harga']; ?>;
            totalHarga += qty<?= $pk['id_produk']; ?> * harga<?= $pk['id_produk']; ?>;
        <?php endforeach; ?>
        document.getElementById('totalHargaSummary').innerText = 'Rp.' + totalHarga.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    // Panggil fungsi updateTotalHarga saat halaman pertama kali dimuat
    updateTotalHarga();
</script>
<?= $this->endSection(); ?>
