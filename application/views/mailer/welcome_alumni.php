<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Welcome to Alumni Tracker</title>
  <style>
    html {
      font-size: 62.5%;
    }

    body {
      background: #eeeeee;
    }

    .content {
      width: 500px;
      padding: 50px;
      background-color: #ffffff;
      margin: 0 auto;
      border-top: 3px solid #399B28;
      border-radius: 0 0 3px 3px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
    }

    h1 {
      font: bold 1.4rem "Arial";
      color: #222222;
      margin: 0 0 25px 0;
    }

    p {
      font: normal 1.4rem "Arial";
      color: #333333;
      margin: 0 0 10px 0;
    }

    a {
      display: block;
    }

    section {
      margin: 15px 0 15px 25px;
    }

    section p {
      margin: 0;
    }

    section span {
      display: inline-block;
      width: 100px;
    }

    footer {
      margin-top: 25px;
    }

    footer p {
      margin: 0;
    }
  </style>
</head>

<body>
  <div class="content">
    <h1>Hi, [insert full name here]!</h1>
    <p>Thank you for the personal information that you submitted to Alumni Tracker. Please rest assured that these information will be treated with high confidentiality.</p>
    <p>If you want to make changes to the personal information that you submitted, you may login to your alumni account through this link: <a href="http://localhost/alumni-tracker/index.php/session/index">Alumni Tracker account login</a></p>
    <p>Your login information can be found below:</p>
    <section>
      <p><span>Username:</span>[insert username here]</p>
      <p><span>Password:</span>[insert password here]</p>
    </section>
    <p>Please change your account password upon logging in.</p>
    <footer>
      <p>Best Regards,</p>
      <p><em>Alumni Tracker Team</em></p>
    </footer>
  </div>
</body>
</html>