<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/enumerator.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="enumerator settings">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('enumerator/index', 'Alumni Data'); ?></li>
        <?php if ($view_stat == 1) { ?>
          <li><?= anchor('statistics/index', 'Statistical Presentations'); ?></li>
        <?php } ?>
        <li><?= anchor('enumerator/settings', 'Account Settings', array('class' => 'current')); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Account Settings</h1>
      <p>Edit the information used to login to your account.</p>

      <?= form_open('enumerator/updateAccount'); ?>
        <div class="field">
          <label>Username</label>
          <input type="text" name="username" />
        </div>
        <div class="field">
          <label>Current Password</label>
          <input type="password" name="current_password" />
        </div>
        <div class="field">
          <label>New Password</label>
          <input type="password" name="new_password" />
        </div>
        <div class="field">
          <label>Confirm New Password</label>
          <input type="password" name="confirm_new_password" />
        </div>
        <div class="field actions">
          <input type="submit" value="Update Password" class="button" />
        </div>
      <?= form_close(); ?>
    </div>
  </div>
</body>
</html>