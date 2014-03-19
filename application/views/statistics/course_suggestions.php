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
      <h1>Course Suggestions</h1>
      <?= anchor('statistics/index', 'Back to List'); ?>
      <input type="button" value="Generate PDF" data-behavior="generate-pdf" />
      <?= form_open('statistics/generate_pdf', array('class' => 'hidden')); ?>
        <input type="hidden" name="html" />
      <?= form_close(); ?>
    </header>

    <?php foreach ($total as $name => $count) : ?>
      <?php if ($count != 0) : ?>
        <div class="statistical-presentation clearfix">
          <h1><?= $name ?></h1>
          <div class="statistical-table"></div>
          <div class="statistical-data hidden">
            <?php foreach ($programs[$name] as $topic => $n) : ?>
              <span class="table" data-label="<?= $topic ?>" data-frequency="<?= $n ?>" data-percentage="<?= ($n / $count * 100) ?>"></span>
            <?php endforeach; ?>
            <span class="table" data-label="<b>Total</b>" data-frequency="<b><?= $count ?></b>" data-percentage="<b>100</b>"></span>
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
        var tableData = [['Suggested Topic', 'Frequency', 'Percentage']];
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