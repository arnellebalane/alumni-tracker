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
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('admin/index', 'Questionnaire Data', array('class' => 'current')); ?></li>
        <li><?= anchor('admin/alumni', 'Alumni Data'); ?></li>
        <li><?= anchor('admin/metas', 'Meta Data'); ?></li>
        <li><?= anchor('admin/settings', 'Account Settings'); ?></li>
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

      <section id="ge-courses">
        <h1>GE Courses</h1>
        <?php foreach ($ge_courses as $ge_course): ?>
          <h3>
            <p><?= $ge_course->code; ?></p>
            <p><?= $ge_course->name; ?></p>
            <p><i><?= $ge_course->description; ?></i></p>
            <?= form_open('admin/updateGECourse', array('class' => 'hidden')); ?>
              <input type="text" name="GE_code" value="<?= $ge_course->code; ?>" data-current="<?= $ge_course->code; ?>" />
              <input type="text" name="GE_name" value="<?= $ge_course->name; ?>" data-current="<?= $ge_course->name; ?>" />
              <input type="text" name="GE_description" value="<?= $ge_course->description; ?>" data-current="<?= $ge_course->description; ?>" />
              <input type="hidden" name="GE_id" value="<?= $ge_course->id; ?>" />
              <input type="submit" value="Submit" class="button" />
            <?= form_close(); ?>
            <div>
              <a href="#" data-behavior="edit">[edit]</a>
              <?=anchor('admin/deleteGECourse/'.$ge_course->id,'[delete]')?>
            </div>
          </h3>
        <?php endforeach; ?>

        <?= form_open('admin/addGECourse', array('class' => 'padded')); ?>
          <h4>Add Another GE Course</h4>
          <div class="field">
            <label class="inline">GE Course Code</label>
            <input type="text" name="GE_code" />
          </div>
          <div class="field">
            <label class="inline">GE Course Name</label>
            <input type="text" name="GE_name" />
          </div>
          <div class="field">
            <label class="inline">GE Course Description</label>
            <input type="text" name="GE_description" />
          </div>
          <input type="submit" value="Submit" class="button" />
        <?= form_close(); ?>
      </section>

      <section id="social-networks">
        <h1>Social Networks</h1>
        <?php foreach ($social_networks as $social_network): ?>
          <h3>
            <span><?= $social_network->name; ?></span>
            <?= form_open('admin/updateSocialNetwork', array('class' => 'hidden')); ?>
              <input type="text" name="social_network" value="<?= $social_network->name; ?>" data-current="<?= $social_network->name; ?>" />
              <input type="hidden" name="social_network_id" value="<?= $social_network->id; ?>" />
              <input type="submit" value="Submit" class="button" />
            <?= form_close(); ?>
            <a href="#" data-behavior="edit">[edit]</a>
            <?= anchor('admin/deleteSocialNetwork/'.$social_network->id, '[delete]'); ?>
          </h3>
        <?php endforeach; ?>

        <?= form_open('admin/addSocialNetwork', array('class' => 'padded')); ?>
          <h4>Add Another Social Network</h4>
          <label class="inline">Social Network</label>
          <input type="text" name="social_network" />
          <input type="submit" value="Submit" class="button" />
        <?= form_close(); ?>
      </section>
    </div>
  </div>
</body>
</html>