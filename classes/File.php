<?php
/**
 * Created by PhpStorm.
 * User: eugencherniy
 * Date: 3/10/15
 * Time: 2:25 AM
 */

namespace classes;


use interfaces\iSysMessage;
use PDO;

class File {

  private $SysMessage;

  public function __construct(iSysMessage $SysMessage) {
    $this->SysMessage = $SysMessage;
  }

  public function getUserFiles() {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM files WHERE user_id=?');
    $stmt->execute([$_SESSION['user_data']['user_id']]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  private function getCountUserFiles() {
    global $pdo;
    $stmt = $pdo->prepare('SELECT COUNT(id) FROM files WHERE user_id=? AND filestatus=?');
    $stmt->execute([$_SESSION['user_data']['user_id'], 'active']);
    return $stmt->fetchColumn();
  }

  public function processUpload() {
    if (!empty($_FILES) && self::getCountUserFiles() + count($_FILES) <= MAX_FILES_PER_USER) {
      for ($i = 0; $i < count($_FILES['uploadfile']['name']); $i++) {
        $tmpFilePath = $_FILES['uploadfile']['tmp_name'][$i];
        if ($tmpFilePath != "") {
          if ($this->formatbytes($_FILES['uploadfile']['size'][$i], 'MB') > MAX_UPLOAD_FILE_SIZE) {
            $this->SysMessage->set('Максимальный размер 1 файла ' . MAX_UPLOAD_FILE_SIZE . ' MB ' . '<a href="/user/files">Back to Files</a>');
            return false;
          }
          chmod(PATH . UPLOAD_FILES_DIR . "/", 0777);
          $hashed_name = _hash($_FILES['uploadfile']['name'][$i]);
          $newFilePath = PATH . UPLOAD_FILES_DIR . "/" . $hashed_name;
          if (move_uploaded_file($tmpFilePath, $newFilePath)) {

            //Handle other code here
            global $pdo;
            $stmt = $pdo->prepare('INSERT INTO files (user_id, filename, filemime, filesize, filepath) VALUES (?,?,?,?,?)');
            $stmt->execute([
                             $_SESSION['user_data']['user_id'],
                             $_FILES['uploadfile']['name'][$i],
                             $_FILES['uploadfile']['type'][$i],
                             $_FILES['uploadfile']['size'][$i],
                             $hashed_name
                           ]);
          }
        }
      }
      return true;
    }
    else {
      $this->SysMessage->set('Вы можете загрузить в хранилище максимум ' . MAX_FILES_PER_USER . ' файлов' . ' ' . '<a href="/user/files">Back to Files</a>');
      return false;
    }
  }

  public function formatbytes($size, $type) {
    $num = 0.0009765625;
    $size = (int) $size;
    switch ($type) {
      case "KB":
        $filesize = $size * $num; // bytes to KB
        break;

      case "MB":
        $filesize = $size * $num * $num; // bytes to MB
        break;
      case "GB":
        $filesize = $size * $num * $num * $num; // bytes to GB
        break;
    }
    if ($filesize <= 0) {
      return $filesize = 'unknown file size';
    }
    else {
      return round($filesize, 2) . ' ' . $type;
    }
  }

  public function remove($file_id) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE files SET filestatus=? WHERE id=? AND user_id=?');
    $stmt->execute(['disabled', $file_id, $_SESSION['user_data']['user_id']]);

    $stmt = $pdo->prepare('SELECT filepath FROM files WHERE id=? AND user_id=?');
    $stmt->execute([$file_id, $_SESSION['user_data']['user_id']]);
    $filepath = $stmt->fetchColumn();
    unlink(PATH . UPLOAD_FILES_DIR . '/' . $filepath);
  }

  public function initDownload($file_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT filepath, filename FROM files WHERE id=? AND user_id=?');
    $stmt->execute([$file_id, $_SESSION['user_data']['user_id']]);
    if ($filedata = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $this->file_force_download(PATH . UPLOAD_FILES_DIR . '/' . $filedata['filepath'], $filedata['filename']);
    }
  }

  public function file_force_download($file, $name) {
    if (file_exists($file)) {
      if (ob_get_level()) {
        ob_end_clean();
      }

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . $name);
      header('Content - Transfer - Encoding: binary');
      header('Expires: 0');
      header('Cache - Control: must - revalidate');
      header('Pragma: public');
      header('Content - Length: ' . filesize($file));
      readfile($file);
      exit;
    }
  }
}
