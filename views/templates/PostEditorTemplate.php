<?php
use app\core\Form;
?>


<div class="row ">
    <div class="col-12">
        <h1 class="h2 mb-4">Write a post</h1>
        <?php
        $form = Form::begin('', 'post');
        $model = $model ?? null;

        echo $form->field($model, 'title', 'text');
        echo $form->field($model, 'content', 'textarea', ["rows"=>5]);
        echo '<button type="submit" class="btn btn-primary" name="save">Save</button>';
        echo '<button type="submit" class="btn btn-success mx-2" name="publish">Publish</button>';
        Form::end();
        ?>
    </div>
</div>

