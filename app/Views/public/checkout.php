<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>


<section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8 mb-4">
        
        <form action="<?= base_url('/transaction/checkout') ?>" method="post">
        
        
        <!-- Checkout -->
        <div class="card shadow-0 border">
          <div class="p-4">
            <h5 class="card-title mb-3">Data Pembeli</h5>
            <div class="row">
              <div class="col-12 mb-3">
                <p class="mb-0">Nama Pembeli</p>
                <div class="form-outline">
                  <input type="text" id="name" name="name" placeholder="Type here" disabled value="<?php echo $akun['nama'] ?>" class="form-control" />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">No HP</p>
                <div class="form-outline">
                  <input type="tel" id="phone" name="phone" disabled value="<?php echo $akun['telp'] ?>" class="form-control" />
                </div>
              </div>

              <div class="col-6 mb-3">
                <p class="mb-0">Email</p>
                <div class="form-outline">
                  <input type="email" id="email" name="email" disabled placeholder="example@gmail.com" value="<?php echo $akun['email'] ?>" class="form-control" />
                </div>
              </div>
            </div>


            <hr class="my-4" />
            <div class="form-group">
            <h5 class="card-title mb-3">Detail Pengiriman</h5>
            <div class="row mb-3">
              <div class="col-lg-4 mb-3">
                <!-- Default checked radio -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                  <input class="form-check-input" type="radio" name="courier" id="jne" value="jne" required>
                    <label class="form-check-label" for="jne">
                      JNE <br />
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <!-- Default radio -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                  <input class="form-check-input" type="radio" name="courier" id="tiki" value="tiki" required>
                    <label class="form-check-label" for="tiki">
                      TIKI <br />
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <!-- Default radio -->
                <div class="form-check h-100 border rounded-3">
                  <div class="p-3">
                  <input class="form-check-input" type="radio" name="courier" id="pos" value="pos" required>
                    <label class="form-check-label" for="pos">
                      POS INDONESIA <br />
                    </label>
                  </div>
                </div>
              </div>
            </div>
            </div>


            <div class="row">
              <div class="col-sm-8 mb-3">
                <p class="mb-0">Alamat</p>
                <div class="form-outline">
                  <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat" class="form-control" required value="" />
                </div>
              </div>

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Provinsi</p>
                <div class="form-outline">
                <select name="province" id="province" required>
                  <option value="">Pilih Provinsi</option>
                  <?php foreach ($provinsi['rajaongkir']['results'] as $province): ?>
                      <option value="<?= $province['province_id'] ?>"><?= $province['province'] ?></option>
                  <?php endforeach; ?>
                </select>
                </div>
              </div>        

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Kota</p>
                <div class="form-outline">
                <select name="city_id" id="city_id" required>
                  <option value="">Pilih Kota</option>
                </select>
                </div>
              </div>

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Kecamatan</p>
                <div class="form-outline">
                  <input type="text" id="kecamatan" name="kecamatan" placeholder="Masukan Kecamatan" class="form-control" required value="" />
                </div>
              </div>

              <div class="col-sm-4 mb-3">
                <p class="mb-0">Kelurahan</p>
                <div class="form-outline">
                  <input type="text" id="kelurahan" name="kelurahan" placeholder="Masukan Kelurahan" class="form-control" required value="" />
                </div>
              </div>

              <div class="col-sm-4 col-6 mb-3">
                <p class="mb-0">Kode Pos</p>
                <div class="form-outline">
                  <input type="text" id="kodepos" placeholder="Masukan Kodepos" name="kodepos" class="form-control" required value="" />
                </div>
              </div>
            </div>  
                  <?php $totalBerat = 0;?>
                  <?php $totalHargaSemuaProduk = 0; ?>
                  <?php foreach ($keranjang as $index => $pk):
                    $beratProduk = $pk['berat']; // Berat produk
                    $harga = $pk['harga'];
                    $qty = $pk['qty'];
                    $hasilPerkalian = $qty * $harga;
                    $totalBerat += $beratProduk * $qty;
                    $totalHargaSemuaProduk += $hasilPerkalian; ?>
                  <input type="hidden" name="products[<?= $index ?>][id]" value="<?= $pk['id_produk']; ?>">
                  <input type="hidden" name="products[<?= $index ?>][qty]" value="<?= $pk['qty']; ?>">
                  <input type="hidden" name="products[<?= $index ?>][catatan]" value="<?= $pk['catatan']; ?>">
                  <input type="hidden" name="products[<?= $index ?>][total]" value="<?= $hasilPerkalian ?>">
                    <?php endforeach; ?>

            <div class="float-end">
              <input type="hidden" id="selectedProvince" name="selectedProvince" value="">
              <input type="hidden" id="city_name" name="city_name" value="">
              <input type="hidden" name="id_akun" id="id_akun" value="<?= base64_encode(session()->get('id_akun')) ?>">
              <input type="hidden" name="total-pembayaran1" id="total-pembayaran1" value="">
              <a href="<?= base_url('/cart') ?>" class="btn btn-light border">Kembali</a>
              <button type="submit" class="btn btn-success shadow-0 border">Bayar</button>
            </div>
          </div>
        </div>
        </form>
        <!-- Checkout -->
        <?php $totalBerat = 0;?>
        <?php $totalHargaSemuaProduk = 0; ?>
        <?php foreach ($keranjang as $index => $pk): 
            $beratProduk = $pk['berat']; // Berat produk
            $harga = $pk['harga'];
            $qty = $pk['qty'];
            $hasilPerkalian = $qty * $harga;
            
            // Menambahkan berat produk untuk setiap qty
            $totalBerat += $beratProduk * $qty;

            // Menambahkan hasil perkalian harga produk dengan qty
            $totalHargaSemuaProduk += $hasilPerkalian;
        ?>
        <?php endforeach; ?>
        
        
      </div>
      <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
          <h6 class="mb-3">Rincian</h6>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Total Harga:</p>
            <p class="mb-2"> Rp.<?= number_format($totalHargaSemuaProduk, 0, ',', '.'); // Total harga semua produk ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Total Berat:</p>
            <p class="mb-2">
              <?php
              if ($totalBerat >= 1000) {
                  $totalBeratKilogram = $totalBerat / 1000;
                  echo  $totalBeratKilogram . ' kilogram';
              } else {
                  echo  $totalBerat . ' gram';
              }
              ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p  >Total Ongkos Kirim:</p>
            <p id="biaya-pengiriman" class="mb-2">Rp 0</p>
          </div>
          <hr />
          <div class="d-flex justify-content-between">
            <p class="mb-2">Total Pembayaran:</p>
            <p class="mb-2 fw-bold" id="total-pembayaran2">Rp. 0</p>
          </div>
          

          <hr />
          <h6 class="text-dark my-4">Produk</h6>
          <?php foreach ($keranjang as $index => $pk): 
            $harga = $pk['harga'];
            $qty = $pk['qty'];
            $hasilPerkalian = $qty * $harga;
            ?>

          <div class="d-flex align-items-center mb-4">
            <div class="me-3 position-relative">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
              <?= $pk['qty']; ?>x
              </span>
              <img src="<?= base_url('uploads/' . $pk['gambar_produk']); ?>" style="height: 96px; width: 96x;" class="img-sm rounded border" />
            </div>
            <div class="">
              <?= $pk['nama_produk']; ?> <br />
              <small> <?= $pk['catatan']; ?> </small>
              <div class="price text-muted">Total:  Rp. <?= number_format($hasilPerkalian, 0, ',', '.'); ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city_id');
    const cityNameInput = document.getElementById('city_name'); // Ganti 'city_name' dengan ID elemen input yang sesuai

    provinceSelect.addEventListener('change', () => {
        const selectedProvinceId = provinceSelect.value;
        if (selectedProvinceId) {
            fetch(`<?= base_url('public/transaction/getCityData/') ?>${selectedProvinceId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    citySelect.innerHTML = '<option value="">Pilih Kota</option>';

                    if (data.rajaongkir && data.rajaongkir.results) {
                        data.rajaongkir.results.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.city_id;
                            option.textContent = city.city_name;
                            citySelect.appendChild(option);
                        });
                    } else {
                        console.error('Data kota tidak ditemukan dalam respons JSON.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            cityNameInput.value = ''; // Clear the city name input if no province is selected
        }
    });

    // Event listener untuk dropdown kota
    citySelect.addEventListener('change', () => {
        cityNameInput.value = citySelect.options[citySelect.selectedIndex].text;
    });
</script>



<script>
    // Bagian JavaScript
    const selectProvince = document.getElementById('province');
    const hiddenInput = document.getElementById('selectedProvince');

    selectProvince.addEventListener('change', function() {
        hiddenInput.value = selectProvince.options[selectProvince.selectedIndex].text;
    });
</script>




<script>
$(document).ready(function () {
    function calculateShippingCost() {
        var selectedProvinceId = $("#province").val();
        var selectedCityId = $("#city_id").val();
        var selectedCourier = $("input[name='courier']:checked").val();

        if (selectedCityId && selectedCourier) {
            var weight = <?= $totalBerat; ?>;

            var data = {
                destination: selectedCityId,
                weight: weight,
                courier: selectedCourier
            };

            fetch("/rajaongkir/shipping-cost", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
              var shippingCost = data.rajaongkir.results[0].costs[0].cost[0].value;
              var formattedShippingCost = "Rp " + shippingCost.toLocaleString(); // Ubah ke format angka dengan separator ribuan
              console.log("Biaya Pengiriman: " + formattedShippingCost);
              $("#biaya-pengiriman").html(formattedShippingCost);

              var totalHargaProduk = <?= $totalHargaSemuaProduk; ?>; // Ambil total harga produk dari PHP di tampilan
              var totalPembayaran = totalHargaProduk + shippingCost;
              var formattedTotalPembayaran = totalPembayaran.toLocaleString(); // Ubah ke format angka dengan separator ribuan

              $("#total-pembayaran1").val(totalPembayaran);
              $("#total-pembayaran2").html('Rp.' + formattedTotalPembayaran);
              
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    }

    // Event handler untuk perubahan provinsi dan kota
    $("#province, #city_id").on("change", function () {
        calculateShippingCost();
    });

    // Event handler untuk perubahan kurir
    $("input[name='courier']").on("change", function () {
        calculateShippingCost();
    });

    // Pertama kali, hitung ongkos kirim
    calculateShippingCost();
});



</script>

<?php $this->endSection(); ?>