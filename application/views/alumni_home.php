<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/questionnaire.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="alumni home">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li class="current visited" data-slide="personal-information"><a href="#">Personal Information</a></li>
        <li class="visited" data-slide="educational-background"><a href="#">Educational Background</a></li>
        <li class="visited" data-slide="employment-history"><a href="#">Employment History</a></li>
        <li data-slide="login-credentials"><a href="#">Login Credentials</a></li>
      </ul>
    </aside>

    <div class="content">
      <?= form_open('alumni/updatePersonalInfo','POST'); ?>
        <div class="slide current" data-name="personal-information">
          <h1>Personal Information</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>First Name</label>
            <h2><?=humanize($user_info[0]->firstname)?></h2>
            <input type="text" name="personal_information[firstname]" value="<?=humanize($user_info[0]->firstname)?>" class="editable hidden" data-current="<?=humanize($user_info[0]->firstname)?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Last Name</label>
            <h2><?=humanize($user_info[0]->lastname)?></h2>
            <input type="text" name="personal_information[lastname]" value="<?=humanize($user_info[0]->lastname)?>" class="editable hidden" data-current="<?=humanize($user_info[0]->lastname)?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Gender</label>
            <h2><?=humanize($user_info[0]->gender)?></h2>            
            <input type="radio" name="personal_information[gender]" value="male" id="g-male" class="editable hidden" data-current="<?=is_checked("male",$user_info[0]->gender)?>" <?=is_checked("male",$user_info[0]->gender)?> /><label for="g-male">Male</label>
            <input type="radio" name="personal_information[gender]" value="female" id="g-female" class="editable hidden" data-current="<?=is_checked("female",$user_info[0]->gender)?>" <?=is_checked("female",$user_info[0]->gender)?>/><label for="g-female">Female</label>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Present Address</label>
            <h2><?=humanize($user_info[0]->present_address)?></h2>
            <input type="text" name="personal_information[present_address]" value="<?=humanize($user_info[0]->present_address)?>" class="editable hidden" data-current="<?=humanize($user_info[0]->present_address)?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Country/State of Present Address</label>
            <h2><?=humanize($user_info[0]->country)?></h2>
            <select name="personal_information[country]" class="specifiable editable hidden" data-current="<?=$user_info[0]->country_id?>">
              <? foreach ($countries as $var): ?>
                <option value="<?= $var->id; ?>" <?=is_selected($var->id, $user_info[0]->country_id)?>><?= $var->name; ?></option>
              <? endforeach; ?>           
              <option value="others">Others</option>
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
            <input type="text" name="personal_information[specified_country]" placeholder="Country/State of Present Address" class="specify hidden" />
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <h2><?=$user_info[0]->present_contact_number?></h2>
            <input type="text" name="personal_information[present_address_contact_number]" value="<?=$user_info[0]->present_contact_number?>" class="editable hidden" data-current="<?=$user_info[0]->present_contact_number?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <h2><?=$user_info[0]->premanent_address?></h2>
            <input type="text" name="personal_information[permanent_address]" value="<?=$user_info[0]->premanent_address?>" class="editable hidden" data-current="<?=$user_info[0]->premanent_address?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <h2><?=$user_info[0]->permanent_contact_number?></h2>
            <input type="text" name="personal_information[permanent_address_contact_number]" value="<?=$user_info[0]->permanent_contact_number?>" class="editable hidden" data-current="<?=$user_info[0]->permanent_contact_number?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Email Address</label>
            <h2><?=$user_info[0]->email?></h2>
            <input type="email" name="personal_information[email_address]" value="<?=$user_info[0]->email?>" class="editable hidden" data-current="<?=$user_info[0]->email?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <span>Social Network Contact Information</span>
          <?foreach ($user_social_networks as $var) : ?>
            <div class="field indented">
              <label><?=$var->name?> Account</label>
              <h2><?=$var->account_name?></h2>
              <input type="text" name="personal_information[social_networks][<?=$var->id?>]" value="<?=$var->account_name?>" class="editable hidden" data-current="<?=$var->account_name?>" />
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          <? endforeach; ?>
          <?foreach ($social_networks as $var) : ?>
            <div class="field indented">
              <label><?=$var->name?> Account</label>
              <h2></h2>
              <input type="text" name="personal_information[social_networks][<?=$var->id?>]" value="" class="editable hidden" data-current="" />
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          <? endforeach; ?>
          <div class="field actions">
            <input type="submit" value="Save Changes" class="button hidden" />
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('alumni/updateEducationalBackground','POST'); ?>
        <div class="slide hidden" data-name="educational-background">
          <h1>Educational Background</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>Student Number</label>
            <h2><?=$user_info[0]->student_number?></h2>
            <input type="text" name="educational_background[student_number]" placeholder="xxxx-xxxxx" value="<?=$user_info[0]->student_number?>" class="editable hidden" data-current="<?=$user_info[0]->student_number?>" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h2><?=$user_info[0]->course?></h2>
            <select name="educational_background[degree_program]" class="editable hidden" data-current="<?=$user_info[0]->prog_id?>">
              <?foreach ($programs as $var) : ?>
                <option value="<?=$var->id?>" <?=is_selected($var->id, $user_info[0]->prog_id)?> ><?=$var->name?></option>
              <? endforeach;?>
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <h2><?php
                  if ($user_info[0]->year_graduated == "0 - 0") {
                    echo "Non-graduate";
                  }  else {
                  if ($user_info[0]->semester_graduated == 1) echo "1st Semester"; 
                  else if ($user_info[0]->semester_graduated == 2) echo "2nd Semester"; 
                  else echo "Summer"; ?>, AY <? echo $user_info[0]->year_graduated;
                  } ?>
            </h2>
            <select name="educational_background[graduated][semester]" class="editable hidden" data-current="<?=$user_info[0]->semester_graduated?>">
              <option value="1" <?=is_selected(1, $user_info[0]->semester_graduated)?>>1st Semester</option>
              <option value="2" <?=is_selected(2, $user_info[0]->semester_graduated)?>>2nd Semester</option>
              <option value="3" <?=is_selected(3, $user_info[0]->semester_graduated)?>>Summer</option>
            </select>
            <select name="educational_background[graduated][academic_year]" class="editable hidden" data-current="<?=$user_info[0]->year_graduated?>">
              <? $ctr = date('Y');
                while ($ctr > 1980) { 
              ?>
                <option value="<?echo ($ctr-1).'-'.$ctr;?>" <?=is_selected(($ctr-1).'-'.$ctr, $user_info[0]->year_graduated); ?>><?echo ($ctr-1).' - '.$ctr;?></option>
              <? $ctr--;
                }
              ?> 
              <option value="0 - 0" <?=is_selected("0 - 0", $user_info[0]->year_graduated); ?>>Non-graduate</option>                           
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <h2><?=humanize($user_info[0]->honor_received)?></h2>
            <select name="educational_background[honor_received]" class="editable hidden" data-current="<?=$user_info[0]->honor_received?>">
              <option value="none" selected>None</option>
              <option value="summa cum laude" <?=is_selected("summa cum laude", $user_info[0]->honor_received); ?>>Summa Cum Laude</option>
              <option value="magna cum laude" <?=is_selected("magna cum laude", $user_info[0]->honor_received); ?>>Magna Cum Laude</option>
              <option value="cum laude" <?=is_selected("cum laude", $user_info[0]->honor_received); ?>>Cum Laude</option>              
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field actions">
            <input type="submit" value="Save Changes" class="button hidden" />
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('alumni/updateCurrentJob', 'post'); ?>
        <div class="slide hidden" data-name="employment-history">
          <h1>Employment History</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>
          <?php if ($current_job) : ?>
          <div class="job-form previous-job">
            <span>Job information</span>
            <div class="field indented">
              <label>Are you self-employed?</label>
              <h2><?=($current_job[0]->self_employed == 1)? "Yes" : "No"; ?></h2>
            </div>
            <?php if ($current_job[0]->business) : ?>
              <div class="field indented">
                <label>What is your business/work?</label>
                <h2><?=$current_job[0]->business?></h2>
              </div>
            <? endif; ?>
            <?php if ($current_job[0]->employer) : ?>
              <div class="field indented">
                <label>Employer</label>
                <h2><?=$current_job[0]->employer?></h2>
              </div>
            <? endif; ?>
            <div class="field indented">
              <label>Employer/Business Type</label>
              <h2><?=$current_job[0]->employer_type?></h2>
            </div>
            <div class="field indented">
              <label>Job Title/Position</label>
              <h2><?=$current_job[0]->job_title?></h2>
            </div>
            <div class="field indented">
              <label>Monthly Salary (in Philippine Peso)</label>
              <h2> <?php if (!$current_job[0]->minimum) {
                            echo "below " . $current_job[0]->maximum; 
                    } else if (!$current_job[0]->maximum) {
                            echo "above " . $current_job[0]->minimum;
                    } else {
                            echo $current_job[0]->minimum . " - " . $current_job[0]->maximum;
                    }?>
              </h2>
            </div>
            <div class="field indented">
              <label>Employment Duration</label>
              <h2><?php echo $current_job[0]->year_started; echo ($current_job[0]->year_ended == 100000)? " until now" : " - " . $current_job[0]->year_ended; ?></h2>
            </div>
            <div class="field indented">
              <label>Satisfied with this job?</label>
              <h2><?=($current_job[0]->job_satisfaction == 1)? "Yes" : "No"?></h2>
            </div>
            <div class="field indented">
              <label>Why or why not satisfied?</label>
              <h2><?=($current_job[0]->reason)? $current_job[0]->reason : "No reason!"?></h2>
            </div>
          </div>
          <? endif; ?>
          <div class="job-form hidden" data-job-form="current-job">
            <span>Current Job Information</span>
            <div class="field indented">
              <label>Are you self-employed?</label>
              <input type="radio" name="employment_history[0][self_employed]" value="1" id="employment_history[0][se-yes]" data-behavior="toggle-self-employed" <?= pop_is_checked("employment_history", '0', "self_employed", null, 1); ?> /><label for="employment_history[0][se-yes]">Yes</label>
              <input type="radio" name="employment_history[0][self_employed]" value="0" id="employment_history[0][se-no]" data-behavior="toggle-self-employed" <?= (pop_is_checked("employment_history", '0', "self_employed", null, 1) != 'checked') ? 'checked' : ''; ?> /><label for="employment_history[0][se-no]">No</label>
            </div>
            <div class="field indented <?= (pop_is_checked("employment_history", '0', "self_employed", null, 1) == 'checked') ? '' : 'hidden'; ?>" data-field="business-name">
              <label>What is your business/work?</label>
              <input type="text" name="employment_history[0][business_name]" value="<?=pop_set_field_value('employment_history', '0', 'business_name', null); ?>"/>
            </div>
            <div class="field indented <?= (pop_is_checked("employment_history", '0', "self_employed", null, 1) != 'checked') ? '' : 'hidden'; ?>" data-field="employer">
              <label>Employer</label>
              <input type="text" name="employment_history[0][employer]" value="<?=pop_set_field_value('employment_history', '0', 'employer', null); ?>"/>
            </div>
            <div class="field indented">
              <label>Employer/Business Type</label>
              <select name="employment_history[0][employer_type]" class="specifiable">
                <?php foreach ($employer_types as $type): ?>
                  <option value="<?= $type->id; ?>" <?= pop_is_selected('employment_history', '0', 'employer_type', null, $type->id); ?>><?=$type->name?></option>
                <?php endforeach; ?>               
                <option value="others" <?=pop_is_selected('employment_history', '0', 'employer_type', null, 'others'); ?>>Others</option>
              </select>
              <input type="text" name="employment_history[0][specified_employer_type]" placeholder="Employer/Business Type" value="<?= pop_set_field_value('employment_history', '0', 'specified_employer_type', null); ?>" class="specify <?= (is_selected('employment_history', '0', 'employer_type', null, 'others') == 'selected') ? '' : 'hidden'; ?>" />
            </div>
            <div class="field indented">
              <label>Job Title/Position</label>
              <input type="text" name="employment_history[0][job_title]" value="<?=pop_set_field_value('employment_history', '0', 'job_title', null); ?>"/>
            </div>
            <div class="field indented">
              <label>Monthly Salary (in Philippine Peso)</label>
              <select name="employment_history[0][monthly_salary]">
                <?php foreach ($salaries as $val) : ?>
                  <option value="<?=$val->id?>" <?=pop_is_selected('employment_history', '0', 'monthly_salary', null, $val->id); ?>>
                    <?php
                      if ($val->minimum == null)
                        echo $val->maximum." and below";
                      else if ($val->maximum == null)
                        echo $val->minimum." and above";
                      else
                        echo $val->minimum." - ".$val->maximum;
                    ?>
                  </option>
                <? endforeach; ?>                 
              </select>
            </div>
            <div class="field indented" data-field="employment-duration">
              <label>Employment Duration</label>
              <select name="employment_history[#{index}][employment_duration][start_month]"  class="narrow">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select name="employment_history[0][employment_duration][start_year]" class="narrow">
                <?php 
                  $year = date('Y');
                  while ($year >= 1980) { 
                ?>
                  <option value="<?=$year?>" <?=pop_is_selected('employment_history', '0', 'employment_duration', "start_year", $year); ?>><?=$year?></option>
                <?    
                    $year--;
                  } 
                ?>                
              </select>
              <i>to</i>
              <select name="employment_history[#{index}][employment_duration][end_month]"  class="narrow">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
              <select name="employment_history[0][employment_duration][end_year]" class="narrow">
                <option value="100000" <?=pop_is_selected('employment_history', '0', 'employment_duration', "end_year", 100000); ?>>ongoing</option>
                <?php 
                  $year = date('Y');
                  while ($year >= 1980) { 
                ?>
                  <option value="<?=$year?>" <?=pop_is_selected('employment_history', '0', 'employment_duration', "end_year", $year); ?>><?=$year?></option>
                <?    
                    $year--;
                  } 
                ?>   
              </select>
            </div>
            <div class="field indented">
              <label>Satisfied with this job?</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="1" id="employment_history[0][swj-yes]" <?=pop_is_checked("employment_history", '0', "satisfied_with_job", null, 1); ?>/><label for="employment_history[0][swj-yes]">Yes</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="0" id="employment_history[0][swj-no]" <?=pop_is_checked("employment_history", '0', "satisfied_with_job", null, 0); ?>/><label for="employment_history[0][swj-no]">No</label>
            </div>
            <div class="field indented textarea">
              <label>Why or why not satisfied?</label>
              <textarea name="employment_history[0][satisfaction_reason]"><?=pop_set_field_value('employment_history', '0', 'satisfaction_reason', null); ?></textarea>
            </div>
          </div>
          <div class="field actions">
            <input type="button" value="Update Current Job" class="button" data-behavior="update-current-job" />
            <input type="submit" value="Submit" class="button hidden" />
            <a href="#" class="hidden" data-behavior="cancel">[cancel]</a>
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('alumni/updateAccount'); ?>
        <div class="slide hidden" data-name="login-credentials">
          <h1>Login Credentials</h1>
          <p>Edit the information used to login to your account.</p>

          <div class="field">
            <label>Current Password</label>
            <input type="password" name="current_password" />
          </div>
          <div class="field">
            <label>New Password</label>
            <input type="password" name="new_password" />
          </div>
          <div class="field">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_new_password" />
          </div>
          <div class="field actions">
            <input type="submit" value="Update Password" class="button" />
          </div>
        </div>
      <?= form_close(); ?>
    </div>
  </div>
</body>
</html>