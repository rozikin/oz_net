<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('menu/menu_edit'); ?>" method="post">

                <div class="form-group">

                    <label for="id">id</label>
                    <input type="hidden" class="form-control" id="id" name="id" value='<?= $menu['id']; ?>'>
                    <input type="text" class="form-control" id="id" name="id" value='<?= $menu['id']; ?>' readonly>
                    <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="menu">Menu Name</label>
                    <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>">
                    <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>



                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">edit</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->