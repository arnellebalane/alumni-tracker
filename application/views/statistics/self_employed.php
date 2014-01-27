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

<body class="statistics self-employed">
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
        <h1>Self Employed</h1>
        <?= anchor('statistics/index', 'Back to List'); ?>
        <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
        <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
          <input type="hidden" name="html" />
        <?= form_close(); ?>
      </header>    
      <?php if ($employment) : ?>
        <div class="statistical-presentation clearfix">
          <h1>Current Job</h1>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <?php $totalCurrent = $employment[0]->yesCurrent + $employment[0]->noCurrent; ?>
            <span class="table" data-label="Yes" data-frequency="<?=$employment[0]->yesCurrent?>" data-percentage="<?=($employment[0]->yesCurrent / $totalCurrent) * 100?>"></span>
            <span class="table" data-label="No" data-frequency="<?=$employment[0]->noCurrent?>" data-percentage="<?=($employment[0]->noCurrent / $totalCurrent) * 100?>"></span>
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$totalCurrent?></b>" data-percentage="<b>100</b>"></span>
          </div>        
        </div>  
        <div class="statistical-presentation clearfix">
          <h1>First Job</h1>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <?php $totalFirst = $employment[0]->yesFirst + $employment[0]->noFirst; ?>
            <span class="table" data-label="Yes" data-frequency="<?=$employment[0]->yesFirst?>" data-percentage="<?=($employment[0]->yesFirst / $totalFirst) * 100 ?>"></span>
            <span class="table" data-label="No" data-frequency="<?=$employment[0]->noFirst?>" data-percentage="<?=($employment[0]->noFirst / $totalFirst) * 100 ?>"></span>
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$totalFirst?></b>" data-percentage="<b>100</b>"></span>
          </div>        
        </div>  
      <? endif; ?>
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
        var tableData = [['Self Employed', 'Frequency', 'Percentage']];
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