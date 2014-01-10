<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/reset.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/fonts.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/application.css'; ?>" />
  <link rel="stylesheet" href="<?= base_url() . 'assets/stylesheets/pages.css'; ?>" />
  <script src="<?= base_url() . 'assets/javascripts/jquery-2.js'; ?>"></script>
  <script src="<?= base_url() . 'assets/javascripts/application.js'; ?>"></script>
  <title>Alumni Tracker</title>
</head>

<body class="pages index">
  <a href="#" id="sign-in">Sign In</a>
  <?= anchor('session/index', 'Sign In', array('id' => 'sign-in'));?>
  <h1 id="site-logo">Alumni Tracker</h1>
  <p>Clicking on the button below means that you really are an alumni of the University of the Philippines Cebu and that you are willing to provide the information asked for.</p>  
  <?= anchor('home/questionnaire', 'Proceed to Questionnaire', array('class' => 'button')); ?>
</body>
</html>