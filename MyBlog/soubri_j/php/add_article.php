<?php
/*
    ETNA PROJECT, 26/11/2018 by soubri_j
    my_blog : add_article.php
    File description:
        Add article page for my_blog project.
*/

    $result = false;
    $error_title = "no-error";
    $error_short_description = "no-error";
    $error_description = "no-error";
    $error_password = "no-error";
    $title = "";
    $success = "no-error";
    $image = null;
    $image_type = null;
    $root = $_SERVER["DOCUMENT_ROOT"];
    include_once($root."/dal/dal_article.inc.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = test_input($_POST["title"]);
        if (!$title) {
            $error_title = "error";
        }

        $short_description = test_input($_POST["short_description"]);
        if (!$short_description) {
            $error_short_description = "error";
        }

        $description = test_input($_POST["description"]);
        if (!$description) {
            $error_description = "error";
        }

        $password = test_input($_POST["password"]);
        if ($password != "toto") {
            $error_password = "error";
        }

        $image = $_FILES["imageFile"];
        if (count($image) > 0) {
            if ($image["tmp_name"]) {
                $image_type = $image["type"];
                $image = base64_encode(file_get_contents($image["tmp_name"]));
            } else {
                $image = null;
            }
        } else {
            $image = null;
        }

        if ($title && $short_description && $description && $error_password == "no-error") {
            $article = new Article(0, $title, date("d/m/Y"), $short_description,
                $description, $image_type, $image);
            if ($article != null) {
                $result = add_article($article);

                if ($result) {
                    header('location: /php/blog.php');
                    exit;
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data; 
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
    <title>Add article</title>
  </head>
  <body class="bg_img">
    <div class="container-fluid">
      <!-- Navigation -->
      <?php include_once("./navigation.inc.php"); ?>
      <div class="add-article">
          <div class="row">
              <h1>Add article</h1>
          </div>
          <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                    <label class="col-2 offset-2">Title</label>
                    <input name="title" class="col-6 <?php echo($error_title); ?>" 
                            type="text" value="<?php echo($title); ?>"/>
                </div>
                <div class="<?php echo($error_title) ?> col-8 offset-4">
                    Title must be field!
                </div>
                <div class="col-12">
                    <label class="col-2 offset-2">Short description</label>
                    <input name="short_description" class="col-6 <?php echo($error_short_description); ?>" 
                            type="text"  value="<?php echo($short_description); ?>"/>
                </div>
                <div class="<?php echo($error_short_description) ?> col-8 offset-4">
                    Short description must be field!
                </div>
                <div class="col-12">
                    <label class="col-2 offset-2">Description</label>
                    <textarea name="description" class="col-6 <?php echo($error_description); ?>" 
                            rows="6"><?php echo($description); ?></textarea>
                </div>
                <div class="<?php echo($error_description) ?> col-8 offset-4">
                    Description must be field!
                </div>
                <div class="col-12">
                    <label class="col-2 offset-2">Image</label>
                    <input class="col-6" type="file" name="imageFile" accept="image/*">
                </div>
                <div class="col-12">
                    <label class="col-2 offset-2">Password</label>
                    <input name="password" class="col-6 <?php echo($error_password); ?>" 
                            type="password" value="<?php echo($password); ?>"/>
                </div>
                <div class="<?php echo($error_password) ?> col-8 offset-4">
                    Incorrect password!
                </div>
                <button class="btn btn-light col-8 offset-2" type="submit">Add</button>
            </form>
          </div>
      </div>
    </div>
  </body>
</html>

