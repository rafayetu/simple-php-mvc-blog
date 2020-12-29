<?php

use app\core\Application;

$app = Application::$app;

$category_route = $app->router->getRouteFromNamespace("category")
?>
<div class="p-4 mb-3 bg-light rounded">
    <h4 class="font-italic">About</h4>
    <p class="mb-0">This is a <em>Simple MVC Blog</em>. This is build by PHP OOP with MVC concept.  </p>
</div>
<div class="p-4 mb-3 bg-light rounded">
    <h4 class="font-italic"><?php echo $category_route["title"] ?></h4>
    <ol class="list-unstyled mb-0">
        <?php
        foreach ($app->category->categoryArray as $key => $value){
            echo "<li><a href='{$category_route['path']}/$key'>$value</a></li>";
        }
        ?>
    </ol>
</div>



<div class="p-4">
    <h4 class="font-italic">Archives</h4>
    <ol class="list-unstyled mb-0">
        <li><a href="#">March 2014</a></li>
        <li><a href="#">February 2014</a></li>
        <li><a href="#">January 2014</a></li>
        <li><a href="#">December 2013</a></li>
        <li><a href="#">November 2013</a></li>
        <li><a href="#">October 2013</a></li>
        <li><a href="#">September 2013</a></li>
        <li><a href="#">August 2013</a></li>
        <li><a href="#">July 2013</a></li>
        <li><a href="#">June 2013</a></li>
        <li><a href="#">May 2013</a></li>
        <li><a href="#">April 2013</a></li>
    </ol>
</div>

<div class="p-4">
    <h4 class="font-italic">Elsewhere</h4>
    <ol class="list-unstyled">
        <li><a href="#">GitHub</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Facebook</a></li>
    </ol>
</div>
