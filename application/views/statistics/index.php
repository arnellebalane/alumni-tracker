<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/statistics.css'; ?>">
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>.js"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="statistics index">
  <header id="main-header">
    <div class="wrapper">
      <h1>Alumni Tracker<span>Statistical Presentations</span></h1>
      <nav>
        <?= anchor('admin/index', 'Account'); ?>
        <?= anchor('session/logout', 'Sign Out'); ?>
      </nav>
    </div>
  </header>

  <div class="content wrapper">
    <h1>For which statistical presentation would you like to view?</h1>

    <ul>
      <li><?= anchor('statistics/gender', 'Gender'); ?></li>
      <li><?= anchor('statistics/country', 'Country/State of Present Address'); ?></li>
      <li><?= anchor('statistics/employer_type', 'Employer/Business Type'); ?></li>
      <li><?= anchor('statistics/salary', 'Monthly Salary'); ?></li>
      <li><?= anchor('statistics/job_title', 'Job Title/Position'); ?></li>
      <li><?= anchor('statistics/degree_program', 'Degree Program'); ?></li>
      <li><?= anchor('statistics/honor_received', 'Honor Received'); ?></li>
      <li><?= anchor('statistics/self_employed', 'Self-employed'); ?></li>
    </ul>
  </div>
</body>
</html>