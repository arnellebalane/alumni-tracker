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

<body class="admin clean">
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
        <li><?= anchor('admin/alumni', 'Alumni Data', array('class' => 'current')); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Arnelle Balane</h1>
      <div class="clean-actions">
        <?= anchor('#', 'Mark as Clean', array('class' => 'green')); ?>
        <?= anchor('admin/deleteAlumni/'.$user_id, 'Discard', array('class' => 'red')); ?>
      </div>

      <?= form_open('#'); ?>
        <section id="personal-information">
          <h3>Personal Information</h3>
          <div class="field">
            <label>First Name</label>
            <h4><?=humanize($user_info[0]->firstname)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[firstname]" value="<?=humanize($user_info[0]->firstname)?>" data-current="<?=humanize($user_info[0]->firstname)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Last Name</label>
            <h4><?=humanize($user_info[0]->lastname)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[lastname]" value="<?=humanize($user_info[0]->lastname)?>" data-current="<?=humanize($user_info[0]->lastname)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Gender</label>
            <h4><?=humanize($user_info[0]->gender)?></h4>
            <div class="editable hidden">
              <label><input type="radio" name="personal_information[gender]" value="male" data-current="<?=is_checked("male",$user_info[0]->gender)?>" <?=is_checked("male",$user_info[0]->gender)?> />Male</label>
              <label><input type="radio" name="personal_information[gender]" value="female" data-current="<?=is_checked("female",$user_info[0]->gender)?>" <?=is_checked("female",$user_info[0]->gender)?>/>Female</label>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Present Address</label>
            <h4><?=humanize($user_info[0]->present_address)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[present_address]" value="<?=humanize($user_info[0]->present_address)?>" data-current="<?=humanize($user_info[0]->present_address)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Country/State of Present Address</label>
            <h4>Philippines</h4>
            <div class="editable hidden">
              <select name="country" data-current="1">
                <option value="1" selected>Philippines</option>
                <option value="2">North Korea</option>
                <option value="3">Vietnam</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <h4><?=humanize($user_info[0]->present_contact_number)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[present_address_contact_number]" value="<?=humanize($user_info[0]->present_contact_number)?>" data-current="<?=humanize($user_info[0]->present_contact_number)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <h4><?=humanize($user_info[0]->premanent_address)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[permanent_address]" value="<?=humanize($user_info[0]->premanent_address)?>" data-current="<?=humanize($user_info[0]->premanent_address)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <h4><?=humanize($user_info[0]->permanent_contact_number)?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[permanent_address_contact_number]" value="<?=humanize($user_info[0]->permanent_contact_number)?>" data-current="<?=humanize($user_info[0]->permanent_contact_number)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Email Address</label>
            <h4><?=$user_info[0]->email?></h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[email_address]" value="<?=$user_info[0]->email?>" data-current="<?=$user_info[0]->email?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <span>Social Network Contact Information</span>
          <? foreach ($user_social_networks as $var) : ?>
            <div class="field indented">
              <label><?=$var->name?></label>
              <h4><?=$var->account_name?></h4>
              <div class="editable hidden">
                <input type="text" name="personal_information[social_networks][<?=$var->id?>]" value="<?=$var->account_name?>" data-current="<?=$var->account_name?>" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          <? endforeach;?>
          <? foreach ($social_networks as $var) : ?>
            <div class="field indented">
              <label><?=$var->name?></label>
              <h4></h4>
              <div class="editable hidden">
                <input type="text" name="personal_information[social_networks][<?=$var->id?>]" value="" data-current="" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          <? endforeach;?>
        </section>

        <section id="educational-background">
          <h3>Educational Background</h3>
          <div class="field">
            <label>Student Number</label>
            <h4><?=humanize($user_info[0]->student_number)?></h4>
            <div class="editable hidden">
              <input type="text" name="student_number" value="<?=humanize($user_info[0]->student_number)?>" data-current="<?=humanize($user_info[0]->student_number)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h4><?=$user_info[0]->course?></h4>
            <div class="editable hidden">
              <select name="degree_program" data-current="<?=$user_info[0]->prog_id?>">
                <?foreach ($programs as $var) : ?>
                  <option value="<?=$var->id?>" <?=is_selected($var->id, $user_info[0]->prog_id)?> ><?=$var->name?></option>
                <? endforeach;?>
              </select>              
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <h4><?php
                  if ($user_info[0]->year_graduated == "0 - 0") {
                    echo "Non-graduate";
                  }  else {
                  if ($user_info[0]->semester_graduated == 1) echo "1st Semester"; 
                  else if ($user_info[0]->semester_graduated == 2) echo "2nd Semester"; 
                  else echo "Summer"; ?>, AY <? echo $user_info[0]->year_graduated;
                  } ?>
            </h4>
            <div class="editable hidden">
              <select name="graduated[semester]" class="auto" data-current="<?=$user_info[0]->semester_graduated?>">
                <option value="1" <?=is_selected(1, $user_info[0]->semester_graduated)?>>1st Semester</option>
                <option value="2" <?=is_selected(2, $user_info[0]->semester_graduated)?>>2nd Semester</option>
                <option value="3" <?=is_selected(3, $user_info[0]->semester_graduated)?>>Summer</option>
              </select>
              <select name="graduated[academic_year]" class="auto" data-current="<?=$user_info[0]->year_graduated?>">
                <? $ctr = date('Y');
                  while ($ctr > 1980) { 
                ?>
                <option value="<?echo ($ctr-1).'-'.$ctr;?>" <?=is_selected(($ctr-1).'-'.$ctr, $user_info[0]->year_graduated); ?>><?echo ($ctr-1).' - '.$ctr;?></option>
                <? $ctr--;
                  }
                ?> 
                <option value="0 - 0" <?=is_selected("0 - 0", $user_info[0]->year_graduated); ?>>Non-graduate</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <h4><?=humanize($user_info[0]->honor_received)?></h4>
            <div class="editable hidden">
              <select name="honor_received" data-current="<?=$user_info[0]->honor_received?>">
                <option value="none" selected>None</option>
                <option value="summa cum laude" <?=is_selected("summa cum laude", $user_info[0]->honor_received); ?>>Summa Cum Laude</option>
                <option value="magna cum laude" <?=is_selected("magna cum laude", $user_info[0]->honor_received); ?>>Magna Cum Laude</option>
                <option value="cum laude" <?=is_selected("cum laude", $user_info[0]->honor_received); ?>>Cum Laude</option>              
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
        </section>

        <section id="employment-history">
          <h3>Employment History</h3>
          <div class="job">
            <h4>Current Job</h4>
            <div class="field">
              <label>Self-employed?</label>
              <h4>No</h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[0][self_employed]" value="yes" data-current="true" checked>Yes</label>
                <label><input type="radio" name="jobs[0][self_employed]" value="no" data-current="false">No</label>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employer</label>
              <h4>Insert Company Name Here</h4>
              <div class="editable hidden">
                <input type="text" name="jobs[0][employer]" value="Insert Company Name Here" data-current="Insert Company Name Here" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employer/Business Type</label>
              <h4>IT Company</h4>
              <div class="editable hidden">
                <select name="jobs[0][business_type]" data-current="1">
                  <option value="1" selected>IT Industry</option>
                  <option value="2">BPO</option>
                  <option value="3">KPO</option>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Job Title/Position</label>
              <h4>Developer</h4>
              <div class="editable hidden">
                <input type="text" name="jobs[0][job_title]" value="Developer" data-current="Developer" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Monthly Salary (in Philippine Peso)</label>
              <h4>10,000 and below</h4>
              <div class="editable hidden">
                <select name="jobs[0][monthly_salary]" data-current="1">
                  <option value="1">10,000 and below</option>
                  <option value="2">40,000 to 60,000</option>
                  <option value="3">100,000 and above</option>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employment Duration</label>
              <h4>2014 - ongoing</h4>
              <div class="editable hidden">
                <select name="jobs[0][employment_duration][start_year]" class="auto" data-current="2013">
                  <option value="2014">2014</option>
                  <option value="2013" selected>2013</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                </select>
                <span>to</span>
                <select name="jobs[0][employment_duration][start_year]" class="auto" data-current="ongoing">
                  <option value="ongoing" selected>ongoing</option>
                  <option value="2014">2014</option>
                  <option value="2013">2013</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Satisfied with job?</label>
              <h4>Yes</h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[0][satisfied_with_job]" value="yes" data-current="true" checked />Yes</label>
                <label><input type="radio" name="jobs[0][satisfied_with_job]" value="no" data-current="false" />No</label>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Why or why not satisfied?</label>
              <h4>Lorem ipsum Nulla Excepteur dolore exercitation cupidatat tempor tempor velit dolore laborum Excepteur non.</h4>
              <div class="editable hidden">
                <textarea name="jobs[0][satisfaction_reason]" data-current="current value here">current value here</textarea>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          </div>
        </section>

        <input type="submit" value="Save Changes" class="button" />
      <?= form_close(); ?>
    </div>
  </div>
</body>
</html>