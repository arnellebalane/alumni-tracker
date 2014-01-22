<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/statistics.css'; ?>">
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="statistics honor-received">
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
    <h1>Honor Received<?= anchor('statistics/index', 'Back to List'); ?></h1>

    <div class="statistical-presentation clearfix">
      <div class="statistical-chart"></div>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="chart table" data-label="Summa Cum Laude" data-frequency="25" data-percentage="25"></span>
        <span class="chart table" data-label="Magna Cum Laude" data-frequency="25" data-percentage="25"></span>
        <span class="chart table" data-label="Cum Laude" data-frequency="50" data-percentage="50"></span>
        <span class="table" data-label="<b>Total</b>" data-frequency="<b>100</b>" data-percentage="<b>100</b>"></span>
      </div>
    </div>
  </div>

  <script src="https://www.google.com/jsapi"></script>
  <script>
    var chartOptions = {
      chartArea: {
        width: 300,
        height: '80%'
      },
      legend: {
        position: 'none'
      },
      height: 300,
      width: 450,
      hAxis: {
        title: 'Monthly Salary'
      },
      vAxis: {
        title: 'Frequency'
      }
    };
    var tableOptions = {
      width: 450,
      sort: 'disable',
      allowHtml: true
    };

    google.load('visualization', '1', { packages: ['corechart', 'table'] });
    google.setOnLoadCallback(function() {
      $('.statistical-presentation').each(function() {
        var presentation = $(this);
        var chartData = [['Degree Program', 'Frequency']];
        var tableData = [['Degree Program', 'Frequency', 'Percentage']];
        presentation.find('.statistical-data span').each(function() {
          var data = {};
          data['label'] = $(this).data('label');
          data['frequency'] = $(this).data('frequency');
          data['percentage'] = $(this).data('percentage');

          if ($(this).hasClass('chart')) {
            chartData.push([data['label'], data['frequency']]);
          }
          if ($(this).hasClass('table')) {
            tableData.push([data['label'], data['frequency'], data['percentage']]);
          }
        });

        chartData = google.visualization.arrayToDataTable(chartData);
        var chart = new google.visualization.ColumnChart(presentation.find('.statistical-chart')[0]);
        chart.draw(chartData, chartOptions);

        tableData = google.visualization.arrayToDataTable(tableData);
        var table = new google.visualization.Table(presentation.find('.statistical-table')[0]);
        table.draw(tableData, tableOptions);
      });
    });
  </script>
</body>
</html>