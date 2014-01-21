<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/statistics.css'; ?>">
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <title>Alumni Tracker</title>
</head>

<body class="statistics index">
  <header>
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
      <li><?= anchor('#', 'Gender'); ?></li>
      <li><?= anchor('#', 'Country/State of Present Address'); ?></li>
      <li><?= anchor('#', 'Employer/Business Type'); ?></li>
      <li><?= anchor('#', 'Monthly Salary'); ?></li>
      <li><?= anchor('#', 'Job Title/Position'); ?></li>
      <li><?= anchor('#', 'Degree Program'); ?></li>
      <li><?= anchor('#', 'Honor Received'); ?></li>
      <li><?= anchor('#', 'Self-employed'); ?></li>
    </ul>
  </div>
</body>
</html>