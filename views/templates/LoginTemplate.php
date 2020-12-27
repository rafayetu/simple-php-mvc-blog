<h1>Login</h1>
<?php

use app\core\Form;

$form = Form::begin('', 'post');
$model = $model ?? null;

echo $form->field($model, 'email', 'email');
echo $form->field($model, 'password', 'password');
echo '<button type="submit" class="btn btn-primary">Login</button>';
Form::end();
?>



