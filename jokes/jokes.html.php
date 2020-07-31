<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Поиск</title>
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
    <h1>Результаты поиска</h1>
    <?php if (isset($jokes)): ?>
      <table>
        <tr><th>Текст шутки</th><th>Функции</th></tr>
        <?php foreach ($jokes as $joke): ?>
        <tr valign="top">
          <td><?php markdownout($joke['text']); ?></td>
          <td>
            <form action="?" method="post">
              <div>
                <input type="hidden" name="id" value="<?php
                    htmlout($joke['id']); ?>">
                <input type="submit" name="action" value="Изменить">
                <input type="submit" name="action" id="delete" value="Удалить">
              </div>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
    <p><a href="?">Снова</a></p>
    <p><a href="..">Домой</a></p>
  </body>
</html>
