<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/enumerator.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <?php $this->load->view('partials/google_analytics'); ?>
  <title>Alumni Tracker</title>
</head>

<body class="enumerator clean">
  <?php if ($this->session->flashdata('notice')): ?>
    <p class="notification notice"><?= $this->session->flashdata('notice'); ?></p>
  <?php elseif ($this->session->flashdata('alert')): ?>
    <p class="notification alert"><?= $this->session->flashdata('alert'); ?></p>
  <?php endif; ?>
  <?= anchor('session/logout', 'Sign Out', array('id' => 'sign-out')); ?>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><?= anchor('enumerator/index', 'Alumni Data', array('class' => 'current')); ?></li>
        <li><?= anchor('enumerator/settings', 'Account Settings'); ?></li>
      </ul>
    </aside>

    <div class="content">
      <h1><?=humanize($user_info[0]->firstname)." ".humanize($user_info[0]->lastname) ?></h1>
      <div class="clean-actions">
        <?=($user_info[0]->cleaned == 0) ? anchor('enumerator/markAlumniClean/'.$user_id, 'Mark as Clean', array('class' => 'green')) : anchor('enumerator/markAlumniUnClean/'.$user_id, 'Mark as UnClean', array('class' => 'green')); ?>
        <?= anchor('enumerator/deleteAlumni/'.$user_id, 'Discard', array('class' => 'red')); ?>

        <!--<?= anchor('#', 'Previous Alumni', array('class' => 'navigation')); ?>
        <?= anchor('#', 'Next Alumni', array('class' => 'navigation')); ?>-->
      </div>

      <?= form_open('admin/updateAlumni/'.$user_id); ?>
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
          <div class="field radio">
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
            <h4><?=humanize($user_info[0]->country)?></h4>
            <div class="editable hidden">
              <select name="personal_information[country]" data-current="<?=$user_info[0]->country_id?>">
                <? foreach ($countries as $var): ?>
                  <option value="<?= $var->id; ?>" <?=is_selected($var->id, $user_info[0]->country_id)?>><?= $var->name; ?></option>
                <? endforeach; ?>
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
              <input type="text" name="educational_background[student_number]" value="<?=humanize($user_info[0]->student_number)?>" data-current="<?=humanize($user_info[0]->student_number)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h4><?=$user_info[0]->course?></h4>
            <div class="editable hidden">
              <select name="educational_background[degree_program]" data-current="<?=$user_info[0]->prog_id?>">
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
              <select name="educational_background[graduated][semester]" class="auto" data-current="<?=$user_info[0]->semester_graduated?>">
                <option value="1" <?=is_selected(1, $user_info[0]->semester_graduated)?>>1st Semester</option>
                <option value="2" <?=is_selected(2, $user_info[0]->semester_graduated)?>>2nd Semester</option>
                <option value="3" <?=is_selected(3, $user_info[0]->semester_graduated)?>>Summer</option>
              </select>
              <select name="educational_background[graduated][academic_year]" class="auto" data-current="<?=$user_info[0]->year_graduated?>">
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
              <select name="educational_background[honor_received]" data-current="<?=$user_info[0]->honor_received?>">
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
          <input type="button" value="Add Another Job" data-behavior="add-another-job" />

          <?php foreach($jobs as $job)  : ?>
          <div class="job">
            <?php

              $job_text = 'Other Job';
              if ($job->current_job == 1) {
                $job_text = 'Current Job';
              } else if ($job->first_job == 1) {
                $job_text = 'First Job';
              }

             ?>
            <h4><?= $job_text . anchor('admin/deleteJob/'.$user_id.'/'.$job->id, '[Delete this Job]'); ?></h4>
            <div class="field radio">
              <label>Self-employed?</label>
              <h4><?=($job->self_employed == 0) ? "No" : "Yes";?></h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[<?=$job->id?>][self_employed]" value="1" data-current="<?=($job->self_employed == 0) ? "false" : "true";?>" <?=is_checked(1, $job->self_employed)?>>Yes</label>
                <label><input type="radio" name="jobs[<?=$job->id?>][self_employed]" value="0" data-current="<?=($job->self_employed == 1) ? "false" : "true";?>" <?=is_checked(0, $job->self_employed)?>>No</label>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employer</label>
              <h4><?=($job->self_employed == 0) ? $job->employer: $job->business;?></h4>
              <div class="editable hidden">
                <input type="text" name="jobs[<?=$job->id?>][employer]" value="<?=($job->self_employed == 0) ? $job->employer: $job->business;?>" data-current="<?=($job->self_employed == 0) ? $job->employer: $job->business;?>" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employer/Business Type</label>
              <h4><?=$job->employer_type?></h4>
              <div class="editable hidden">
                <select name="jobs[<?=$job->id?>][employer_type]" data-current="<?=$job->employer_type_id?>">
                  <?php foreach ($employer_types as $employer) : ?>
                    <option value="<?=$employer->id?>" <?=is_selected($employer->id, $job->employer_type_id)?>><?=$employer->name?></option>
                  <? endforeach;?>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Job Title/Position</label>
              <h4><?=$job->job_title?></h4>
              <div class="editable hidden">
                <input type="text" name="jobs[<?=$job->id?>][job_title]" value="<?=$job->job_title?>" data-current="<?=$job->job_title?>" />
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Monthly Salary (in Philippine Peso)</label>
              <h4>
                <?php if (!$job->minimum) {
                        echo "below " . $job->maximum; 
                } else if (!$job->maximum) {
                        echo "above " . $job->minimum;
                } else {
                        echo $job->minimum . " - " . $job->maximum;
                }?>
              </h4>
              <div class="editable hidden">
                <select name="jobs[<?=$job->id?>][monthly_salary]" data-current="<?=$job->monthly_salary_id?>">
                  <?php foreach ($salaries as $sal) :?>
                    <option value="<?=$sal->id?>" <?=is_selected($sal->id, $job->monthly_salary_id)?> >
                        <?php if ($sal->minimum == NULL) {echo $sal->maximum . " and below";}
                         elseif ($sal->maximum == NULL) {echo $sal->minimum . " and above";}
                         else {echo $sal->minimum . " - " . $sal->maximum;} ?>
                    </option>                  
                  <?php endforeach; ?>                  
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employment Duration</label>
              <h4><?=$job->year_started?> - <?=($job->year_ended != 100000) ? $job->year_ended: "ongoing";?></h4>
              <div class="editable hidden">
                <select name="jobs[<?=$job->id?>][employment_duration][start_year]" class="auto" data-current="<?=$job->year_started?>">
                  <?php 
                    $year = date('Y');
                    while ($year >= 1980) { 
                  ?>
                    <option value="<?=$year?>" <?=is_selected($year, $job->year_started); ?>><?=$year?></option>
                  <?    
                      $year--;
                    }
                  ?>
                </select>
                <span>to</span>
                <select name="jobs[<?=$job->id?>][employment_duration][end_year]" class="auto" data-current="<?=$job->year_ended?>">
                  <? if ($job->current_job == 1) { ?>
                    <option value="100000" <?=is_selected(100000, $job->year_ended)?>>ongoing</option>
                  <?}?>
                  <?php 
                    $year = date('Y');
                    while ($year >= 1980) { 
                  ?>
                    <option value="<?=$year?>" <?=is_selected($year, $job->year_ended); ?>><?=$year?></option>
                  <?    
                      $year--;
                    }
                  ?>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field radio">
              <label>Satisfied with job?</label>
              <h4><?=($job->job_satisfaction == 1) ? "Yes" : "No";?></h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[<?=$job->id?>][satisfied_with_job]" value="1" data-current="<?=($job->job_satisfaction == 1) ? 'true':'false';?>" <?=is_checked(1, $job->job_satisfaction)?> />Yes</label>
                <label><input type="radio" name="jobs[<?=$job->id?>][satisfied_with_job]" value="0" data-current="<?=($job->job_satisfaction == 0) ? 'true':'false';?>" <?=is_checked(0, $job->job_satisfaction)?> />No</label>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Why or why not satisfied?</label>
              <h4><?=$job->reason?></h4>
              <div class="editable hidden">
                <textarea name="jobs[<?=$job->id?>][satisfaction_reason]" data-current="<?=$job->reason?>"><?=$job->reason?></textarea>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          </div>
        <? endforeach; ?>
        </section>

        <input type="submit" value="Save Changes" class="button" />
      <?= form_close(); ?>

      <div class="hidden" id="job-form-template">
        <div class="field unindented inline">
          <label>Another Job Information<a href="#" data-behavior="discard-another-job">[Delete this Job]</a></label>
          <input type="checkbox" name="another_job[{{index}}][current_job]" /><label>Current Job</label>
          <input type="checkbox" name="another_job[{{index}}][first_job]" /><label>First Job</label>
        </div>
        <div class="field inline">
          <label>Self-employed?</label>
          <input type="radio" name="another_job[{{index}}][self_employed]" value="yes" data-behavior="toggle-self-employed" /><label>Yes</label>
          <input type="radio" name="another_job[{{index}}][self_employed]" value="no" data-behavior="toggle-self-employed" checked /><label>No</label>
        </div>
        <div class="field hidden" data-field="business">
          <label>Business</label>
          <input type="text" name="another_job[{{index}}][business_name]" />
        </div>
        <div class="field" data-field="employer">
          <label>Employer</label>
          <input type="text" name="another_job[{{index}}][employer]" />
        </div>
        <div class="field">
          <label>Employer/Business Type</label>
          <select name="another_job[{{index}}][business_type]">
            <?php foreach ($employer_types as $var) : ?>
              <option value="<?= $var->id ?>"><?= $var->name ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="field">
          <label>Job Title/Position</label>
          <input type="text" name="another_job[{{index}}][job_title]" />
        </div>
        <div class="field">
          <label>Monthly Salary (in Philippine Peso)</label>
          <select name="another_job[{{index}}][monthly_salary]">
            <?php foreach ($salaries as $sal) :?>
              <option value="<?=$sal->id?>" >
              <?php if ($sal->minimum == NULL) {echo $sal->maximum . " and below";}
                elseif ($sal->maximum == NULL) {echo $sal->minimum . " and above";}
                else {echo $sal->minimum . " - " . $sal->maximum;} ?>
              </option>                  
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label>Employment Duration</label>
          <select name="another_job[{{index}}][employment_duration][start_year]" class="auto">
            <?php 
              $year = date('Y');
              while ($year >= 1980) { 
            ?>
              <option value="<?=$year?>"><?=$year?></option>
            <?    
                $year--;
              }
            ?>
          </select>
          <span>to</span>
          <select name="another_job[{{index}}][employment_duration][end_year]" class="auto">
            <? if ($job->current_job == 1) { ?>
              <option value="100000" <?=is_selected(100000, $job->year_ended)?>>ongoing</option>
            <?}?>
            <?php 
              $year = date('Y');
              while ($year >= 1980) { 
            ?>
              <option value="<?=$year?>"><?=$year?></option>
            <?    
                $year--;
              }
            ?>
          </select>
        </div>
        <div class="field inline">
          <label>Satisfied with Job?</label>
          <input type="radio" name="another_job[{{index}}][satisfied_with_job]" value="yes" checked /><label>Yes</label>
          <input type="radio" name="another_job[{{index}}][satisfied_with_job]" value="no" /><label>No</label>
        </div>
        <div class="field">
          <label>Why or why not satisfied?</label>
          <textarea name="another_job[{{index}}][satisfaction_reason]"></textarea>
        </div>
      </div>
    </div>
  </div>
</body>
</html>