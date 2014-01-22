<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/enumerator.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>.js"></script>
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
      <h1>Arnelle Balane</h1>
      <div class="clean-actions">
        <?= anchor('#', 'Mark as Clean', array('class' => 'green')); ?>
        <?= anchor('#', 'Discard', array('class' => 'red')); ?>

        <?= anchor('#', 'Previous Alumni', array('class' => 'navigation')); ?>
        <?= anchor('#', 'Next Alumni', array('class' => 'navigation')); ?>
      </div>

      <?= form_open('#'); ?>
        <section id="personal-information">
          <h3>Personal Information</h3>
          <div class="field">
            <label>First Name</label>
            <h4>Arnelle</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[firstname]" value="Arnelle" data-current="Arnelle" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Last Name</label>
            <h4>Balane</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[lastname]" value="Balane" data-current="Balane" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field radio">
            <label>Gender</label>
            <h4>Male</h4>
            <div class="editable hidden">
              <label><input type="radio" name="personal_information[gender]" value="male" data-current="true" checked />Male</label>
              <label><input type="radio" name="personal_information[gender]" value="female" data-current="false" />Female</label>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Present Address</label>
            <h4>Cebu City</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[present_address]" value="Cebu City" data-current="Cebu City" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Country/State of Present Address</label>
            <h4>Philippines</h4>
            <div class="editable hidden">
              <select name="personal_information[country]" data-current="1">
                <option value="1" selected>A</option>
                <option value="2">B</option>
                <option value="3">C</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <h4>12345</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[present_address_contact_number]" value="12345" data-current="12345" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <h4>Tagbilaran City</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[permanent_address]" value="Tagbilaran City" data-current="Tagbilaran City" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <h4>12345</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[permanent_address_contact_number]" value="12345" data-current="12345" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Email Address</label>
            <h4>arnellebalane@gmail.com</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[email_address]" value="arnellebalane@gmail.com" data-current="arnellebalane@gmail.com" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <span>Social Network Contact Information</span>
          <div class="field indented">
            <label>Facebook</label>
            <h4>Arnelle Balane</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[social_networks][1]" value="Arnelle Balane" data-current="Arnelle Balane" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field indented">
            <label>Twitter</label>
            <h4>arnellebalane</h4>
            <div class="editable hidden">
              <input type="text" name="personal_information[social_networks][2]" value="arnellebalane" data-current="arnellebalane" />
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
              <input type="text" name="educational_background[student_number]" value="2011-37575" data-current="2011-37575" />
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Degree Program</label>
            <h4>BS Computer Science</h4>
            <div class="editable hidden">
              <select name="educational_background[degree_program]" data-current="1">
                <option value="1" selected>A</option>
                <option value="2">B</option>
                <option value="3">C</option>
              </select>              
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <h4>2nd Semester</h4>
            <div class="editable hidden">
              <select name="educational_background[graduated][semester]" class="auto" data-current="1">
                <option value="1" selected>1st Semester</option>
                <option value="2">2nd Semester</option>
                <option value="3">Summer</option>
              </select>
              <select name="educational_background[graduated][academic_year]" class="auto" data-current="1">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <h4>None</h4>
            <div class="editable hidden">
              <select name="educational_background[honor_received]" data-current="none">
                <option value="none" selected>None</option>
                <option value="summa cum laude">Summa Cum Laude</option>
                <option value="magna cum laude">Magna Cum Laude</option>
                <option value="cum laude">Cum Laude</option>              
              </select>
            </div>
            <a href="#" data-behavior="edit">[edit]</a>
          </div>
        </section>

        <section id="employment-history">
          <h3>Employment History</h3>
          <input type="button" value="Add Another Job" data-behavior="add-another-job" />

          <div class="job">
            <?php $job_text = 'Current Job'; ?>
            <h4><?= $job_text . anchor('', '[Delete this Job]'); ?></h4>
            <div class="field radio">
              <label>Self-employed?</label>
              <h4>Yes</h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[0][self_employed]" value="1" data-current="true" checked>Yes</label>
                <label><input type="radio" name="jobs[0][self_employed]" value="0" data-current="false">No</label>
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
              <h4>IT Industry</h4>
              <div class="editable hidden">
                <select name="jobs[0][employer_type]" data-current="1">
                  <option value="1" selected>A</option>
                  <option value="2">B</option>
                  <option value="3">C</option>
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
                    <option value="1" selected>A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Employment Duration</label>
              <h4>2014 - ongoing</h4>
              <div class="editable hidden">
                <select name="jobs[0][employment_duration][start_year]" class="auto" data-current="1">
                  <option value="1" selected>A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                </select>
                <span>to</span>
                <select name="jobs[0][employment_duration][end_year]" class="auto" data-current="1">
                  <option value="1" selected>A</option>
                  <option value="2">B</option>
                  <option value="3">C</option>
                </select>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field radio">
              <label>Satisfied with job?</label>
              <h4>Yes</h4>
              <div class="editable hidden">
                <label><input type="radio" name="jobs[0][satisfied_with_job]" value="1" data-current="true" checked />Yes</label>
                <label><input type="radio" name="jobs[0][satisfied_with_job]" value="0" data-current="false" />No</label>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
            <div class="field">
              <label>Why or why not satisfied?</label>
              <h4>Lorem ipsum Ut occaecat consectetur amet deserunt labore adipisicing ad dolor esse tempor sunt esse.</h4>
              <div class="editable hidden">
                <textarea name="jobs[0][satisfaction_reason]" data-current="...">...</textarea>
              </div>
              <a href="#" data-behavior="edit">[edit]</a>
            </div>
          </div>
        </section>

        <input type="submit" value="Save Changes" class="button" />
      <?= form_close(); ?>

      <div class="hidden" id="job-form-template">
        <div class="field unindented inline">
          <label>Another Job Information<a href="#" data-behavior="discard-another-job">[Delete this Job]</a></label>
          <input type="checkbox" name="another_job[{{index}}][current_job]" /><label>Current Job</label>
          <input type="checkbox" name="another_job[{{index}}][current_job]" /><label>First Job</label>
        </div>
        <div class="field inline">
          <label>Self-employed?</label>
          <input type="radio" name="another_job[{{index}}][self_employed]" value="yes" data-behavior="toggle-self-employed" /><label>Yes</label>
          <input type="radio" name="another_job[{{index}}][self_employed]" value="no" data-behavior="toggle-self-employed" checked /><label>No</label>
        </div>
        <div class="field hidden" data-field="business">
          <label>Business</label>
          <input type="text" name="another_job[{{index}}][business]" />
        </div>
        <div class="field" data-field="employer">
          <label>Employer</label>
          <input type="text" name="another_job[{{index}}][employer]" />
        </div>
        <div class="field">
          <label>Employer/Business Type</label>
          <select name="another_job[{{index}}][business_type]">
            <option>A</option>
            <option>B</option>
            <option>C</option>
          </select>
        </div>
        <div class="field">
          <label>Job Title/Position</label>
          <input type="text" name="another_job[{{index}}][job_title]" />
        </div>
        <div class="field">
          <label>Monthly Salary (in Philippine Peso)</label>
          <select name="another_job[{{index}}][monthly_salary]">
            <option>A</option>
            <option>B</option>
            <option>C</option>
          </select>
        </div>
        <div class="field">
          <label>Employment Duration</label>
          <select name="another_job[{{index}}][employment_duration][start_year]" class="auto">
            <option>A</option>
            <option>B</option>
            <option>C</option>
          </select>
          <span>to</span>
          <select name="another_job[{{index}}][employment_duration][end_year]" class="auto">
            <option>A</option>
            <option>B</option>
            <option>C</option>
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
  </div>
</body>
</html>