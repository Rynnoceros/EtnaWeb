<?php
/*
    ETNA PROJECT, 30/11/2018 by soubri_j
    my_blog : dal_article.inc.php
    File description:
        Data access layer for articles.
*/
$root = $_SERVER["DOCUMENT_ROOT"];
include_once($root."/models/Article.php");
include_once($root."/php/database.inc.php");

function get_all_articles(): array
{
    $statement = null;
    $results = null;
    $return_array = array();
    $my_database = Database::get_database();

    if ($my_database != null) {
        $statement = $my_database->prepare("SELECT rowid, title, creation_date,
            short_description, description, image_type, image FROM articles;");
        $statement->execute();
        if ($statement) {
            while ($row = $statement->fetch()) {
                $article = new Article($row["rowid"], $row["title"], $row["creation_date"], 
                    $row["short_description"], $row["description"], $row["image_type"], $row["image"]);
                array_push($return_array, $article);
            }
        } else {
            echo("Error querying articles!<br>");
        }
    }
    return $return_array;
}

function get_article(int $id): ?Article
{
    $article = null;
    $statement = null;
    $result = false;
    $my_database = Database::get_database();

    if ($my_database != null) {
        $statement = $my_database->prepare("SELECT rowid, title, creation_date, 
            short_description, description, image_type, image FROM articles WHERE rowid = :id");
        if ($statement) {
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            if ($statement) {
                $result = $statement->execute();
                if ($result) {
                    $result = $statement->fetch();
                    if ($result) {
                        $article = new Article($result["rowid"], $result["title"], 
                            $result["creation_date"], $result["short_description"],
                            $result["description"], $result["image_type"], $result["image"]);
                    }
                }
            }
        }
        if (!$statement) {
            echo("Error reading article ".$id."<br>");
        }
    }
    return $article;
}

function print_articles_list(array $articles, int $offset, int $nb_elements_per_page)
{   
    $nb_articles = 0;

    if ($articles) {
        $nb_articles = count($articles);
    }

    if ($nb_articles > $nb_elements_per_page) {
        print_pagination($articles, $nb_articles, $nb_elements_per_page);
    }

    for ($i = 0; ($i < $nb_elements_per_page) && ($offset * $nb_elements_per_page + $i < $nb_articles); $i++) {
        print_article_list($articles[$offset * $nb_elements_per_page + $i]);
    }
}

function print_pagination(array $articles, int $nb_articles, int $nb_elements_per_page)
{
    echo('<ul class="pagination offset-1 nav_pages">');
    echo('<li class="page-item"><a class="page-link btn btn-light" href="/php/blog.php?pagination=previous">Previous</a></li>');
    for ($i = 0; $i < $nb_articles; $i++) {
        if ($i % $nb_elements_per_page == 0) {
            $page = $i / $nb_elements_per_page;
            echo('<li class="page-item"><a class="page-link btn btn-light" href="/php/blog.php?pagination='.$page.'">'.$page.'</a></li>');
        }
    }
    echo('<li class="page-item"><a class="page-link btn btn-light" href="/php/blog.php?pagination=next">Next</a></li>');
    echo('</ul>');
}

function print_article_list(Article $article)
{
    if ($article != null) {
        echo('<a class="article_list col-10 offset-1" href="/php/display_article.php?id='.$article->getId().'">');
        echo('<b>'.$article->getTitle().'</b> ('.$article->getCreationDate().')');
        echo('<h6>'.$article->getShortDescription().'</h6>');
        echo('</a>');
    }
}

function add_article(Article $article):bool
{
    $statement = null;
    $result = false;
    $my_database = Database::get_database();

    if ($article != null) {
        $statement = $my_database->prepare(
            "INSERT INTO articles values (:title, :creation_date, 
            :short_description, :description, :image, :image_type);");
        if ($statement) {
            $statement->bindParam(":title", $article->getTitle());
            $statement->bindParam(":creation_date", $article->getCreationDate());
            $statement->bindParam(":short_description", $article->getShortDescription());
            $statement->bindParam(":description", $article->getDescription());
            $statement->bindParam(":image", $article->getImage());
            $statement->bindParam(":image_type", $article->getImageType());
            $result = $statement->execute();

            if (!$result) {
                echo ("Error adding article : ".$statement->errorInfo());
            }
        }
    }
    return $result;
}
?>