<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">

            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('menu/sub_edit'); ?>" method="post">

                <div class="form-group">

                    <label for="title">title</label>
                    <input type="hidden" class="form-control" id="id" name="id" value='<?= $subsmenu['id']; ?>'>
                    <input type="text" class="form-control" id="title" name="title" value='<?= $subsmenu['title']; ?>'>
                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="menu_id">menu_id</label>
                    <input type="text" class="form-control" id="menu_id" name="menu_id" value="<?= $subsmenu['menu_id']; ?>">
                    <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="url">url</label>
                    <input type="text" class="form-control" id="url" name="url" value="<?= $subsmenu['url']; ?>">
                </div>
                <div class="form-group">
                    <label for="icon">icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $subsmenu['icon']; ?>">
                </div>


                <div class="form-group">
                    <label for="icon"> Status Active</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" placeholder="Icon Name" value="1" checked>
                        <label class="form-check-label" for="is_active">Active</label>

                    </div>
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