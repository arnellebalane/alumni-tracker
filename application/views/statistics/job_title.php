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
    <header>
      <h1>Job Title/Position</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>

    <?php foreach ($programs as $name=>$titles) : ?>
      <?php if ($titles['current_total'] > 0) : ?>
        <div class="statistical-presentation clearfix">
          <h1><?=$name . " - Current Job"?></h1>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <?php foreach ($titles['current_job'] as $title) : ?>
              <span class="table" data-label="<?=$title->job_title?>" data-frequency="<?=$title->count?>" data-percentage="<?=($title->count/$titles['current_total']) * 100?>"></span>
            <?php endforeach; ?>            
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$titles['current_total']?></b>" data-percentage="<b>100</b>"></span>
          </div>
        </div>
      <?php endif;?>
      <?php if ($titles['first_total'] > 0) : ?>
        <div class="statistical-presentation clearfix">
          <h1><?=$name . " - First Job"?></h1>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <?php foreach ($titles['first_job'] as $title) : ?>
              <span class="table" data-label="<?=$title->job_title?>" data-frequency="<?=$title->count?>" data-percentage="<?=($title->count/$titles['first_total']) * 100?>"></span>
            <?php endforeach; ?>            
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?=$titles['first_total']?></b>" data-percentage="<b>100</b>"></span>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>    
  </div>

  <script src="https://www.google.com/jsapi"></script>
  <script>
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