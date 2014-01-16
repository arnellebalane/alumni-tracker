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
        <?= anchor('#', 'Discard', array('class' => 'red')); ?>
      </div>

      <section id="personal-information">
        <h3>Personal Information</h3>
        <div class="field">
          <label>First Name</label>
          <h4>Arnelle</h4>
        </div>
        <div class="field">
          <label>Last Name</label>
          <h4>Balane</h4>
        </div>
        <div class="field">
          <label>Gender</label>
          <h4>Male</h4>
        </div>
        <div class="field">
          <label>Present Address</label>
          <h4>Cebu City</h4>
        </div>
        <div class="field">
          <label>Contact Number in Present Address</label>
          <h4>09496547250</h4>
        </div>
        <div class="field">
          <label>Permanent Address</label>
          <h4>Tagbilaran City</h4>
        </div>
        <div class="field">
          <label>Contact Number in Permanent Address</label>
          <h4>09496547250</h4>
        </div>
        <div class="field">
          <label>Email Address</label>
          <h4>arnellebalane@gmail.com</h4>
        </div>
        <span>Social Network Contact Information</span>
        <div class="field indented">
          <label>Facebook</label>
          <h4>Arnelle Balane</h4>
        </div>
        <div class="field indented">
          <label>Twitter</label>
          <h4>arnellebalane</h4>
        </div>
      </section>

      <section id="educational-background">
        <h3>Educational Background</h3>
        <div class="field">
          <label>Student Number</label>
          <h4>2011-37575</h4>
        </div>
        <div class="field">
          <label>Degree Program</label>
          <h4>BS Computer Science</h4>
        </div>
        <div class="field">
          <label>Semester/Summer and Year Graduated</label>
          <h4>2nd Semester, AY 2013 - 2014</h4>
        </div>
        <div class="field">
          <label>Honor Received</label>
          <h4>None</h4>
        </div>
      </section>

      <section id="employment-history">
        <h3>Employment History</h3>
        <div class="job">
          <div class="field">
            <label>Self-employed?</label>
            <h4>No</h4>
          </div>
          <div class="field">
            <label>Employer</label>
            <h4>Insert Company Name Here</h4>
          </div>
          <div class="field">
            <label>Employer/Business Type</label>
            <h4>IT Company</h4>
          </div>
          <div class="field">
            <label>Job Title/Position</label>
            <h4>Developer</h4>
          </div>
          <div class="field">
            <label>Monthly Salary (in Philippine Peso)</label>
            <h4>10,000 and below</h4>
          </div>
          <div class="field">
            <label>Employment Duration</label>
            <h4>2014 - ongoing</h4>
          </div>
          <div class="field">
            <label>Satisfied with job?</label>
            <h4>Yes</h4>
          </div>
          <div class="field">
            <label>Why or why not satisfied?</label>
            <h4>Lorem ipsum Nulla Excepteur dolore exercitation cupidatat tempor tempor velit dolore laborum Excepteur non.</h4>
          </div>
        </div>

        <div class="job">
          <div class="field">
            <label>Self-employed?</label>
            <h4>No</h4>
          </div>
          <div class="field">
            <label>Employer</label>
            <h4>Insert Company Name Here</h4>
          </div>
          <div class="field">
            <label>Employer/Business Type</label>
            <h4>IT Company</h4>
          </div>
          <div class="field">
            <label>Job Title/Position</label>
            <h4>Developer</h4>
          </div>
          <div class="field">
            <label>Monthly Salary (in Philippine Peso)</label>
            <h4>10,000 and below</h4>
          </div>
          <div class="field">
            <label>Employment Duration</label>
            <h4>2014 - ongoing</h4>
          </div>
          <div class="field">
            <label>Satisfied with job?</label>
            <h4>Yes</h4>
          </div>
          <div class="field">
            <label>Why or why not satisfied?</label>
            <h4>Lorem ipsum Nulla Excepteur dolore exercitation cupidatat tempor tempor velit dolore laborum Excepteur non.</h4>
          </div>
        </div>
      </section>

      <section id="others">
        <h3>Others</h3>
        <div class="field">
          <label>Is any of your jobs related to the degree program you finished?</label>
          <h4>Yes</h4>
        </div>
        <div class="field">
          <label>What courses did you take in your curriculum that are/were useful in your job?</label>
          <h4>CMSC 11, CMSC 21, CMSC 123</h4>
        </div>
        <div class="field">
          <label>What courses would you suggest that are useful in the curriculum but are not offered in your program?</label>
          <h4>Course1, Course 2, Course 3</h4>
        </div>
        <div class="field">
          <label>What GE/RGEP courses did you find useful in your job?</label>
          <h4>Nat Sci 1, Envi Sci 1</h4>
        </div>
        <div class="field">
          <label></label>
          <h4></h4>
        </div>
      </section>


      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
      <div class="field">
        <label></label>
        <h4></h4>
      </div>
    </div>
  </div>
</body>
</html>