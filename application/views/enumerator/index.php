<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/enumerator.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <title>Alumni Tracker</title>
</head>

<body class="enumerator index">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('admin/index', 'Alumni Data', array('class' => 'current')); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Alumni Data</h1>
      <p>This shows the data submitted by the alumni from your assigned departments.</p>

      <?= form_open('#', array('class' => 'filter', 'method' => 'GET')); ?>
        <select name="included">
          <option>All Entries</option>
          <option value="1">Included in Analysis</option>
          <option value="0">Excluded from Analysis</option>
        </select>
        <select name="cleaned">
          <option>All Entries</option>
          <option value="1">Cleaned Entries</option>
          <option value="0">Uncleaned Entries</option>
        </select>
        <select name="program_id">        
          <option value="0">All Programs Assigned</option>
          <option value="1">Course 1</option>
          <option value="2">Course 2</option>
          <option value="3">Course 3</option>
        </select>
        <input type="submit" value="filter" />
      <?= form_close(); ?>

      <ul class="list">
        <?php for ($i = 0; $i < 50; $i++): ?>
          <li>
            <?= anchor('enumerator/clean', 'Arnelle Balane'); ?>
            <div class="actions">
              <?= anchor('#', 'Discard'); ?>
            </div>
          </li>
        <?php endfor; ?>
      </ul>
    </div>
  </div>
</body>
</html>