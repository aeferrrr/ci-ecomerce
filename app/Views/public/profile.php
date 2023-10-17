<?= $this->extend('template-public/index'); ?>

<?php $this->section('container'); ?>

<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Ganti Password</div>
                <div class="card-body">
                <form action="<?= base_url('auth/change_password') ?>"  enctype="multipart/form-data" method="post">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="oldpassword">Password Lama</label>
                            <div class="input-group">
                                <input class="form-control" id="oldpassword" name="oldpassword" type="password" placeholder="Masukkan Password Lama" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="toggleLoginPassword1" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="newpassword">Password Baru</label>
                                <div class="input-group">
                                    <input class="form-control" id="newpassword" name="newpassword" type="password" placeholder="Masukkan Password Baru" value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" id="toggleLoginPassword2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label class="small mb-1" for="confirmpassword">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Masukkan Konfirmasi Password Baru" value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" id="toggleLoginPassword3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="account_id" id="account_id" value=" <?= base64_encode($akun['id_akun']) ?>">
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const tombolpassword1 = document.getElementById('toggleLoginPassword1');
    const inputpassword1 = document.getElementById('oldpassword');
    tombolpassword1.addEventListener('click', function () {
        const type = inputpassword1.getAttribute('type') === 'password' ? 'text' : 'password';
        inputpassword1.setAttribute('type', type);
    });
</script>
<script>
    const tombolpassword2 = document.getElementById('toggleLoginPassword2');
    const inputpassword2 = document.getElementById('newpassword');
    tombolpassword2.addEventListener('click', function () {
        const type = inputpassword2.getAttribute('type') === 'password' ? 'text' : 'password';
        inputpassword2.setAttribute('type', type);
    });
</script>
<script>
    const tombolpassword3 = document.getElementById('toggleLoginPassword3');
    const inputpassword3 = document.getElementById('confirmpassword');
    tombolpassword3.addEventListener('click', function () {
        const type = inputpassword3.getAttribute('type') === 'password' ? 'text' : 'password';
        inputpassword3.setAttribute('type', type);
    });
</script>

<style>
    body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
    </style>

<?php $this->endSection(); ?>