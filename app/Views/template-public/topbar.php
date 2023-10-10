<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
            <img src="https://1.bp.blogspot.com/-Btegxn7O3hk/X5GWBUPfHQI/AAAAAAAAJ1U/x2Tdgy-iNqIYwsZNHnALJIPRMAwOZvrLACLcBGAsYHQ/s0/UBI.png" alt="Logo" width="50" height="50">
            </svg>
          
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <style>
    .btn {
        margin-right: 10px; /* Mengatur jarak pada tombol kanan */
    }
</style>
<script>
    var tokenSent = false;
</script>

<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('search/Event') ?>">Event</a></li>
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pengaturan" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kategori
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pengaturan">

                        <a class="dropdown-item" href="<?php echo base_url('search/MAGANG'); ?>">Magang</a>
                        <a class="dropdown-item" href="<?php echo base_url('search/SEMINAR'); ?>">Seminar</a>
                        <a class="dropdown-item" href="<?php echo base_url('search/PENELITIAN'); ?>">Penelitian</a>
                        <a class="dropdown-item" href="<?php echo base_url('search/PKM'); ?>">PKM</a>
                        <a class="dropdown-item" href="<?php echo base_url('search/REKOGNISI'); ?>">Rekognisi</a>
                    </div>
                </li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('publikasi') ?>">Publikasi</a></li>
    </ul>
<?php if (session()->has('id_akun')): ?>
    <div class="position-relative">
    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <?php if (!empty($profile['foto_profile'])) : ?>
            <img src="<?= base_url('uploads/' . $profile['foto_profile']); ?>" alt="mdo" width="32" height="32" class="rounded-circle">
        <?php else : ?>
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        <?php endif; ?>
    </a>
   
    <ul class="dropdown-menu dropdown-menu-end text-small shadow">
        <li> <a class="dropdown-item"> <?= session()->get('nama'); ?></a></li>
        <li><a class="dropdown-item" href="<?= base_url('uploader/profile/update/' . session()->get('id_akun')); ?>">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" id="logoutButton">Sign out</a></li>
    </ul>
</div>
<?php else: ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Login</button>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</button>
<?php endif; ?>





</div>


    </div>
</nav>
<!-- Modal -->
<!-- Modal untuk registrasi -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('auth/register') ?>" method="post">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="<?php echo base_url('auth/activated'); ?>">Aktivasi Akun</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk login -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('auth/login') ?>" method="post">
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleLoginPassword"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Event listener untuk tombol logout
    document.getElementById('logoutButton').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah aksi default link
        
        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Logout',
            text: 'Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('auth/logout'); ?>";
            }
        });
    });
</script>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
</script>
<script>
    const toggleLoginPassword = document.getElementById('toggleLoginPassword');
const loginPasswordInput = document.getElementById('loginPassword');
toggleLoginPassword.addEventListener('click', function () {
    const type = loginPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    loginPasswordInput.setAttribute('type', type);
});
</script>