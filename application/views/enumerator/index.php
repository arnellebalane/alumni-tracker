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
        <li><?= anchor('enumerator/index', 'Alumni Data', array('class' => 'current')); ?></li>
        <?php if ($view_stat == 1) { ?>
          <li><?= anchor('statistics/index', 'Statistical Presentations'); ?></li>        
        <?php } ?>
        <li><?= anchor('enumerator/settings', 'Account Settings'); ?></li>        
      </ul>
    </aside>

    <div class="content">
      <h1>Alumni Data</h1>
      <p>This is a listing of all the data submitted by the alumni through the questionnaire.</p>

      <?= form_open('#', array('class' => 'search', 'method' => 'GET')); ?>
        <input type="text" name="query" placeholder="Search an alumni" />
        <input type="submit" value="search" />
      <?= form_close(); ?>
      <?= form_open('enumerator/index', array('class' => 'filter', 'method' => 'GET')); ?>
        <select name="included">
          <option disabled selected>--filter by time submitted--</option>
          <option value="-1" <?=is_selected(-1, $included)?>>All Entries</option>
          <option value="1" <?=is_selected(1, $included)?>>Included in Analysis</option>
          <option value="0" <?=is_selected(0, $included)?>>Excluded from Analysis</option>
        </select>
        <select name="cleaned">
          <option disabled selected>--filter by cleanliness--</option>
          <option value="-1" <?=is_selected(-1, $cleaned)?>>All Entries</option>
          <option value="1" <?=is_selected(1, $cleaned)?>>Cleaned Entries</option>
          <option value="0" <?=is_selected(0, $cleaned)?>>Uncleaned Entries</option>
        </select>
        <select name="program_id">
          <option disabled selected>--filter by degree program--</option>
          <option value="-1" <?=is_selected(-1, $program_id)?>>All Programs</option>
          <? foreach ($programs as $program) : ?>
            <option value="<?=$program->id?>" <?=is_selected($program->id, $program_id)?>><?=$program->name?></option>
          <? endforeach; ?>  
        </select>
        <input type="submit" value="filter" />
      <?= form_close(); ?>

      <ul class="list">
        <?php foreach ($alumni as $alumnus): ?>
          <li>
            <?= anchor('enumerator/clean/'.$alumnus->id.'/'.$page, $alumnus->firstname . " " . $alumnus->lastname, array('class' => ($alumnus->cleaned == 1) ? "cleaned" : "")); ?>
            <div class="actions">
              <?= anchor('enumerator/deleteAlumni/'.$alumnus->id.'/'.$page, 'Discard'); ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?= $paginator->paginate(); ?>
    </div>
  </div>
</body>
</html>