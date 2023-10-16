<?= $this->extend('template-admin/index');
$this->section('container'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
    <a href="<?= base_url('admin/produk/read') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Kumpulan Produk</a>
</div>

<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-body">

        <?php if (session()->has('break_the_rules')) : ?>
            <div class="alert alert-success">
                <?= session('break_the_rules') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')) : ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: 'Success!',
                        icon: 'success',
                        text: '<?= session('success') ?>',
                    });
                });
            </script>
        <?php endif; ?>

        <?= include('form-create.php') ?>

    </div>
</div>

<?= $this->endSection(); ?>