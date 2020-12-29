<?php

use app\core\Application;

$model = $model ?? null;
$category_route = Application::$app->router->getRouteFromNamespace("category");
$profile_route = Application::$app->router->getRouteFromNamespace("profile");
$post_route = Application::$app->router->getRouteFromNamespace("post");

?>
<?php
if ($model->postList) {
    foreach ($model->postList as $post) { ?>
        <div class="p-4 mb-3 bg-light rounded">
            <div class="mb-3">
                <h4><a href="<?php echo "{$post_route['path']}/{$post->id}" ?>" class="text-dark"
                       style="text-decoration: none;"><?php echo $post->title; ?></a></h4>
                <small>
                    Category: <a class="" href="<?php echo "{$category_route['path']}/$post->category" ?>">
                        <?php echo $post->category->getName() ?></a> | Posted by
                    <a class="" href="<?php echo "{$profile_route['path']}/{$post->author->id}" ?>">
                        <?php echo $post->author->getFullName() ?></a>
                    on <?php echo $post->created_at ?></small>
            </div>

            <p class="mb-0"><?php echo $post->content->htmlText(400) ?>
                <b><a href="<?php echo "{$post_route['path']}/{$post->id}" ?>" class="text-dark" style="text-decoration: none;">(read
                        more...))</a></b>
            </p>
        </div>
    <?php }
} else {
    echo "<h2 class='mb-4'>No post found</h2>";
}

?>


