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

<body class="admin index">
  <div class="wrapper clearfix">
    <aside>
      <ul>
        <li><a href="#" class="current">Questionnaire Data</a></li>
      </ul>
    </aside>

    <div class="content">
      <h1>Manage Questionnaire Data</h1>
      <p>These data are the ones which will appear as choices in some parts of the questionnaire.</p>

      <section>
        <h1>Countries</h1>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <h3>Philippines<a href="#">[Remove]</a></h3>
        <form>
          <h4>Add Another Country</h4>
          <label>Country Name</label>
          <input type="text" name="country_name" />
          <input type="submit" value="Submit" class="button" />
        </form>
      </section>
    </div>
  </div>
</body>
</html>