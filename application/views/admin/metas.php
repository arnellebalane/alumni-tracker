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
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="admin metas">
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
        <li><?= anchor('admin/alumni', 'Alumni Data'); ?></li>
        <li><?= anchor('admin/enumerators', 'Enumerator Accounts'); ?></li>
        <li><?= anchor('admin/metas', 'Meta Data', array('class' => 'current')); ?></li>
        <li><?= anchor('statistics/index', 'Statistical Presentations'); ?></li>
        <li><?= anchor('admin/settings', 'Account Settings'); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Manage Meta Data</h1>
      <p>These are data that affects the system-wide behaviors of the application.</p>

      <div class="metas-actions">
        <?= anchor('#', 'Enable Submissions'); ?>
        <?= anchor('#', 'Enable Data Cleaning'); ?>
      </div>

      <?= form_open('#'); ?>
        <section id="submission-period">
          <h1>Submission Period</h1>
          <div class="field">
            <label>Start Date</label>
            <input type="date" name="submission_period[start]" />
          </div>
          <div class="field">
            <label>End Date</label>
            <input type="date" name="submission_period[end" />
          </div>
        </section>

        <section id="cleaning-period">
          <h1>Cleaning Period</h1>
          <div class="field">
            <label>Start Date</label>
            <input type="date" name="cleaning_period[start]" />
          </div>
          <div class="field">
            <label>End Date</label>
            <input type="date" name="cleaning_period[end]" />
          </div>
        </section>

        <input type="submit" value="Save Changes" class="button" />
      <?= form_close(); ?>
    </div>
  </div>
</body>
</html>