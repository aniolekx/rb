<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css2" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="revisit-after" content="7 Days" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="language" content="en" />
    <title><?php echo $title ?></title>
    <link href="http://localhost/webdroid/views/css/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="template/js/jquery.js"></script>

    <body>
      <div id="msg"><?php echo flash_now('msg'); ?></div>
      <div id="error_msg">
        <?php
        $error_msg = flash_now('error_msg');
        if ($error_msg != '') {
          if (is_array($error_msg)) {
            foreach ($error_msg as $field => $msg) {
              foreach ($msg as $f => $m)
                echo Tools::humanize($m) . '</br>';
            }
          } else
            echo $error_msg;
        }
        ?>
      </div>  
      <div id="main">
        <div id="header"><?php echo partial('_header.html.php'); ?></div>
        <div id="body">
          <h1><?php echo $title ?></h1>
          <?php echo $content; ?>
        </div>
      </div>
    </body>
</html>
<br />
<hr />
<?php print_r(benchmark()); ?>