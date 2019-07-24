<?php 
/*
  ETNA PROJECT, 26/11/2018 by soubri_j
  my_blog : index.php
  File description:
      Main page of the project.
*/
  $root = $_SERVER["DOCUMENT_ROOT"];
  include_once($root."/php/database.inc.php"); 
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
    <script type="text/javascript">
      if (document.location.hash == "" || document.location.hash=="#")
        document.location.hash="#home";
    </script>
    <title>My blog</title>
  </head>
  <body class="bg_img">
    <div class="container-fluid">
      <!-- Navigation -->
      <?php include_once($root."/php/navigation.inc.php"); ?>

      <div class="row content">
        <!-- Home part -->
        <?php include_once($root."/php/home.inc.php"); ?>

        <!-- About part -->
        <?php include_once($root."/php/about.inc.php"); ?>

        <!-- Education part -->
        <?php include_once($root."/php/education.inc.php"); ?>

        <!-- Skills part -->
        <?php include_once($root."/php/skills.inc.php"); ?>

        <!-- Missions part -->
        <?php include_once($root."/php/missions.inc.php"); ?>
        
        <!-- Contact part -->
        <?php include_once($root."/php/contact.inc.php"); ?>
      </div>
    </div>
  </body>
</html>