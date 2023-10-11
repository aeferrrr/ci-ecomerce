<?= $this->extend('template-admin/index');
$this->section('container'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kategori List</h1>
    <a href="<?= base_url('admin/kategori/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Kategori</a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white" id="dataTable">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Nama Kategori</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($kategori as $kt) : ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $kt['nama_kategori']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/kategori/update/' . $kt['id_kategori']) ?>" class="btn btn-sm btn-warning btn-circle update">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/kategori/delete/' . $kt['id_kategori']) ?>" class="btn btn-sm btn-danger btn-circle delete">
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
                    const idKategori = <?= isset($kt['id_kategori']) ? json_encode($kt['id_kategori']) : 'null' ?>;
                    if (idKategori !== null) {
                        window.location.href = url;
                    } else {
                        console.error('id_kategori tidak memiliki nilai.');
                    }
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>