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

<body class="admin enumerators">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('admin/index', 'Questionnaire Data'); ?></li>
        <li><?= anchor('admin/alumni', 'Alumni Data'); ?></li>
        <li><?= anchor('admin/enumerators', 'Enumerator Accounts', array('class' => 'current')); ?></li>
        <li><?= anchor('admin/metas', 'Meta Data'); ?></li>
        <li><?= anchor('admin/settings', 'Account Settings'); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Enumerator Accounts</h1>
      <p>Manage enumerator accounts and the data that they can access.</p>

      <? foreach ($enumerators as $enumerator) : ?>
      <?= form_open('admin/updateEnumerator/'.$enumerator->id, array('class' => 'enumerator')); ?>      
        <h4><?=humanize($enumerator->firstname)?><span>(<?=$enumerator->email?>)</span></h4>
        <div class="privileges">
          <? $enumerator_programs = getPrograms($enumerator->id); ?>
          <? $enumerator_stat = getStatistics($enumerator->id); ?>
          <ul>
            <? foreach ($enumerator_programs as $prog) : ?>
              <li><?=$prog->name?></li>
            <? endforeach; ?>
          </ul>
          <? if ($enumerator_stat && ($enumerator_stat[0]->statistics == 1)) : ?>
            <h5 class="green">can view statistical analysis</h5>
          <? endif; ?>
        </div>
        <div class="editable hidden">
          <?php foreach ($programs as $program) : ?>
            <? $checked = isEnumeratorProgram($program->id, $enumerator_programs); ?>
            <label><input type="checkbox" name="degree_program[<?=$program->id?>]" data-current="<?=($checked=="checked") ? 'true' : 'false'?>" <?=$checked?> /><?=$program->name?></label>
          <? endforeach; ?>                
          <label class="analysis-access"><input type="checkbox" name="analysis_access" data-current="<?=($enumerator_stat && ($enumerator_stat[0]->statistics == 1)) ? 'true' : 'false'?>"  <?=($enumerator_stat && ($enumerator_stat[0]->statistics == 1)) ? 'checked' : 'unchecked';?>/>Can access statistical analysis tools?</label>
        </div>
        <div class="actions">
          <input type="submit" value="Save Changes" class="button hidden" />
          <input type="button" value="Edit Account" class="button" data-behavior="edit" />
          <?= anchor('admin/deleteEnumerator/'.$enumerator->id, 'Delete Account', array('class' => 'button')); ?>
        </div>
      <?= form_close(); ?>
      <? endforeach;?>
      <?= form_open('admin/addEnumerator', array('class' => 'enumerator-creation-form')); ?>
        <h3>Add Another Enumerator</h3>
        <div class="field">
          <label>Name</label>
          <input type="text" name="name" required />
        </div>
        <div class="field">
          <label>Email Address</label>
          <input type="email" name="email" required />
        </div>
        <?php foreach ($programs as $program) : ?>
          <label><input type="checkbox" name="degree_program[<?=$program->id?>]" /><?=$program->name?></label>
        <?php endforeach; ?>
        <label class="analysis-access"><input type="checkbox" name="analysis_access" />Can access statistical analysis tools?</label>
        <input type="submit" value="Create Enumerator" class="button" />
      <?= form_close(); ?>
    </div>
  </div>
</body>
</html>