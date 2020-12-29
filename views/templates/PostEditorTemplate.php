<?php
use app\core\Form;
?>


<div class="row ">
    <div class="col-12">
        <?php
        $form = Form::begin('', 'post');
        $model = $model ?? null;

        echo $form->field($model, 'title', 'text');
        echo $form->field($model, 'content', 'textarea', ["rows"=>30], false);
        echo $form->button("Save", "save", "primary");
        echo $form->button("Publish", "publish", "success", "submit", "mx-2");
        Form::end();
        ?>
    </div>
</div>

