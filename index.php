<?php

use classes\DependenciesContainer;

include 'config.php';
include 'session.php';
include 'functions.php';

// TODO: move PDO as Class and provide it into all used classes
try {
  $pdo = new PDO('mysql:host=' . $config['db']['server'] . ';dbname=' . $config['db']['database'], $config['db']['login'], $config['db']['password'], [PDO::ATTR_PERSISTENT => true]);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("set names utf8");
} catch (PDOException $e) {
  echo $e->getMessage();
}


$Router = DependenciesContainer::init('Router');
$User = DependenciesContainer::init('User');
$View = DependenciesContainer::init('View');
$File = DependenciesContainer::init('File');

$page_title = 'Files';
$view_content = '';

if ($User->isLoggedIn()) {
  switch ($Router->getRequest()) {

    case '/user/edit':
      if ($Router->isPost()) {
        $User->SignInAction();
      }
      $page_title = 'Edit profile';
      $view_content = $View->render('register', [
        'month_list' => $month_list,
        'user_data' => $User->loadUserData($_SESSION['user_data']['user_id'])
      ]);
      break;

    case '/user/files':
      $page_title = 'User Files';
      $view_content = $View->render('files', ['userfiles' => $File->getUserFiles()]);
      break;

    case '/user/files/add':
      if ($Router->isPost() && $File->processUpload()) {
        $Router->gotoPath('/user/files');
      }
      break;

    case '/user/file/download/:int':
      $File->initDownload($Router->getArg('int', 0));
      break;

    case '/user/file/remove/:int':
      $File->remove($Router->getArg('int', 0));
      $Router->gotoPath('/user/files');
      break;

    case '/logout':
      $User->LogOutAction();
      $Router->gotoPath('/login');
      break;
  }
}
else {
  // Not logged in users
  switch ($Router->getRequest()) {
    default:
    case '/login':
      if ($Router->isPost()) {
        $User->LogInAction();
      }
      $page_title = 'Login';
      $view_content = $View->render('login');
      break;

    case '/register':
      if ($Router->isPost()) {
        $User->SignInAction();
      }
      $page_title = 'Register';
      $view_content = $View->render('register', ['month_list' => $month_list]);
      break;
  }
}


print $View->render('main-layout', [
  'page_title' => $page_title,
  'view_content' => $view_content
]);
