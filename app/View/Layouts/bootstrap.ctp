<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->Html->css('bootstrap'); ?>
  </head>
  <body>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
  </body>
</html>