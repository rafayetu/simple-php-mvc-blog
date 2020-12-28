<?php

use app\core\Application;
$view = $view ?? null;
?>


<header class="blog-header py-4">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
            <a class="link-secondary" href="#">Subscribe</a>
        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/"><?php echo SITE_NAME; ?></a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <!--                <a class="link-secondary" href="#" aria-label="Search">-->
            <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>-->
            <!--                </a>-->
            <?php if (Application::$app->user->isUserLoggedIn) { ?>
                <a class="btn btn-sm btn-outline-secondary mx-1 dropdown-toggle" href="#" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $app->user->getFullName(); ?>
                </a>
                <ul class="dropdown-menu my-1">
                    <li><a class="btn btn-sm dropdown-item" href="/profile">Profile</a></li>
                    <li><a class="btn btn-sm dropdown-item" href="/post-editor">Write a Post</a></li>
                    <li><a class="btn btn-sm dropdown-item" href="/post-list">Post List</a></li>
                    <?php if (Application::$app->user->isAdminUser()) {?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="btn btn-sm dropdown-item" href="#">Something else here</a></li>
                    <?php } ?>

                </ul>
                <a class="btn btn-sm btn-outline-secondary mx-1" href="/logout">Sign out</a>
            <?php } else { ?>
                <a class="btn btn-sm btn-outline-secondary mx-1" href="/login">Sign in</a>
                <a class="btn btn-sm btn-outline-secondary mx-1" href="/register">Sign up</a>
            <?php } ?>



        </div>
    </div>

</header>
