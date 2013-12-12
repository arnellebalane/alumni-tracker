<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/pages.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <title>Alumni Tracker</title>
</head>

<body class="pages login">
  <?= form_open('#'); ?>
    <h1>Alumni Tracker</h1>
    <h2>Account Login</h2>
    <div class="field">
      <label>Username</label>
      <input type="text" name="username" autofocus="true" />
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" />
    </div>
    <div class="field actions">
      <input type="submit" value="Login" class="button" />
    </div>
  <?= form_close(); ?>
</body>
</html>