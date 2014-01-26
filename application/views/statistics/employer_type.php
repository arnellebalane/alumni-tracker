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

<body class="statistics employer-type">
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
      <h1>Employer/Business Type</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>
    <?php foreach ($programs as $name=>$stat) : ?>
      <div class="statistical-presentation clearfix">
        <h1><?=$name?> - Current Job</h1>      
        <div class="statistical-chart"></div>      
        <div class="statistical-table"></div>
        <div class="statistical-data hidden">
          <?php foreach($stat as $type) : ?>
            <? if ($type->curJobCount > 0) { ?>
              <span class="chart table" data-label="<?=$type->name?>" data-frequency="<?=$type->curJobCount?>" data-percentage="<?=($total[$name]['current'] > 0) ? ($type->curJobCount / $total[$name]['current']) * 100 : 0?>"></span>
            <? } ?>
          <?php endforeach; ?>        
          <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$total[$name]['current']?></b>" data-percentage="<b>100</b>"></span>
        </div>      
      </div>
      <div class="statistical-presentation clearfix">
        <h1><?=$name?> - First Job</h1>              
        <div class="statistical-chart"></div>        
        <div class="statistical-table"></div>
        <div class="statistical-data hidden">
          <?php foreach($stat as $type) : ?>      
            <? if ($type->firstJobCount > 0) { ?>    
              <span class="chart table" data-label="<?=$type->name?>" data-frequency="<?=$type->firstJobCount?>" data-percentage="<?=($total[$name]['first'] > 0) ? ($type->firstJobCount / $total[$name]['first']) * 100 : 0?>"></span>
            <? } ?>
          <?php endforeach; ?>        
          <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$total[$name]['first']?></b>" data-percentage="<b>100</b>"></span>
        </div>      
      </div>
    <?php endforeach; ?>    
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
        title: 'Employer/Business Type'
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
        var chartData = [['Employer/Business Type', 'Frequency']];
        var tableData = [['Employer/Business Type', 'Frequency', 'Percentage']];
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