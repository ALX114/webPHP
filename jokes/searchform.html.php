<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/webPHP/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Управление шутками</title>
     <style type="text/css">
    input#Поиск {
      border-radius: 8px;
    }
      input#Поиск:hover{
        background-color: lightgrey;
      }
    }
    </style>
  </head>
  <body>
    <h1>Управление шутками</h1>
    <p><a href="?add">Добавить новую</a></p>
    <form action="" method="get">
      <p>Вывести шутки соответствующее следующему:</p>
      <div>
        <label for="author">По автору:</label>
        <select name="author" id="author">
          <option value="">Любой</option>
          <?php foreach ($authors as $author): ?>
            <option value="<?php htmlout($author['id']); ?>"><?php
                htmlout($author['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="category">По категории:</label>
        <select name="category" id="category">
          <option value="">Любая</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php htmlout($category['id']); ?>"><?php
                htmlout($category['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="text">Содержащая:</label>
        <input type="text" name="text" id="text">
      </div>
      <div>
        <input type="hidden" name="action" value="search">
        <input type="submit" id="Поиск" value="Поиск">
      </div>
    </form>
    <p><a href="..">Вернуться</a></p>
  </body>
</html>
