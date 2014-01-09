<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/admin.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <title>Alumni Tracker</title>
</head>

<body class="admin index">
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><a href="#" class="current">Questionnaire Data</a></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Manage Questionnaire Data</h1>
      <p>These data are the ones which will appear as choices in some parts of the questionnaire.</p>

      <section id="countries">
        <h1>Countries</h1>
        <?= form_open('admin/updateCountries'); ?>
          <?php foreach ($countries as $country) : ?>
            <label><input type="checkbox" name="countries[<?=$country->id?>]" /><?=$country->name?></label>
          <?php endforeach; ?>          
          <div class="padded hidden replacement-form">
            <h4>Replace Selected Countries</h4>
            <label class="inline">Country Name</label>
            <input type="text" name="country_name" />
            <input type="submit" value="Submit" class="button" />
          </div>
        <?= form_close(); ?>
        <?= form_open('admin/addCountry', array('class' => 'padded')); ?>
          <h4>Add Another Country</h4>
          <label class="inline">Country Name</label>
          <input type="text" name="country_name" />
          <input type="submit" value="Submit" class="button" />
        <?= form_close(); ?>
      </section>

      <section id="employer-type">
        <h1>Employer/Business Types</h1>
        <?= form_open('admin/updateEmployerTypes'); ?>
          <?php foreach ($employer_types as $type) : ?>
            <label><input type="checkbox" name="employer_types[<?=$type->id?>]" /><?=$type->name?></label>
          <?php endforeach; ?>                  
          <div class="padded hidden replacement-form">
            <h4>Replace Selected Employer/Business Types</h4>
            <label class="inline">Employer/Business Type</label>
            <input type="text" name="employer_type" />
            <input type="submit" value="Submit" class="button" />
          </div>
        <?= form_close(); ?>
        <?= form_open('admin/addEmployerType', array('class' => 'padded')); ?>
          <h4>Add Another Employer/Business Type</h4>
          <label class="inline">Employer/Business Type</label>
          <input type="text" name="employer_type" />
          <input type="submit" value="Submit" class="button" />
        <?= form_close(); ?>
      </section>

      <section id="degree-programs">
        <h1>Degree Programs</h1>
        <?php foreach ($programs as $prog) : ?>
          <h3>
            <span><?=$prog->name?></span>
            <?= form_open('/admin/updateDegreeProgram', array('class' => 'hidden')); ?>
              <input type="text" name="degree_program" value="<?= $prog->name; ?>" data-current="<?= $prog->name; ?>" />
              <input type="hidden" name="program_id" value="<?= $prog->id; ?>" />
              <input type="submit" value="Submit" class="button" />
            <?= form_close(); ?>
            <a href="#" data-behavior="edit">[edit]</a>
          </h3>
        <?php endforeach;?>        

        <?= form_open('admin/addDegreeProgram', array('class' => 'padded')); ?>
          <h4>Add Another Degree Program</h4>
          <label class="inline">Degree Program</label>
          <input type="text" name="degree_program" />
          <input type="submit" value="Submit" class="button" />
        <?= form_close(); ?>
      </section>
    </div>
  </div>
</body>
</html>