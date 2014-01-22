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
    <h1>Country/State of Present Address<?= anchor('statistics/index', 'Back to List'); ?></h1>

    <section class="statistical-presentation clearfix">
      <div class="statistical-chart"></div>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="chart table" data-label="Philippines" data-males="25" data-females="25" data-frequency="50" data-percentage="50"></span>
        <span class="chart table" data-label="Japan" data-males="10" data-females="15" data-frequency="25" data-percentage="25"></span>
        <span class="chart table" data-label="North Korea" data-males="5" data-females="10" data-frequency="15" data-percentage="15"></span>
        <span class="chart table" data-label="Singapore" data-males="5" data-females="5" data-frequency="10" data-percentage="10"></span>
        <span class="table" data-label="<b>Total</b>" data-males="<b>45</b>" data-females="<b>55</b>" data-frequency="<b>100</b>" data-percentage="<b>100</b>"></span>
      </div>
    </section>
  </div>

  <script src="https://www.google.com/jsapi"></script>
  <script>
    var chartOptions = {
      enableInteractivity: false,
      chartArea: {
        width: 450,
        height: 450
      },
      legend: {
        position: 'right'
      },
      tooltip: {
        trigger: 'none'
      },
      width: 450
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
        var chartData = [['Country', 'Percentage']];
        var tableData = [['Country', 'Males', 'Females', 'Frequency', 'Percentage']];
        presentation.find('.statistical-data span').each(function() {
          var data = {};
          data['label'] = $(this).data('label');
          data['males'] = $(this).data('males');
          data['females'] = $(this).data('females');
          data['frequency'] = $(this).data('frequency');
          data['percentage'] = $(this).data('percentage');

          if ($(this).hasClass('chart')) {
            chartData.push([data['label'], data['percentage']]);
          }
          if ($(this).hasClass('table')) {
            tableData.push([data['label'], data['males'], data['females'], data['frequency'], data['percentage']]);
          }
        });

        chartData = google.visualization.arrayToDataTable(chartData);
        var chart = new google.visualization.PieChart(presentation.find('.statistical-chart')[0]);
        chart.draw(chartData, chartOptions);

        tableData = google.visualization.arrayToDataTable(tableData);
        var table = new google.visualization.Table(presentation.find('.statistical-table')[0]);
        table.draw(tableData, tableOptions);
      });
    });
  </script>
</body>
</html>