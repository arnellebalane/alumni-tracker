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

<body class="statistics gender">
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
    <h1>Gender Data<?= anchor('statistics/index', 'Back to List'); ?></h1>

    <section class="statistical-presentation clearfix">
      <div class="statistical-chart"></div>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="chart table" data-label="male" data-frequency="30" data-percentage="30"></span>
        <span class="chart table" data-label="female" data-frequency="70" data-percentage="70"></span>
        <span class="table" data-label="total" data-frequency="100" data-percentage="100"></span>
      </div>
    </section>
  </div>

  <script>
    $('.statistical-presentation').each(function() {
      var presentation = $(this);
      var chart = [];
      presentation.find('.statistical-data .chart').each(function() {
        var data = {};
        data['label'] = $(this).data('label');
        data['frequency'] = $(this).data('frequency');
        data['percentage'] = $(this).data('percentage');
        chart.push(data);
      });
      console.log(chart);
    });
  </script>
</body>
</html>