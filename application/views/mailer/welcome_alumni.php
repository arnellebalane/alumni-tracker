<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Welcome to Alumni Tracker</title>
</head>

<body>
  <div id="body" style="background: #eeeeee; height: 100%; padding: 25px;">
    <div class="content" style="width: 500px; padding: 50px; background-color: #ffffff; margin: 0 auto; border-top: 3px solid #399B28; border-radius: 0 0 3px 3px;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);">
      <h1 style="font: bold 14px 'Arial'; color: #222222; margin: 0 0 25px 0;">Hi, <?=$personal_info[0]->firstname." ".$personal_info[0]->lastname?>!</h1>
      <p style="font: normal 14px 'Arial'; color: #333333; margin: 0 0 10px 0;">Thank you for taking the time in filling out the Alumni Tracker. Rest assured that the information you provided us will be treated with high confidentiality.</p>
      <p style="font: normal 14px 'Arial'; color: #333333; margin: 0 0 10px 0;">If you want to make changes in your profile, you may login to your alumni account through this link: <a href="<?= site_url('session/index'); ?>" style="display: block;">Alumni Tracker account login</a></p>
      <p style="font: normal 14px 'Arial'; color: #333333; margin: 0 0 10px 0;">Your login information can be found below:</p>
      <div style="margin: 15px 0 15px 25px;">
        <p style="font: normal 14px 'Arial'; color: #333333; margin: 0;"><span style="display: inline-block; width: 100px;">Username:</span><?=$account_info[0]->username?></p>
        <p style="font: normal 14px 'Arial'; color: #333333; margin: 0;"><span style="display: inline-block; width: 100px;">Password:</span><?=$account_info[0]->password?></p>
      </div>
      <p style="font: normal 14px 'Arial'; color: #333333; margin: 0 0 10px 0;">Please change your account password upon logging in.</p>
      <div style="margin-top: 25px;">
        <p style="font: normal 14px 'Arial'; color: #333333; margin: 0;">Best Regards,</p>
        <p style="font: normal 14px 'Arial'; color: #333333; margin: 0;"><em>Alumni Tracker Team</em></p>
      </div>
    </div>
  </div>
</body>
</html>