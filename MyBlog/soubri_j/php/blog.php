<?php
/*
    ETNA PROJECT, 30/11/2018 by soubri_j
    my_blog : blog.php
    File description:
        Blog page for my_blog project.
*/
    session_start();
    $page = 0;
    $max_offset = 0;
    $articles = array();
    $nb_elements_per_page = 5;
    $root = $_SERVER["DOCUMENT_ROOT"];
    include_once($root."/dal/dal_article.inc.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $pagination = $_GET["pagination"];
        $articles = get_all_articles();
        $max_offset = count($articles) / $nb_elements_per_page;
        $page = manage_offset($pagination, $max_offset);
    }

    function manage_offset($pagination, int $max_offset): int
    {
        $offset = 0;  
        if (isset($_SESSION["offset"])) {
            $offset = $_SESSION["offset"];
        } 
        if (!$pagination) {
            $offset = 0;
        }
        if ($pagination == "previous") {
            if ($offset > 0) {
                $offset--;
            }
        } else if ($pagination == "next") {
            $offset++;
        } else if ($pagination != null && is_int((int)$pagination)) {
            $offset = $pagination;
        }
        if ($offset < 0) {
            $offset = 0;
        } else if ($offset > $max_offset) {
            $offset = $max_offset;
        }
        $_SESSION["offset"] = $offset;
        return $offset;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link href="../styles/index.css" rel="stylesheet"/>
        <title>My blog</title>
    </head>
    <body class="bg_img">
        <div class="container-fluid">
            <!-- Navigation -->
            <?php include_once("./navigation.inc.php"); ?>

            <div class="my_blog">
                <div class="row">
                    <h1>My blog</h1>
                </div>
                <div class="row">
                    <a href="/php/add_article.php" class="btn btn-light col-2 offset-1" type="submit">Add article</a>
                </div>
                <div class="row">
                    <?php print_articles_list($articles, $page, $nb_elements_per_page) ; ?>
                </div>
            </div>
        </div>
    </body>
</html>