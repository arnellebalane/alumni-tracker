<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/admin.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="admin alumni">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('admin/index', 'Questionnaire Data'); ?></li>
        <li><?= anchor('admin/alumni', 'Alumni Data', array('class' => 'current')); ?></li>
        <li><?= anchor('admin/enumerators', 'Enumerator Accounts'); ?></li>
        <li><?= anchor('admin/metas', 'Meta Data'); ?></li>
        <li><?= anchor('statistics/index', 'Statistical Presentations'); ?></li>
        <li><?= anchor('admin/settings', 'Account Settings'); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Search Results</h1>
      <p>Search query: [insert query here]</p>

      <?= form_open('#', array('class' => 'search solo', 'method' => 'GET')); ?>
        <input type="text" name="query" placeholder="Search an alumni" value="[insert query here]" />
        <input type="submit" value="search" />
      <?= form_close(); ?>

      <ul class="list">
        <li>
          <a href="<?= site_url('admin/clean/1'); ?>" class="cleaned">Arnelle Balane</a>
          <div class="actions">
            <a href="<?= site_url('admin/deleteAlumni/1'); ?>">Discard</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</body>
</html>