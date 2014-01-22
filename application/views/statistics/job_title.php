<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/statistics.css'; ?>">
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="statistics job-title">
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
    <h1>Job Title/Position<?= anchor('statistics/index', 'Back to List'); ?></h1>

    <div class="statistical-presentation clearfix">
      <h1>BS Computer Science</h1>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="table" data-label="Developer" data-frequency="10" data-percentage="10"></span>
        <span class="table" data-label="Designer" data-frequency="30" data-percentage="30"></span>
        <span class="table" data-label="CEO" data-frequency="40" data-percentage="40"></span>
        <span class="table" data-label="CTO" data-frequency="20" data-percentage="20"></span>
        <span class="table" data-label="<b>Total</b>" data-frequency="<b>100</b>" data-percentage="<b>100</b>"></span>
      </div>
    </div>
    <div class="statistical-presentation clearfix">
      <h1>BS Computer Science</h1>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="table" data-label="Developer" data-frequency="10" data-percentage="10"></span>
        <span class="table" data-label="Designer" data-frequency="30" data-percentage="30"></span>
        <span class="table" data-label="CEO" data-frequency="40" data-percentage="40"></span>
        <span class="table" data-label="CTO" data-frequency="20" data-percentage="20"></span>
        <span class="table" data-label="<b>Total</b>" data-frequency="<b>100</b>" data-percentage="<b>100</b>"></span>
      </div>
    </div>
    <div class="statistical-presentation clearfix">
      <h1>BS Computer Science</h1>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="table" data-label="Developer" data-frequency="10" data-percentage="10"></span>
        <span class="table" data-label="Designer" data-frequency="30" data-percentage="30"></span>
        <span class="table" data-label="CEO" data-frequency="40" data-percentage="40"></span>
        <span class="table" data-label="CTO" data-frequency="20" data-percentage="20"></span>
        <span class="table" data-label="<b>Total</b>" data-frequency="<b>100</b>" data-percentage="<b>100</b>"></span>
      </div>
    </div>
  </div>

  <script src="https://www.google.com/jsapi"></script>
  <script>
    var tableOptions = {
      width: 450,
      sort: 'disable',
      allowHtml: true
    };

    google.load('visualization', '1', { packages: ['corechart', 'table'] });
    google.setOnLoadCallback(function() {
      $('.statistical-presentation').each(function() {
        var presentation = $(this);
        var tableData = [['Job Title/Position', 'Frequency', 'Percentage']];
        presentation.find('.statistical-data span').each(function() {
          var data = {};
          data['label'] = $(this).data('label');
          data['frequency'] = $(this).data('frequency');
          data['percentage'] = $(this).data('percentage');

          if ($(this).hasClass('table')) {
            tableData.push([data['label'], data['frequency'], data['percentage']]);
          }
        });

        tableData = google.visualization.arrayToDataTable(tableData);
        var table = new google.visualization.Table(presentation.find('.statistical-table')[0]);
        table.draw(tableData, tableOptions);
      });
    });
  </script>
</body>
</html>