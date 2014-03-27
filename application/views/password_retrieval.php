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
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="pages retrieve_password">
  <?= form_open('session/retrieveAccount', 'POST'); ?>
    <a href="<?= base_url(); ?>" id="site-logo">Alumni Tracker</a>
    <p>Please enter your email address below and we will email you your login credentials.</p>
    <? if ($this->session->flashdata('alert')): ?>
      <p class="error"><?= $this->session->flashdata('alert'); ?></p>
    <? endif; ?>
    <? if ($this->session->flashdata('notice')): ?>
      <p class="success"><?= $this->session->flashdata('notice'); ?></p>
    <? endif; ?>
    <div class="field">
      <label>Email</label>
      <input type="email" name="email" autofocus="true" />
    </div>
    <div class="field actions">
      <a href="<?= site_url('session/index'); ?>">Sign In to your account</a>
      <input type="submit" value="Submit" class="button" />
    </div>
  <?= form_close(); ?>
</body>
</html>