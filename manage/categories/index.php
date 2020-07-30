<?php

$pathInc = '/webPHP/manage/includes/';

include_once $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'magicquotes.inc.php';

if (isset($_GET['add']))
{
  $pageTitle = 'Новая категория';
  $action = 'addform';
  $name = '';
  $id = '';
  $button = 'Добавить';

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

  try
  {
    $sql = 'INSERT INTO category SET
        name = :name';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error adding submitted category.');
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Изменить')
{
  include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

  try
  {
    $sql = 'SELECT id, name FROM category WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error fetching category details.');
  }

  $row = $s->fetch();

  $pageTitle = 'Изменить категорию';
  $action = 'editform';
  $name = $row['name'];
  $id = $row['id'];
  $button = 'Обновить';

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

  try
  {
    $sql = 'UPDATE category SET
        name = :name
        WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
  }
  catch (PDOException $e)
  {
   errorScript('Error updating submitted category.');
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Удалить')
{
  include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

  try
  {
    $sql = 'DELETE FROM jokecategory WHERE categoryid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error removing jokes from category.');
  }

  try
  {
    $sql = 'DELETE FROM category WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error deleting category.');
  }

  header('Location: .');
  exit();
}


include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

try
{
  $result = $pdo->query('SELECT id, name FROM category');
}
catch (PDOException $e)
{
  errorScript('Error fetching categories from database!');
}

foreach ($result as $row)
{
  $categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'categories.html.php';
