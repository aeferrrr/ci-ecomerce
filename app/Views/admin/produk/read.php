<?= $this->extend('template-admin/index');
$this->section('container'); ?>

<style>
    table {
        width: 100%;
    }

    th, td {
        text-align: center;
        padding: 10px;
        white-space: nowrap; /* Mencegah teks yang panjang melebihi sel */
    }

    td img {
        max-width: 100px; /* Atur ukuran maksimum gambar */
        max-height: 100px; /* Atur ukuran maksimum gambar */
        display: block; /* Memastikan gambar tetap berada di dalam sel */
        margin: 0 auto; /* Posisikan gambar ke tengah sel */
    }

    td .description {
        word-wrap: break-word; /* Membuat deskripsi wrap ke bawah jika terlalu panjang */
        text-align: justify;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk List</h1>
    <a href="<?= base_url('admin/produk/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Produk</a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white" id="dataTable">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Kategori Produk</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk</th>
                        <th>Stok</th>
                        <th>Berat</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($produk as $pr) : ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $pr['nama_kategori']; ?></td>
                            <td><?= $pr['sku']; ?></td>
                            <td><?= $pr['nama_produk']; ?></td>
                            <td>Rp.<?= number_format($pr['harga']); ?></td>
                            <td><?= $pr['stok']; ?></td>
                            <td><?= $pr['berat']; ?></td>
                            <td><img src="<?= base_url('uploads/' . $pr['gambar_produk']);?>"></td>
                            <td style="text-align: justify;"><?= wordwrap($pr['deskripsi'], 50, "<br>\n", true); ?></td>

                            <td>
                                <a href="<?= base_url('koperasi/produk/update/' . $pr['id_produk']) ?>" class="btn btn-sm btn-warning btn-circle update">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/produk/delete/' . $pr['id_produk']) ?>" class="btn btn-sm btn-danger btn-circle delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Sukses Hapus',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal Hapus',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan:', error);
                        });
                }
            });
        });
    });

    const updateButton = document.querySelectorAll('.update');

    updateButton.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Konfirmasi Edit',
                text: 'Apakah Anda yakin ingin mengedit data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const idBrand = <?= isset($pr['qr_produk']) ? json_encode($pr['qr_produk']) : 'null' ?>;
                    if (idBrand !== null) {
                        window.location.href = url;
                    } else {
                        console.error('id_brand tidak memiliki nilai.');
                    }
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>
