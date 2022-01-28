<?php include './config.php'; ?>
<?php include './Classes/database.php'; ?>
<?php include './Classes/quote.php'; ?>
<?php
  if(isset($_POST['submit'])) {
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Unknown';

    try {
    $quoteObj = new Quote();
    $quotes = $quoteObj->add($text, $creator);
  } catch(Throwable $e) {
    echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GoodQuotes | New Quote</title>
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <link rel="stylesheet" href="./CSS/style.css">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation" class="active"><a href="new.php">New Quote</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">GoodQuotes</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h2 class="page-header">Add New Quote</h2>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label>Quote Text</label>
              <input type="text" class="form-control" name="text" placeholder="Quote text...">
            </div>
            <div class="form-group">
              <label>Creator / Author</label>
              <input type="text" class="form-control" name="creator" placeholder="Quote creator...">
            </div>
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2016 GoodQuotes, Inc.</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
