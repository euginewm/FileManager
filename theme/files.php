<?php
$File = \classes\DependenciesContainer::init('File');
?>
<div class="panel panel-default">
  <div class="panel-body">

    <form action="/user/files/add" method="post" enctype="multipart/form-data">
      <?php print genCSRFProtection(); ?>
      <div class="form-group">
        <label for="uploadfile">Upload Files</label>
        <input type="file" class="form-control required" name="uploadfile[]" id="uploadfile" required="required" multiple="multiple" />
      </div>

      <button type="submit" class="btn btn-default">Upload</button>

    </form>

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <table class="table table-bordered">
      <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Download</th>
      <th>Mime type</th>
      <th>Size</th>
      <th>Status</th>
      <th>Options</th>
      </thead>
      <tbody class="table-striped">
      <?php foreach ($userfiles as $fileData): ?>
        <tr>
          <td><?php print $fileData['id']; ?></td>
          <td><?php print $fileData['filename']; ?></td>
          <td>
            <?php if ($fileData['filestatus'] == 'active'): ?>
              <a href="/user/file/download/<?php print $fileData['id']; ?>">Download</a>
            <?php endif; ?>
          </td>
          <td><?php print $fileData['filemime']; ?></td>
          <td><?php print $File->formatbytes($fileData['filesize'], 'MB'); ?></td>
          <td><?php print $fileData['filestatus']; ?></td>
          <td>
            <?php if ($fileData['filestatus'] == 'active'): ?>
              <a href="/user/file/remove/<?php print $fileData['id']; ?>">Remove</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>
