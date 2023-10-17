<form action="<?= base_url('admin/transaksi/update/' . $resi['id_transaksi']) ?>" method="post" class="needs-validation">
    <h5 class="card-title"><strong>Informasi Resi</strong></h5>

    <div class="form-group row">
        <label for="resi" class="col-sm-2 col-form-label">Resi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('resi')) ? 'is-invalid' : ''; ?>" id="resi" placeholder="Masukan Resi" name="resi"  value="<?= $resi['resi']; ?>">
            <?php if (session('validation') && session('validation')->hasError('resi')) : ?>
                <div class="invalid-feedback">
                    <?= session('validation')->getError('resi'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <!-- Tombol Simpan di pojok kanan bawah -->
            <button class="btn btn-primary" type="submit" id="save" >Simpan</button>

        </div>
    </div>
</form>