<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Управленеи категориями</title>
    <style type="text/css">
    input {
      border-radius: 8px;
    }
      input:hover{
        background-color: lightgrey;
      }
      input#delete:hover {
          background-color: rgb(255, 0, 0);
        } 
    }
    </style>
  </head>
  <body>
    <h1>Управленеи категориями</h1>
    <p><a href="?add">Добавить новую категорию</a></p>
    <ul>
      <?php foreach ($categories as $category): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($category['name']); ?>
              <input type="hidden" name="id" value="<?php
                  echo $category['id']; ?>">
              <input type="submit" name="action" value="Изменить">
              <input type="submit" name="action" id="delete" value="Удалить">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
    <p><a href="..">Вернуться</a></p>
  </body>
</html>
