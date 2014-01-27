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
    <header>
      <h1>Honor Received</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>

    <div class="statistical-presentation clearfix">
      <div class="statistical-chart"></div>
      <div class="statistical-table"></div>
      <div class="statistical-data hidden">
        <span class="chart table" data-label="Summa Cum Laude" data-frequency="<?=$honors[0]->suma?>" data-percentage="<?=($total > 0)? ($honors[0]->suma / $total) * 100 : 0?>"></span>        
        <span class="chart table" data-label="Magna Cum Laude" data-frequency="<?=$honors[0]->magna?>" data-percentage="<?=($total > 0)? ($honors[0]->magna / $total) * 100 : 0?>"></span>
        <span class="chart table" data-label="Cum Laude" data-frequency="<?=$honors[0]->cum?>" data-percentage="<?=($total > 0)? ($honors[0]->cum / $total) * 100 : 0?>"></span>
        <!-- <span class="chart table" data-label="No Honors" data-frequency="<?=$honors[0]->none?>" data-percentage="<?=($total > 0)? ($honors[0]->none / $total) * 100 : 0?>"></span> -->
        <?php $per = ($total > 0) ? (($honors[0]->suma + $honors[0]->magna + $honors[0]->cur) / $total) * 100 : 0; ?>
        <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$honors[0]->suma + $honors[0]->magna + $honors[0]->cum?></b>" data-percentage="<b><?=$per?></b>" ></span>
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
        title: 'Honor Received'
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
        var chartData = [['Honor Received', 'Frequency']];
        var tableData = [['Honor Received', 'Frequency', 'Percentage']];
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