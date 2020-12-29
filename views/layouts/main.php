<?php

use app\core\Application;

$app = Application::$app;
$view = $view ?? null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Rafayet Ullah">
    <meta name="generator" content="Hugo 0.79.0">
    <title><?php echo $view->getTitle() . " | " . SITE_NAME; ?> </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .link-black {
            color: black;
            text-decoration: none;

        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/blog.css">

    {{extra_css}}
</head>
<body>
<?php include_once "messages.php" ?>

<div class="container-fluid">
    <?php include_once "header.php"; ?>
    <div class=" py-1 m-2 bg-light rounded">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 link-secondary link-black" href="/contact">World</a>
            <a class="p-2 link-secondary link-black" href="#">U.S.</a>
            <a class="p-2 link-secondary link-black" href="#">Technology</a>
            <a class="p-2 link-secondary link-black" href="#">Design</a>
            <a class="p-2 link-secondary link-black" href="#">Culture</a>
            <a class="p-2 link-secondary link-black" href="#">Business</a>
            <a class="p-2 link-secondary link-black" href="#">Politics</a>
            <a class="p-2 link-secondary link-black" href="#">Opinion</a>
            <a class="p-2 link-secondary link-black" href="#">Science</a>
            <a class="p-2 link-secondary link-black" href="#">Health</a>
            <a class="p-2 link-secondary link-black" href="#">Style</a>
            <a class="p-2 link-secondary link-black" href="#">Travel</a>
        </nav>
    </div>


</div>

<main class="container-fluid">

    <?php
    if (Application::$app->request->getFullPath() == "/") {
        include_once "featured.php";
    }
    ?>


    <div class="row mt-4">
        <?php if ($view->putTitle){
            echo "<h1 class='mb-4'>{$view->getTitle()}</h1>";
        }?>

        <div class="col-md-9">
            {{content}}
        </div>

        <div class="col-md-3">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="font-italic">About</h4>
                <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus
                    sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
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
        </div>

    </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.
    </p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script src="/js/script.js"></script>


{{extra_js}}

</body>
</html>
