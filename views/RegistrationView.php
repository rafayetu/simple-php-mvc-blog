<h1>Create an Account</h1>
<?php
    $form = \app\core\Form::begin('', 'post');?>
    <div class="row">
        <div class="col"><?php echo $form->field($model, 'firstname', 'text'); ?></div>
        <div class="col"><?php echo $form->field($model, 'lastname', 'text'); ?></div>
    </div>
<?php
    echo $form->field($model, 'email', 'text');
    echo $form->field($model, 'password', 'password');
    echo $form->field($model, 'confirmPassword', 'password');
    echo '<button type="submit" class="btn btn-primary">Sign Up</button>';
    echo \app\core\Form::end(); ?>


<!--<form method="post" action="" >-->
<!--    <div class="row">-->
<!--        <div class="col mb-3">-->
<!--            <label for="first-name" class="form-label">First Name</label>-->
<!--            <input type="text" name="firstname" class="form-control --><?php //echo $model->hasError('firstname') ? 'is-invalid' : '';?><!--"-->
<!--                   id="first-name" value="--><?php //echo ($model->firstname->getValue()); ?><!--">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //echo $model->getFirstError('firstname');?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col mb-3">-->
<!--            <label for="last-name" class="form-label">Last Name</label>-->
<!--            <input type="text" name="lastname" class="form-control --><?php //echo $model->hasError('lastname') ? 'is-invalid' : '';?><!--"-->
<!--                   id="last-name" value="--><?php //echo ($model->lastname->getValue()); ?><!--">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //echo $model->getFirstError('firstname');?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--    <div class="mb-3">-->
<!--        <label for="exampleInputEmail1" class="form-label">Email address</label>-->
<!--        <input type="text" name="email" class="form-control --><?php //echo $model->hasError('email') ? 'is-invalid' : '';?><!--"-->
<!--               id="exampleInputEmail1" aria-describedby="emailHelp" value="--><?php //echo ($model->email->getValue()); ?><!--">-->
<!--        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
<!--        <div class="invalid-feedback">-->
<!--            --><?php //echo $model->getFirstError('firstname');?>
<!--        </div>-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="password" class="form-label">Password</label>-->
<!--        <input type="password" name="password" class="form-control --><?php //echo $model->hasError('password') ? 'is-invalid' : '';?><!--"-->
<!--               id="password" value="--><?php //echo ($model->password->getValue()); ?><!--">-->
<!--        <div class="invalid-feedback">-->
<!--            --><?php //echo $model->getFirstError('firstname');?>
<!--        </div>-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="confirm-password" class="form-label">Confirm Password</label>-->
<!--        <input type="password" name="confirmPassword" class="form-control --><?php //echo $model->hasError('confirmPassword') ? 'is-invalid' : '';?><!--"-->
<!--               id="confirm-password" value="--><?php //echo ($model->confirmPassword->getValue()); ?><!--">-->
<!--        <div class="invalid-feedback">-->
<!--            --><?php //echo $model->getFirstError('confirmPassword');?>
<!--        </div>-->
<!---->
<!--    </div>-->
<!--    <div class="invalid-feedback">-->
<!--        --><?php //echo $model->getFirstError('firstname');?>
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary">Sign Up</button>-->
