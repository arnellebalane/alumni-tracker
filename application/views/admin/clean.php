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
        <?= anchor('alumni/deleteAlumni/'.$user_id, 'Discard', array('class' => 'red')); ?>
      </div>

      <?= form_open('#'); ?>
        <section id="personal-information">
          <h3>Personal Information</h3>
          <div class="field">
            <label>First Name</label>
            <h4><?=humanize($user_info[0]->firstname)?></h4>
            <div class="editable hidden">
              <input type="text" name="firstname" value="<?=humanize($user_info[0]->firstname)?>" data-current="<?=humanize($user_info[0]->firstname)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Last Name</label>
            <h4><?=humanize($user_info[0]->lastname)?></h4>
            <div class="editable hidden">
              <input type="text" name="lastname" value="<?=humanize($user_info[0]->lastname)?>" data-current="<?=humanize($user_info[0]->lastname)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Gender</label>
            <h4><?=humanize($user_info[0]->gender)?></h4>
            <div class="editable hidden">
              <label><input type="radio" name="gender" value="male" data-current="<?=is_checked("male",$user_info[0]->gender)?>" <?=is_checked("male",$user_info[0]->gender)?> />Male</label>
              <label><input type="radio" name="gender" value="female" data-current="<?=is_checked("female",$user_info[0]->gender)?>" <?=is_checked("female",$user_info[0]->gender)?>/>Female</label>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Present Address</label>
            <h4><?=humanize($user_info[0]->present_address)?></h4>
            <div class="editable hidden">
              <input type="text" name="present_address" value="<?=humanize($user_info[0]->present_address)?>" data-current="<?=humanize($user_info[0]->present_address)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <h4><?=humanize($user_info[0]->present_contact_number)?></h4>
            <div class="editable hidden">
              <input type="text" name="present_address_contact_number" value="<?=humanize($user_info[0]->present_contact_number)?>" data-current="<?=humanize($user_info[0]->present_contact_number)?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <h4><?=$user_info[0]->premanent_address?></h4>
            <div class="editable hidden">
              <input type="text" name="permanent_address" value="<?=$user_info[0]->premanent_address?>" data-current="<?=$user_info[0]->premanent_address?>" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <h4>09496547250</h4>
            <div class="editable hidden">
              <input type="text" name="permanent_address_contact_number" value="09496547250" data-current="09496547250" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Email Address</label>
            <h4>arnellebalane@gmail.com</h4>
            <div class="editable hidden">
              <input type="text" name="email_address" value="arnellebalane@gmail.com" data-current="arnellebalane@gmail.com" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <span>Social Network Contact Information</span>
          <div class="field indented">
            <label>Facebook</label>
            <h4>Arnelle Balane</h4>
            <div class="editable hidden">
              <input type="text" name="social_networks[1]" value="Arnelle Balane" data-current="Arnelle Balane" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field indented">
            <label>Twitter</label>
            <h4>arnellebalane</h4>
            <div class="editable hidden">
              <input type="text" name="social_networks[2]" value="arnellebalane" data-current="arnellebalane" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
        </section>

        <section id="educational-background">
          <h3>Educational Background</h3>
          <div class="field">
            <label>Student Number</label>
            <h4>2011-37575</h4>
            <div class="editable hidden">
              <input type="text" name="student_number" value="2011-37575" data-current="2011-37575" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h4>BS Computer Science</h4>
            <div class="editable hidden">
              <select name="degree_program" data-current="1">
                <option value="1">BS Computer Science</option>
                <option value="2">BS Mathematics</option>
                <option value="3">BS Biology</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <h4>2nd Semester, AY 2013 - 2014</h4>
            <div class="editable hidden">
              <select name="graduated[semester]" class="auto" data-current="2nd-semester">
                <option value="1st-semester">1st Semester</option>
                <option value="2nd-semester" selected>2nd Semester</option>
                <option value="summer">Summer</option>
              </select>
              <select name="graduated[academic_year]" class="auto" data-current="2013-2014">
                <option value="2013-2014" selected>2013-2014</option>
                <option value="2012-2013">2012-2013</option>
                <option value="2011-2012">2011-2012</option>
                <option value="2010-2011">2010-2011</option>
                <option value="2009-2010">2009-2010</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <h4>None</h4>
            <div class="editable hidden">
              <select name="honor_received" data-current="none">
                <option value="summa-cum-laude">Summa Cum Laude</option>
                <option value="magna-cum-laude">Magna Cum Laude</option>
                <option value="cum-laude">Cum Laude</option>
                <option value="none" selected>None</option>
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