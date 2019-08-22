<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('status') == "gagal") { ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('message') ?></div>
                <?php } ?>
            </div>
            <div class="col-md-1">
                <a href="javascript:window.history.go(-1);" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </section>
</div>