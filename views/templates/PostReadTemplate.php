<?php
$model = $model ?? null;
?>

<article class="blog-post">
    <h1 class="blog-post-title"><?php echo $model->title ?>
        <?php if ($model->author->isCurrentUser()) { ?>
            &nbsp;<a class="btn btn-sm btn-outline-primary" href="/post-editor/<?php echo $model->id ?>">Edit</a>
        <?php } ?>
    </h1>
    <p class="blog-post-meta">January 1, 2014 by <a href="/profile/<?php echo $model->author_id ?>"><?php
            echo $model->author->getFullName() ?></a></p>

    <hr>
    <?php echo html_entity_decode($model->content) ?>
</article>