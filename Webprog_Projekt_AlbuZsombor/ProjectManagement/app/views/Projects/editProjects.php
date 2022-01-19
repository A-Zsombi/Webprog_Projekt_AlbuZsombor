<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else :
        if(!isset($data)) : ?>
            <h1>Something went wrong! </h1>
    <?php else :  ?>
        <div class="container">
            <form action="<?php echo URLROOT; ?>/projects/editProjectContr2" method="POST"> 
                <input type = "hidden" name = "projectsId" value = "<?php echo $data->id; ?>" />
                <div class="mb-3 row">
                    <label for="name" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $data->name ?>" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="stage" id="stage" placeholder="Stage" value="<?php echo $data->stage ?>" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="number" class="form-control" name="value" id="value" placeholder="Value" value="<?php echo $data->value ?>" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="date" class="form-control" name="close_date" id="close_date" placeholder="Close date" value="<?php echo $data->close_date ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Project</button>
                <a name="" id="" class="btn btn-secondary" href="<?php echo URLROOT . '/projects/displayProjects' ?>" role="button">Cancel</a>
            </form>
        </div>
    <?php 
    endif;
endif;
require APPROOT . '/views/includes/footer.php';