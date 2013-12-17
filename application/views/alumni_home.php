<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/questionnaire.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2'; ?>.js"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <title>Alumni Tracker</title>
</head>

<body class="alumni home">
  <p class="notification notice">Welcome, Random User!</p>
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li class="current visited" data-slide="personal-information"><a href="#">Personal Information</a></li>
        <li class="visited" data-slide="educational-background"><a href="#">Educational Background</a></li>
        <li class="visited" data-slide="employment-history"><a href="#">Employment History</a></li>
        <li class="visited" data-slide="others"><a href="#">Others</a></li>
      </ul>
    </aside>

    <div class="content">
      <?= form_open('#'); ?>
        <div class="slide current" data-name="personal-information">
          <h1>Personal Information</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>First Name</label>
            <h2>Arnelle</h2>
            <input type="text" name="personal_information[firstname]" value="Arnelle" class="editable hidden" data-current="Arnelle" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Last Name</label>
            <h2>Balane</h2>
            <input type="text" name="personal_information[lastname]" value="Balane" class="editable hidden" data-current="Balane" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Gender</label>
            <h2>Male</h2>
            <input type="radio" name="personal_information[gender]" value="male" id="g-male" class="editable hidden" data-current="checked" checked /><label for="g-male">Male</label>
            <input type="radio" name="personal_information[gender]" value="female" id="g-female" class="editable hidden" data-current="unchecked" /><label for="g-female">Female</label>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Present Address</label>
            <h2>Cebu City</h2>
            <input type="text" name="personal_information[present_address]" value="Cebu City" class="editable hidden" data-current="Cebu City" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Country/State of Present Address</label>
            <h2>Philippines</h2>
            <select name="personal_information[country]" class="specifiable editable hidden" data-current="Philippines">
              <? foreach ($countries as $var): ?>
                <option value="<?= $var->id; ?>"><?= $var->name; ?></option>
              <? endforeach; ?>           
              <option value="others">Others</option>
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
            <input type="text" name="personal_information[specified_country]" placeholder="Country/State of Present Address" class="specify hidden" />
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <h2>09496547250</h2>
            <input type="text" name="personal_information[present_address_contact_number]" value="09496547250" class="editable hidden" data-current="09496547250" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <h2>Tagbilaran City</h2>
            <input type="text" name="personal_information[permanent_address]" value="Tagbilaran City" class="editable hidden" data-current="Tagbilaran City" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <h2>09496547250</h2>
            <input type="text" name="personal_information[permanent_address_contact_number]" value="09496547250" class="editable hidden" data-current="09496547250" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Email Address</label>
            <h2>arnellebalane@gmail.com</h2>
            <input type="email" name="personal_information[email_address]" value="arnellebalane@gmail.com" class="editable hidden" data-current="arnellebalane@gmail.com" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <span>Social Network Contact Information</span>
          <?foreach ($social_networks as $var) : ?>
            <div class="field indented">
              <label><?=$var->name?> Account</label>
              <h2>Arnelle Balane</h2>
              <input type="text" name="personal_information[social_networks][<?=$var->id?>]" value="Arnelle Balane" class="editable hidden" data-current="Arnelle Balane" />
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          <? endforeach; ?>
          <div class="field actions">
            <input type="submit" value="Save Changes" class="button" />
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('#'); ?>
        <div class="slide hidden" data-name="educational-background">
          <h1>Educational Background</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>Student Number</label>
            <h2>2011-37575</h2>
            <input type="text" name="educational_background[student_number]" placeholder="xxxx-xxxxx" value="2011-37575" class="editable hidden" data-current="2011-37575" />
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h2>BS Computer Science</h2>
            <select name="educational_background[degree_program]" class="editable hidden" data-current="BS Computer Science">
              <?foreach ($programs as $var) : ?>
                <option value="<?=$var->id?>" <?=is_selected('educational_background', 'degree_program', null, null, $var->id); ?>><?=$var->name?></option>
              <? endforeach;?>
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <h2>2nd Semester, AY 2012-2013</h2>
            <select name="educational_background[graduated][semester]" class="editable hidden" data-current="2">
              <option value="1" <?=is_selected('educational_background', 'graduated', 'semester', null, 1); ?>>1st Semester</option>
              <option value="2" <?=is_selected('educational_background', 'graduated', 'semester', null, 2); ?>>2nd Semester</option>
              <option value="3" <?=is_selected('educational_background', 'graduated', 'semester', null, 3); ?>>Summer</option>
            </select>
            <select name="educational_background[graduated][academic_year]" class="editable hidden" data-current="2012-2013">
              <? $ctr = date('Y');
                while ($ctr > 1980) { 
              ?>
                <option value="<?echo ($ctr-1).'-'.$ctr;?>" <?=is_selected('educational_background', 'graduated', 'academic_year', null, ($ctr-1).'-'.$ctr); ?>><?echo ($ctr-1).' - '.$ctr;?></option>
              <? $ctr--;
                }
              ?>                            
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <h2>None</h2>
            <select name="educational_background[honor_received]" class="editable hidden" data-current="none">
              <option value="none" selected>None</option>
              <option value="summa cum laude" <?=is_selected('educational_background', 'honor_received', null, null, "summa cum laude"); ?>>Summa Cum Laude</option>
              <option value="magna cum laude" <?=is_selected('educational_background', 'honor_received', null, null, "magna cum laude"); ?>>Magna Cum Laude</option>
              <option value="cum laude" <?=is_selected('educational_background', 'honor_received', null, null, "cum laude"); ?>>Cum Laude</option>              
            </select>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field actions">
            <input type="submit" value="Save Changes" class="button" />
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('#'); ?>
        <div class="slide hidden" data-name="employment-history">
          <h1>Employment History</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="job-form" data-job-form="current-job">
            <span>Current Job Information</span>
            <div class="field indented">
              <label>Are you self-employed?</label>
              <input type="radio" name="employment_history[0][self_employed]" value="1" id="employment_history[0][se-yes]" data-behavior="toggle-self-employed" <?= is_checked("employment_history", '0', "self_employed", null, 1); ?> /><label for="employment_history[0][se-yes]">Yes</label>
              <input type="radio" name="employment_history[0][self_employed]" value="0" id="employment_history[0][se-no]" data-behavior="toggle-self-employed" <?= (is_checked("employment_history", '0', "self_employed", null, 1) != 'checked') ? 'checked' : ''; ?> /><label for="employment_history[0][se-no]">No</label>
            </div>
            <div class="field indented <?= (is_checked("employment_history", '0', "self_employed", null, 1) == 'checked') ? '' : 'hidden'; ?>" data-field="business-name">
              <label>What is your business/work?</label>
              <input type="text" name="employment_history[0][business_name]" value="<?=set_field_value('employment_history', '0', 'business_name', null); ?>"/>
            </div>
            <div class="field indented <?= (is_checked("employment_history", '0', "self_employed", null, 1) != 'checked') ? '' : 'hidden'; ?>" data-field="employer">
              <label>Employer</label>
              <input type="text" name="employment_history[0][employer]" value="<?=set_field_value('employment_history', '0', 'employer', null); ?>"/>
            </div>
            <div class="field indented">
              <label>Employer/Business Type</label>
              <select name="employment_history[0][employer_type]" class="specifiable">
                <?php foreach ($employer_types as $type) { ?>
                  <option value="<?=$type->id?>" <?=is_selected('employment_history', '0', 'employer_type', null, $type->id); ?>><?=$type->name?></option>
                <?}?>               
                <option value="others" <?=is_selected('employment_history', '0', 'employer_type', null, 'others'); ?>>Others</option>
              </select>
              <input type="text" name="employment_history[0][specified_employer_type]" placeholder="Employer/Business Type" value="<?= set_field_value('employment_history', '0', 'specified_employer_type', null); ?>" class="<?= (is_selected('employment_history', '0', 'employer_type', null, 'others') == 'selected') ? '' : 'hidden'; ?>" />
            </div>
            <div class="field indented">
              <label>Job Title/Position</label>
              <input type="text" name="employment_history[0][job_title]" value="<?=set_field_value('employment_history', '0', 'job_title', null); ?>"/>
            </div>
            <div class="field indented">
              <label>Monthly Salary (in Philippine Peso)</label>
              <select name="employment_history[0][monthly_salary]">
                <?php foreach ($salaries as $val) : ?>
                  <option value="<?=$val->id?>" <?=is_selected('employment_history', '0', 'monthly_salary', null, $val->id); ?>>
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
            <div class="field indented">
              <label>Employment Duration</label>
              <select name="employment_history[0][employment_duration][start_year]" class="narrow">
                <?php 
                  $year = date('Y');
                  while ($year >= 1980) { 
                ?>
                  <option value="<?=$year?>" <?=is_selected('employment_history', '0', 'employment_duration', "start_year", $year); ?>><?=$year?></option>
                <?    
                    $year--;
                  } 
                ?>                
              </select>
              <i>to</i>
              <select name="employment_history[0][employment_duration][end_year]" class="narrow">
                <option value="100000" <?=is_selected('employment_history', '0', 'employment_duration', "end_year", 100000); ?>>ongoing</option>
                <?php 
                  $year = date('Y');
                  while ($year >= 1980) { 
                ?>
                  <option value="<?=$year?>" <?=is_selected('employment_history', '0', 'employment_duration', "end_year", $year); ?>><?=$year?></option>
                <?    
                    $year--;
                  } 
                ?>   
              </select>
            </div>
            <div class="field indented">
              <label>Satisfied with this job?</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="1" id="employment_history[0][swj-yes]" <?=is_checked("employment_history", '0', "satisfied_with_job", null, 1); ?>/><label for="employment_history[0][swj-yes]">Yes</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="0" id="employment_history[0][swj-no]" <?=is_checked("employment_history", '0', "satisfied_with_job", null, 0); ?>/><label for="employment_history[0][swj-no]">No</label>
            </div>
            <div class="field indented textarea">
              <label>Why or why not satisfied?</label>
              <textarea name="employment_history[0][satisfaction_reason]"><?=set_field_value('employment_history', '0', 'satisfaction_reason', null); ?></textarea>
            </div>
            <div class="field indented">
              <label>Is this your first job?</label>
              <input type="radio" name="employment_history[0][first_job]" value="yes" id="fj-yes" data-behavior="toggle-first-job" <?= (is_checked("employment_history", '0', "first_job", null, 'no') != 'checked') ? 'checked' : ''; ?> /><label for="fj-yes">Yes</label>
              <input type="radio" name="employment_history[0][first_job]" value="no" id="fj-no" data-behavior="toggle-first-job" <?= is_checked("employment_history", '0', "first_job", null, 'no'); ?> /><label for="fj-no">No</label>
            </div>
          </div>
          <?php for ($i = 1; $i < ((isset($post['employment_history'])) ? count($post['employment_history']) : 2); $i++): ?>
            <div class="job-form <?= (is_checked("employment_history", '0', "first_job", null, 'no') == 'checked') ? '' : 'hidden'; ?>" data-job-form="<?= ($i == 1) ? 'first-job' : 'other-job'; ?>">
              <span><?= ($i == 1) ? 'First' : 'Other'; ?> Job Information</span>
              <div class="field indented">
                <label>Were you self-employed?</label>
                <input type="radio" name="employment_history[<?=$i?>][self_employed]" value="1" id="employment_history[<?=$i?>][se-yes]" data-behavior="toggle-self-employed" <?= is_checked("employment_history", $i, "self_employed", null, 1); ?>/><label for="employment_history[1][se-yes]">Yes</label>
                <input type="radio" name="employment_history[<?=$i?>][self_employed]" value="0" id="employment_history[<?=$i?>][se-no]" data-behavior="toggle-self-employed" <?= (is_checked("employment_history", $i, "self_employed", null, 1) != 'checked') ? 'checked' : ''; ?> /><label for="employment_history[1][se-no]">No</label>
              </div>
              <div class="field indented <?= (is_checked("employment_history", $i, "self_employed", null, 1) == 'checked') ? '' : 'hidden'; ?>" data-field="business-name">
                <label>What is your business/work?</label>
                <input type="text" name="employment_history[<?=$i?>][business_name]" value="<?=set_field_value('employment_history', $i, 'business_name', null); ?>"/>
              </div>
              <div class="field indented <?= (is_checked("employment_history", $i, "self_employed", null, 1) != 'checked') ? '' : 'hidden'; ?>" data-field="employer">
                <label>Employer</label>
                <input type="text" name="employment_history[<?=$i?>][employer]" value="<?=set_field_value('employment_history', $i, 'employer', null); ?>"/>
              </div>
              <div class="field indented">
                <label>Employer/Business Type</label>
                <select name="employment_history[<?=$i?>][employer_type]" class="specifiable">
                  <?php foreach ($employer_types as $type) { ?>
                    <option value="<?=$type->id?>" <?=is_selected('employment_history', $i, 'employer_type', null, $type->id);?>><?=$type->name?></option>
                  <?}?> 
                  <option value="others">Others</option>
                </select>
                <input type="text" name="employment_history[<?=$i?>][specified_employer_type]" placeholder="Employer/Business Type" class="hidden" value="<?=set_field_value('employment_history', $i, 'specified_employer_type', null); ?>"/>
              </div>
              <div class="field indented">
                <label>Job Title/Position</label>
                <input type="text" name="employment_history[<?=$i?>][job_title]" value="<?=set_field_value('employment_history', $i, 'job_title', null); ?>"/>
              </div>
              <div class="field indented">
                <label>Monthly Salary (in Philippine Peso)</label>
                <select name="employment_history[<?=$i?>][monthly_salary]">
                  <?php foreach ($salaries as $val) : ?>
                    <option value="<?=$val->id?>" <?=is_selected('employment_history', $i, 'monthly_salary', null, $val->id)?>>
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
              <div class="field indented">
                <label>Employment Duration</label>
                <select name="employment_history[<?=$i?>][employment_duration][start_year]" class="narrow">
                  <?php 
                    $year = date('Y');
                    while ($year >= 1980) { 
                  ?>
                    <option value="<?=$year?>" <?=is_selected('employment_history', $i, 'employment_duration', 'start_year', $year)?>><?=$year?></option>
                  <?    
                      $year--;
                    } 
                  ?>   
                </select>
                <i>to</i>
                <select name="employment_history[<?=$i?>][employment_duration][end_year]" class="narrow">
                  <option value="100000" <?=is_selected('employment_history', $i, 'employment_duration', 'end_year', '100000')?>>ongoing</option>
                  <?php 
                    $year = date('Y');
                    while ($year >= 1980) { 
                  ?>
                    <option value="<?=$year?>" <?=is_selected('employment_history', $i, 'employment_duration', 'end_year', $year)?>><?=$year?></option>
                  <?    
                      $year--;
                    } 
                  ?>   
                </select>
              </div>
              <div class="field indented">
                <label>Satisfied with this job?</label>
                <input type="radio" name="employment_history[<?=$i?>][satisfied_with_job]" value="1" id="employment_history[<?=$i?>][swj-yes]" <?=is_checked("employment_history", $i, "satisfied_with_job", null, 1); ?>/><label for="employment_history[1][swj-yes]">Yes</label>
                <input type="radio" name="employment_history[<?=$i?>][satisfied_with_job]" value="0" id="employment_history[<?=$i?>][swj-no]" <?=is_checked("employment_history", $i, "satisfied_with_job", null, 0); ?>/><label for="employment_history[1][swj-no]">No</label>
              </div>
              <div class="field indented textarea">
                <label>Why or why not satisfied?</label>
                <textarea name="employment_history[<?=$i?>][satisfaction_reason]"><?=set_field_value('employment_history', $i, 'satisfaction_reason', null);?></textarea>
              </div>
            </div>
          <?php endfor; ?>
          <div class="field indented <?= (is_checked("employment_history", '0', "first_job", null, 'no') == 'checked') ? '' : 'hidden'; ?>" data-field="another-job">
            <label>Did you have another job?</label>
            <input type="radio" value="yes" id="aj-yes" data-behavior="add-another-job" /><label for="aj-yes">Yes</label>
            <input type="radio" value="no" id="aj-no" data-behavior="add-another-job" checked /><label for="aj-no">No</label>
          </div>
          <div class="field actions">
            <input type="button" value="Back" class="button back" />
            <input type="button" value="Continue" class="button continue" />
          </div>
        </div>
      <?= form_close(); ?>

      <?= form_open('#'); ?>
        <div class="slide hidden" data-name="others">
          <h1>Others</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>Is any of your jobs related to the degree program you finished?</label>
            <em>(examples of degree programs: BS Mathematics, BS Computer Science, etc)</em>
            <input type="radio" name="others[jobs_related]" value="yes" id="jr_yes" /><label for="jr_yes">Yes</label>
            <input type="radio" name="others[jobs_related]" value="no" id="jr_no" checked /><label for="jr_no">No</label>
          </div>
          <?php $show_other_fields = false; ?>
          <div class="field <?= ($show_other_fields) ? '' : 'hidden'; ?>">
            <label>What courses did you take in the curriculum that are/were useful in your job?</label>
            <em>(examples of courses: MATH17, CMSC11, etc)</em>
            <textarea name="others[useful_courses]"></textarea>
            <em>(courses must be separated by comma)</em>
          </div>
          <div class="field <?= ($show_other_fields) ? '' : 'hidden'; ?>">
            <label>What courses would you suggest that are useful in the curriculum but are not offered in your program?</label>
            <textarea name="others[course_suggestions]"></textarea>
            <em>(course suggestions must be separated by comma)</em>
          </div>
          <div class="field <?= ($show_other_fields) ? '' : 'hidden'; ?>">
            <label>What GE/RGEP courses did you find useful in your job?</label>
            <? foreach ($ge_courses as $var) : ?>
              <div class="course">
                <input type="checkbox" name="others[useful_ge][<?=$var->id?>]" value="<?=$var->code?>" id="ug-<?=$var->id?>" />
                <label for="ug-<?=$var->id?>">
                  <p><?=$var->code?></p>
                  <p><?=$var->name?></p>
                  <span><?=$var->description?></span>
                </label>
              </div>
            <? endforeach; ?>
          </div>
          <div class="field actions">
            <input type="button" value="Back" class="button back" />
            <input type="submit" value="Submit Answers" class="button" />
            <em>Please review your answers before submitting the form</em>
          </div>
        </div>
      <?= form_close(); ?>      
    </div>
  </div>
</body>
</html>