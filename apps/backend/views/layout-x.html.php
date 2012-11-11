<!DOCTYPE HTML>
<html lang="en-EN">
<head>
	<meta charset="UTF-8">
	<title>TEST SITE<?php echo h($page_title) ?></title>
</head>
<body>
  <h1><?php echo h($page_title) ?></h1>
  <div id="main">
    <!-- main content -->
    <h2>Main content</h2>
    <?php echo $content; ?>
  </div>
  <!--
    $sidebar contains the content_for('sidebar') captured content.
  -->
  <?php if(!empty($sidebar)): ?>
  <div id="sidebar">
    <h2>Sidebar</h2>
    <?php echo $sidebar; ?>
  </div>
  <?php endif; ?>
  <hr>
	<a href="<?php echo url_for('/')?>">Home</a> |
	<a href="<?php echo url_for('/test/', $name)?>">Hello</a> | 
  <a href="<?php echo url_for('/test/add/')?>">Add user</a> |
  <a href="<?php echo url_for('/test/', $name)?>">Hello</a> |
</body>
</html>