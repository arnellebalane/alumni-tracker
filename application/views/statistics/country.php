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

<body class="statistics country">
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
      <h1>Country/State of Present Address</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>

    <section class="statistical-presentation clearfix">
      <?php if ($total > 0) : ?>
        <div class="statistical-chart"></div>
        <div class="statistical-table"></div>
        <div class="statistical-data hidden">        
          <?php foreach ($countries as $country) : ?>
            <span class="chart table" data-label="<?=$country->name?>" data-males="<?=$country->males?>" data-females="<?=$country->females?>" data-frequency="<?=$country->count?>" data-percentage="<?=($country->count/$total)*100?>"></span>
          <?php endforeach; ?>        
          <span class="table" data-label="<b>Total</b>" data-males="<b><?=$males?></b>" data-females="<b><?=$females?></b>" data-frequency="<b><?=$total?></b>" data-percentage="<b>100</b>"></span>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <script src="https://www.google.com/jsapi"></script>
  <script>
    var chartOptions = {
      chartArea: {
        width: 400,
        height: '90%'
      },
      legend: {
        position: 'right'
      },
      height: 300,
      width: 450
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