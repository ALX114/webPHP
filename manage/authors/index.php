<?php

$pathInc = '/webPHP/manage/includes/';

include_once $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'magicquotes.inc.php';

if (isset($_GET['add']))
{
  $pageTitle = 'Новый автор';
  $action = 'addform';
  $name = '';
  $email = '';
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
    $sql = 'INSERT INTO author SET
        name = :name,
        email = :email';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':email', $_POST['email']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error adding submitted author.');
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Изменить')
{
  include $_SERVER['DOCUMENT_ROOT'] .  $pathInc . 'db.inc.php';

  try
  {
    $sql = 'SELECT id, name, email FROM author WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error fetching author details.');
    
  }

  $row = $s->fetch();

  $pageTitle = 'Изменение автора';
  $action = 'editform';
  $name = $row['name'];
  $email = $row['email'];
  $id = $row['id'];
  $button = 'Обновить';

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include $_SERVER['DOCUMENT_ROOT'] .  $pathInc . 'db.inc.php';

  try
  {
    $sql = 'UPDATE author SET
        name = :name,
        email = :email
        WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':email', $_POST['email']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error updating submitted author.');
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Удалить')
{
  include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

  try
  {
    $sql = 'SELECT id FROM joke WHERE authorid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error getting list of jokes to delete.');
  }

  $result = $s->fetchAll();

  try
  {
    $sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
    $s = $pdo->prepare($sql);

    foreach ($result as $row)
    {
      $jokeId = $row['id'];
      $s->bindValue(':id', $jokeId);
      $s->execute();
    }
  }
  catch (PDOException $e)
  {
    errorScript('Error deleting category entries for joke.');
  }

  try
  {
    $sql = 'DELETE FROM joke WHERE authorid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error deleting jokes for author.');
  }

  try
  {
    $sql = 'DELETE FROM author WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    errorScript('Error deleting author.');
  }

  header('Location: .');
  exit();
}

include $_SERVER['DOCUMENT_ROOT'] . $pathInc . 'db.inc.php';

try
{
  $result = $pdo->query('SELECT id, name FROM author');
}
catch (PDOException $e)
{
  errorScript('Error fetching authors from the database!');
}

foreach ($result as $row)
{
  $authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'authors.html.php';
