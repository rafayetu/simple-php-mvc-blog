<h3 class="h3 mb-3 fw-normal">Please sign in</h3>
<?php

use app\core\Form;

$form = Form::begin('', 'post');
$model = $model ?? null;

echo $form->field($model, 'email', 'email');
echo $form->field($model, 'password', 'password');
echo '<button type="submit" class="btn btn-primary">Login</button>';
Form::end();
?>



