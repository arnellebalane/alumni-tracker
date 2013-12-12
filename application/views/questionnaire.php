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

<body class="questionnaire index">
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li class="current visited">Personal Information</li>
        <li>Educational Background</li>
        <li>Employment History</li>
        <li>Others</li>
      </ul>
    </aside>

    <div class="content">
      <?=form_open('alumni/add','POST')?>
        <div class="slide current" data-name="personal-information">
          <h1>Personal Information</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>First Name</label>
            <input type="text" name="personal_information[firstname]" />
          </div>
          <div class="field">
            <label>Last Name</label>
            <input type="text" name="personal_information[lastname]" />
          </div>
          <div class="field">
            <label>Gender</label>
            <input type="radio" name="personal_information[gender]" value="male" id="g-male" /><label for="g-male">Male</label>
            <input type="radio" name="personal_information[gender]" value="female" id="g-female" /><label for="g-female">Female</label>
          </div>
          <div class="field">
            <label>Present Address</label>
            <input type="text" name="personal_information[present_address]" />
          </div>
          <div class="field">
            <label>Country/State of Present Address</label>
            <select name="personal_information[country]" class="specifiable">
              <?foreach ($countries as $var) : ?>
                <option value="<?=$var->id?>"><?=$var->name?></option>
              <? endforeach; ?>              
              <option value="others">Others</option>
            </select>
            <input type="text" name="personal_information[specified_country]" placeholder="Country/State of Present Address" />
          </div>
          <div class="field">
            <label>Contact Number in Present Address</label>
            <input type="text" name="personal_information[present_address_contact_number]" />
          </div>
          <div class="field">
            <label>Permanent Address</label>
            <input type="text" name="personal_information[permanent_address]" />
          </div>
          <div class="field">
            <label>Contact Number in Permanent Address</label>
            <input type="text" name="personal_information[permanent_address_contact_number]" />
          </div>
          <div class="field">
            <label>Email Address</label>
            <input type="email" name="personal_information[email_address]" />
          </div>
          <span>Social Network Contact Information</span>
          <div class="field indented">
            <label>Facebook Account</label>
            <input type="text" name="personal_information[social_networks][facebook]" />
          </div>
          <div class="field indented">
            <label>Twitter Account</label>
            <input type="text" name="personal_information[social_networks][twitter]" />
          </div>
          <div class="field actions">
            <input type="button" value="Continue" class="button continue" />
          </div>
        </div>

        <div class="slide hidden" data-name="educational-background">
          <h1>Educational Background</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>Student Number</label>
            <input type="text" name="educational_background[student_number]" />
          </div>
          <div class="field">
            <label>Degree Program</label>
            <select name="educational_background[degree_program]">
              <?foreach ($programs as $var) : ?>
                <option value="<?=$var->id?>"><?=$var->name?></option>
              <? endforeach;?>              
            </select>
          </div>
          <div class="field">
            <label>Semester/Summer and Year Graduated</label>
            <select name="educational_background[graduated][semester]">
              <option value="1">1st Semester</option>
              <option value="2">2nd Semester</option>
              <option value="3">Summer</option>
            </select>
            <select name="educational_background[graduated][academic_year]">
              <? $ctr = date('Y');
                while ($ctr > 1980) { 
              ?>
                <option value="<?echo ($ctr-1).'-'.$ctr;?>"><?echo ($ctr-1).' - '.$ctr;?></option>
              <? $ctr--;
                }
              ?>                            
            </select>
          </div>
          <div class="field">
            <label>Honor Received</label>
            <select name="educational_background[honor_received]">
              <option value="summa cum laude">Summa Cum Laude</option>
              <option value="magna cum laude">Magna Cum Laude</option>
              <option value="cum laude">Cum Laude</option>
              <option value="none" selected>None</option>
            </select>
          </div>
          <div class="field actions">
            <input type="button" value="Back" class="button back" />
            <input type="button" value="Continue" class="button continue" />
          </div>
        </div>

        <div class="slide hidden" data-name="employment-history">
          <h1>Employment History</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="job-form" data-job-form="current-job">
            <span>Current Job Information</span>
            <div class="field indented">
              <label>Are you self-employed?</label>
              <input type="radio" name="employment_history[0][self_employed]" value="yes" id="employment_history[0][se-yes]" data-behavior="toggle-self-employed" /><label for="employment_history[0][se-yes]">Yes</label>
              <input type="radio" name="employment_history[0][self_employed]" value="no" id="employment_history[0][se-no]" data-behavior="toggle-self-employed" checked /><label for="employment_history[0][se-no]">No</label>
            </div>
            <div class="field indented hidden" data-field="business-name">
              <label>What is your business/work?</label>
              <input type="text" name="employment_history[0][business_name]" />
            </div>
            <div class="field indented" data-field="employer">
              <label>Employer</label>
              <input type="text" name="employment_history[0][employer]" />
            </div>
            <div class="field indented">
              <label>Employer/Business Type</label>
              <select name="employment_history[0][employer_type]" class="specifiable">
                <option value="1">IT Industry</option>
                <option value="2">Business Process Outsourcing (BPO) - Voice</option>
                <option value="3">Business Process Outsourcing (BPO) - Non-Voice</option>
                <option value="4">Bank</option>
                <option value="5">Academe</option>
                <option value="6">Health</option>
                <option value="7">TV Stations/Radio Stations/Newspaper Company</option>
                <option value="8">Law Firm</option>
                <option value="9">Government Agencies (e.g. NGO, GSIS, SSS, NEDA, etc.)</option>
                <option value="10">Hospital</option>
                <option value="others">Others</option>
              </select>
              <input type="text" name="employment_history[0][specified_employer_type]" placeholder="Employer/Business Type" />
            </div>
            <div class="field indented">
              <label>Job Title/Position</label>
              <input type="text" name="employment_history[0][job_title]" />
            </div>
            <div class="field indented">
              <label>Monthly Salary (in Philippine Peso)</label>
              <select name="employment_history[0][monthly_salary]">
                <option value="1">10,000 and below</option>
                <option value="2">10,001 - 20,000</option>
                <option value="3">20,001 - 30,000</option>
                <option value="4">30,001 - 40,000</option>
                <option value="5">40,001 - 50,000</option>
                <option value="6">50,001 - 60,000</option>
                <option value="7">60,001 - 100,000</option>
                <option value="8">100,001 and above</option>
              </select>
            </div>
            <div class="field indented">
              <label>Employment Duration</label>
              <select name="employment_history[0][employment_duration][start_year]" class="narrow">
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
              </select>
              <i>to</i>
              <select name="employment_history[0][employment_duration][end_year]" class="narrow">
                <option value="ongoing">ongoing</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
              </select>
            </div>
            <div class="field indented">
              <label>Satisfied with this job?</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="yes" id="employment_history[0][swj-yes]" /><label for="employment_history[0][swj-yes]">Yes</label>
              <input type="radio" name="employment_history[0][satisfied_with_job]" value="no" id="employment_history[0][swj-no]" /><label for="employment_history[0][swj-no]">No</label>
            </div>
            <div class="field indented textarea">
              <label>Why or why not satisfied?</label>
              <textarea name="employment_history[0][satisfaction_reason]"></textarea>
            </div>
            <div class="field indented">
              <label>Is this your first job?</label>
              <input type="radio" name="employment_history[0][first_job]" value="yes" id="fj-yes" data-behavior="toggle-first-job" /><label for="fj-yes">Yes</label>
              <input type="radio" name="employment_history[0][first_job]" value="no" id="fj-no" data-behavior="toggle-first-job" /><label for="fj-no">No</label>
            </div>
          </div>
          <div class="job-form hidden" data-job-form="first-job">
            <span>First Job Information</span>
            <div class="field indented">
              <label>Were you self-employed?</label>
              <input type="radio" name="employment_history[1][self_employed]" value="yes" id="employment_history[1][se-yes]" data-behavior="toggle-self-employed" /><label for="employment_history[1][se-yes]">Yes</label>
              <input type="radio" name="employment_history[1][self_employed]" value="no" id="employment_history[1][se-no]" data-behavior="toggle-self-employed" checked /><label for="employment_history[1][se-no]">No</label>
            </div>
            <div class="field indented hidden" data-field="business-name">
              <label>What is your business/work?</label>
              <input type="text" name="employment_history[1][business_name]" />
            </div>
            <div class="field indented" data-field="employer">
              <label>Employer</label>
              <input type="text" name="employment_history[1][employer]" />
            </div>
            <div class="field indented">
              <label>Employer/Business Type</label>
              <select name="employment_history[1][employer_type]" class="specifiable">
                <option value="1">IT Industry</option>
                <option value="2">Business Process Outsourcing (BPO) - Voice</option>
                <option value="3">Business Process Outsourcing (BPO) - Non-Voice</option>
                <option value="4">Bank</option>
                <option value="5">Academe</option>
                <option value="6">Health</option>
                <option value="7">TV Stations/Radio Stations/Newspaper Company</option>
                <option value="8">Law Firm</option>
                <option value="9">Government Agencies (e.g. NGO, GSIS, SSS, NEDA, etc.)</option>
                <option value="10">Hospital</option>
                <option value="others">Others</option>
              </select>
              <input type="text" name="employment_history[1][specified_employer_type]" placeholder="Employer/Business Type" />
            </div>
            <div class="field indented">
              <label>Job Title/Position</label>
              <input type="text" name="employment_history[1][job_title]" />
            </div>
            <div class="field indented">
              <label>Monthly Salary (in Philippine Peso)</label>
              <select name="employment_history[1][monthly_salary]">
                <option value="1">10,000 and below</option>
                <option value="2">10,001 - 20,000</option>
                <option value="3">20,001 - 30,000</option>
                <option value="4">30,001 - 40,000</option>
                <option value="5">40,001 - 50,000</option>
                <option value="6">50,001 - 60,000</option>
                <option value="7">60,001 - 100,000</option>
                <option value="8">100,001 and above</option>
              </select>
            </div>
            <div class="field indented">
              <label>Employment Duration</label>
              <select name="employment_history[1][employment_duration][start_year]" class="narrow">
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
              </select>
              <i>to</i>
              <select name="employment_history[1][employment_duration][end_year]" class="narrow">
                <option value="ongoing">ongoing</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
              </select>
            </div>
            <div class="field indented">
              <label>Satisfied with this job?</label>
              <input type="radio" name="employment_history[1][satisfied_with_job]" value="yes" id="employment_history[1][swj-yes]" /><label for="employment_history[1][swj-yes]">Yes</label>
              <input type="radio" name="employment_history[1][satisfied_with_job]" value="no" id="employment_history[1][swj-no]" /><label for="employment_history[1][swj-no]">No</label>
            </div>
            <div class="field indented textarea">
              <label>Why or why not satisfied?</label>
              <textarea name="employment_history[1][satisfaction_reason]"></textarea>
            </div>
          </div>
          <div class="field indented hidden" data-field="another-job">
            <label>Did you have another job?</label>
            <input type="radio" value="yes" id="aj-yes" data-behavior="add-another-job" /><label for="aj-yes">Yes</label>
            <input type="radio" value="no" id="aj-no" data-behavior="add-another-job" checked /><label for="aj-no">No</label>
          </div>
          <div class="field actions">
            <input type="button" value="Back" class="button back" />
            <input type="button" value="Continue" class="button continue" />
          </div>
        </div>

        <div class="slide hidden" data-name="others">
          <h1>Others</h1>
          <p>Rest assured that these information will be treated with high confidentiality.</p>

          <div class="field">
            <label>Is any of your jobs related to the degree program you finished?</label>
            <em>(examples of degree programs: BS Mathematics, BS Computer Science, etc)</em>
            <input type="radio" name="others[jobs_related]" value="yes" id="jr_yes" /><label for="jr_yes">Yes</label>
            <input type="radio" name="others[jobs_related]" value="no" id="jr_no" /><label for="jr_no">No</label>
          </div>
          <div class="field">
            <label>What courses did you take in the curriculum that are/were useful in your job?</label>
            <em>(examples of courses: MATH17, CMSC11, etc)</em>
            <textarea name="others[useful_courses]"></textarea>
            <em>(courses must be separated by comma)</em>
          </div>
          <div class="field">
            <label>What courses would you suggest that are useful in the curriculum but are not offered in your program?</label>
            <textarea name="others[course_suggestions]"></textarea>
            <em>(course suggestions must be separated by comma)</em>
          </div>
          <div class="field">
            <label>What GE/RGEP courses did you find useful in your job?</label>
            <div class="course">
              <input type="checkbox" name="others[useful_ge][0]" value="envi10" id="ug-envi10" />
              <label for="ug-envi10">
                <p>Envi 10</p>
                <p>Environmental Science</p>
                <span>Lorem ipsum Velit aliquip Ut in est eu enim exercitation deserunt ut dolor eiusmod officia nostrud minim.</span>
              </label>
            </div>
            <div class="course">
              <input type="checkbox" name="others[useful_ge][1]" value="natsci1" id="ug-natsci1" />
              <label for="ug-natsci1">
                <p>Nat Sci 1</p>
                <p>Natural Science 1</p>
                <span>Lorem ipsum Aliquip culpa qui aliquip dolore minim incididunt fugiat in culpa ad id reprehenderit enim adipisicing ullamco.</span>
              </label>
            </div>
          </div>
          <div class="field actions">
            <input type="button" value="Back" class="button back" />
            <input type="submit" value="Submit Answers" class="button" />
            <em>Please review your answers before submitting the form</em>
          </div>
        </div>
        <?=form_close();?>      
    </div>
  </div>
</body>
</html>