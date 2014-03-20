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
      <h1>Search Results</h1>
      <p>Search Query: [insert query here]</p>

      <?= form_open('enumerator/search', array('class' => 'search solo', 'method' => 'GET')); ?>
        <input type="text" name="query" placeholder="Search an alumni" value="<?=$key?>" />
        <input type="submit" value="search" />
      <?= form_close(); ?>

      <ul class="list">
        <?php if ($result) { ?>
          <?php foreach ($result as $alumnus): ?>
            <li>
              <?= anchor('enumerator/clean/'.$alumnus->id.'/1', humanize($alumnus->firstname) . " " . humanize($alumnus->lastname), array('class' => ($alumnus->cleaned == 1) ? "cleaned" : "")); ?>
              <div class="actions">
                <?= anchor('enumerator/deleteAlumni/'.$alumnus->id.'/1', 'Discard'); ?>
              </div>
            </li>
          <?php endforeach; ?>
        <?php } else { ?>
          <li><p>No results found!</p><li>
        <?php } ?>
      </ul>
    </div>
  </div>
</body>
</html>