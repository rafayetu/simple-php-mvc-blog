<?php
$model = $model ?? null;
$fields = ["title", "created_at", "status", "category"];
?>
<table id="postListTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <?php
    foreach ($fields as $field) {
        if (property_exists($model, $field)) {
            echo "<th>{$model->$field->verbose}</th>";
        }
    }
    ?>
    <th>Action</th>
    </thead>
    <tbody>
    <?php
    foreach ($model->postList as $post) {
        echo "<tr>";
        foreach ($fields as $field) {
            if (property_exists($post, $field)) {
                if (in_array($field, ["status", "category"])) {
                    echo "<td>{$post->$field->getName()}</td>";
                } else {
                    echo "<td>{$post->$field}</td>";
                }

            }
        }
        echo "<td><a class='btn btn-sm btn-outline-primary m-1' href='/post-editor/{$post->id}'>Edit</a>
                  <a class='btn btn-sm btn-outline-success m-1' href='/post/{$post->id}'>Read</a></td>";
        echo "</tr>";

    }
    ?>

    </tbody>

</table>