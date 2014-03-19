<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/statistics.css'; ?>">
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/statistics.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="statistics employment-gap">
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
    <header>
      <h1>Graduation to Employment Gap</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>
    <?php if ($programs != null) : ?>
      <?php foreach ($programs as $name=>$gap) : ?>
        <?php if ($total[$name] > 0) : ?>
          <div class="statistical-presentation clearfix">
            <h1><?=$name?></h1>
            <div class="statistical-chart"></div>
            <div class="statistical-table"></div>
            <div class="statistical-data hidden">
              <?php foreach ($gap as $g=>$value) : ?>
                <span class="chart table" data-label="<?=$g?> months" data-frequency="<?=$value?>" data-percentage="<?=(($value/$total[$name]) * 100)?>"></span>
              <?php endforeach; ?>
              <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$total[$name]?></b>" data-percentage="<b>100</b>"></span>
            </div>
          </div>
        <?php endif ?>
      <?php endforeach; ?>    
    <?php endif; ?>
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
        title: 'Graduation to Employment Gap'
      },
      vAxis: {
        title: 'Frequency'
      }
    };
    var tableOptions = {
      width: 450,
      height: 450,
      sort: 'disable',
      allowHtml: true
    };

    google.load('visualization', '1', { packages: ['corechart', 'table'] });
    google.setOnLoadCallback(function() {
      $('.statistical-presentation').each(function() {
        var presentation = $(this);
        var chartData = [['Graduation to Employment Gap', 'Frequency']];
        var tableData = [['Graduation to Employment Gap', 'Frequency', 'Percentage']];
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