<div class="panel panel-default">
  <div class="panel-body">

    <form action="<?php print !empty($user_data) ? '/user/edit' : '/register' ?>" method="post">
      <?php print genCSRFProtection(); ?>

      <?php if (!empty($user_data['id'])): ?>
        <input type="hidden" name="user_id" value="<?php print $user_data['id'] ?>" />
      <?php endif; ?>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Enter username" id="username" value="<?php print (!empty($user_data['username'])) ? $user_data['username'] : ''; ?>" />

      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" />
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirm password" />
      </div>

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control required" name="name" placeholder="Enter real name" id="name" required="required" value="<?php print (!empty($user_data['name'])) ? $user_data['name'] : ''; ?>" />
      </div>

      <div class="form-group">
        <label for="secondname">Second name</label>
        <input type="text" class="form-control required" name="secondname" placeholder="Enter second name" id="secondname" required="required" value="<?php print (!empty($user_data['secondname'])) ? $user_data['secondname'] : ''; ?>" />
      </div>

      <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="text" class="form-control" name="email" placeholder="Enter email" id="email" value="<?php print (!empty($user_data['email'])) ? $user_data['email'] : ''; ?>" />
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="Enter phone" id="phone" value="<?php print (!empty($user_data['phone'])) ? $user_data['phone'] : ''; ?>" />
      </div>

      <div class="form-group">
        <label for="phone">Birthday</label>

        <select name="birthday-day" class="form-control">
          <?php for ($i = 1; $i < 31; $i++): ?>
            <option value="<?php print $i; ?>" <?php print (!empty($user_data) && $user_data['birthday']['day'] == $i) ? 'selected' : ''; ?>><?php print $i; ?></option>
          <?php endfor; ?>
        </select>

        <select name="birthday-month" class="form-control">
          <?php foreach ($month_list as $index => $month): ?>
            <option value="<?php print $index; ?>" <?php print (!empty($user_data) && $user_data['birthday']['month'] == $index) ? 'selected' : ''; ?>><?php print $month; ?></option>
          <?php endforeach; ?>
        </select>

        <select name="birthday-year" class="form-control">
          <?php for ($i = (intval(date('Y', time())) - 100); $i < (intval(date('Y', time())) - 10); $i++): ?>
            <option value="<?php print $i; ?>" <?php print (!empty($user_data) && $user_data['birthday']['year'] == $i) ? 'selected' : ''; ?>><?php print $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-default"><?php print !empty($user_data) ? 'Update' : 'Sign In'; ?></button>

      <?php if (empty($user_data)): ?>
        <a class="btn btn-link" href="/login">Login</a>
      <?php endif; ?>
    </form>


  </div>
</div>
