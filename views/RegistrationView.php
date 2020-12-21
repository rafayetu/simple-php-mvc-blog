<h1>Create an Account</h1>
<form method="post" action="" >
    <div class="row">
        <div class="col mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" id="first-name" value="<?php echo ($model->firstname->getValue()); ?>">
        </div>
        <div class="col mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="last-name" value="<?php echo ($model->lastname->getValue()); ?>">
        </div>

    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo ($model->email->getValue()); ?>">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo ($model->password->getValue()); ?>">
    </div>
    <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" id="confirm-password" value="<?php echo ($model->confirmPassword->getValue()); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>