<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/admin.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
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
      </ul>
    </aside>

    <div class="content">
      <h1>Alumni Data</h1>
      <p>This is a listing of all the data submitted by the alumni through the questionnaire.</p>

      <?= form_open('admin/alumni', array('class' => 'filter', 'method' => 'GET')); ?>
        <select name="cleaned">
          <option>All Entries</option>
          <option>Cleaned Entries</option>
          <option>Uncleaned Entries</option>
        </select>
        <select name="program_id">
          <option value="1">BS Computer Science</option>
          <option value="1">BS Mathematics</option>
          <option value="1">BS Biology</option>
        </select>
        <input type="submit" value="filter" />
      <?= form_close(); ?>

      <ul class="list">
        <?php foreach ($alumni as $alumnus): ?>
          <li>
            <?= anchor('admin/clean/'.$alumnus->id, $alumnus->firstname . " " . $alumnus->lastname, array('class' => ($alumnus->cleaned == 1) ? "cleaned" : "")); ?>
            <div class="actions">
              <?= anchor('admin/deleteAlumni/'.$alumnus->id, 'Discard'); ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</body>
</html>