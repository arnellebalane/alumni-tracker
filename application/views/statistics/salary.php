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

<body class="statistics salary">
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
      <h1>Monthly Salary</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>    
    <?php foreach($programs as $name=>$salaries) : ?>
    <?php if ($total[$name]['current']) : ?> 
      <div class="statistical-presentation clearfix">
          <h1><?=$name?> - Current Job</h1>        
          <div class="statistical-chart"></div>        
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <? foreach($salaries as $salary) : ?>           
              <?php $sal = "";
              if ($salary->minimum == null && $salary->maximum != null) {
                $sal = $salary->maximum . " and below";
              } else if ($salary->minimum != null && $salary->maximum == null) {
                $sal = $salary->minimum . " and above";
              } else {
                $sal = $salary->minimum . " - " . $salary->maximum;
              } ?>
              <? if ($salary->curJobCount > 0) { ?>
                <span class="chart table" data-label="<?=$sal?>" data-frequency="<?=$salary->curJobCount?>" data-percentage="<?=($total[$name]['current'] > 0) ? ($salary->curJobCount/$total[$name]['current']) * 100 : 0?>"></span>
              <?php } ?>
            <? endforeach; ?>          
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$total[$name]['current']?></b>" data-percentage="<b><?=($total[$name]['current'] > 0) ? 100 : 0 ?></b>"></span>
          </div>
        </div>
      <?php endif; ?>
      <?php if ($total[$name]['first']) : ?>
        <div class="statistical-presentation clearfix">
          <h1><?=$name?> - First Job</h1>
          <div class="statistical-chart"></div>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <? foreach($salaries as $salary) : ?> 
              <?php $sal = "";
              if ($salary->minimum == null && $salary->maximum != null) {
                $sal = $salary->maximum . " and below";
              } else if ($salary->minimum != null && $salary->maximum == null) {
                $sal = $salary->minimum . " and above";
              } else {
                $sal = $salary->minimum . " - " . $salary->maximum;
              } ?>
              <? if ($salary->firstJobCount > 0) { ?>
                <span class="chart table" data-label="<?=$sal?>" data-frequency="<?=$salary->firstJobCount?>" data-percentage="<?=($total[$name]['first'] > 0) ? ($salary->firstJobCount/$total[$name]['first']) * 100 : 0?>"></span>
              <?php } ?>
            <? endforeach; ?>          
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$total[$name]['first']?></b>" data-percentage="<b><?=($total[$name]['first'] > 0) ? 100 : 0 ?></b>"></span>
          </div>
        </div>
      <? endif; ?>
    <? endforeach; ?>    
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
        var chartData = [['Monthly Salary', 'Frequency']];
        var tableData = [['Monthly Salary', 'Frequency', 'Percentage']];
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