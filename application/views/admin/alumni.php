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
        <li><?= anchor('admin/metas', 'Meta Data'); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Alumni Data</h1>
      <p>This is a listing of all the data submitted by the alumni through the questionnaire.</p>

      <?= form_open('admin/alumni', array('class' => 'filter', 'method' => 'GET')); ?>
        <select name="included">
          <option>All Entries</option>
          <option value="1">Included in Analysis</option>
          <option value="0">Excluded from Analysis</option>
        </select>
        <select name="cleaned">
          <option>All Entries</option>
          <option value="1" <?=is_selected(1, $cleaned)?>>Cleaned Entries</option>
          <option value="0" <?=is_selected(0, $cleaned)?>>Uncleaned Entries</option>
        </select>
        <select name="program_id">        
          <option value="0">All Programs</option>
          <? foreach ($programs as $program) : ?>
            <option value="<?=$program->id?>" <?=is_selected($program->id, $program_id)?>><?=$program->name?></option>
          <? endforeach; ?>  
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