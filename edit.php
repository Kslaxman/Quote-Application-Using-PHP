<?php include './config.php'; ?>
<?php include './Classes/database.php'; ?>
<?php include './Classes/quote.php'; ?>
<?php
  try {
      $quoteObj = new Quote();
      $quote = $quoteObj->getSingle($_GET['id']);
    } catch(Throwable $e) {
      echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }

  if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Unknown';

    try {
    $quoteObj = new Quote();
    $quoteObj->update($id, $text, $creator);
  } catch(Throwable $e) {
    echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }
  }

  if(isset($_POST['delete'])) {
    $id = $_GET['id'];
    try {
    $quoteObj = new Quote();
    $quoteObj->remove($id);
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
          <h2 class="page-header">Edit Quote
            <form class="pull-right" method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>
          </h2>
          <form method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>">
            <div class="form-group">
              <label>Quote Text</label>
              <input type="text" class="form-control" name="text" value="<?php echo $quote['text']; ?>" placeholder="Quote text...">
            </div>
            <div class="form-group">
              <label>Creator / Author</label>
              <input type="text" class="form-control" name="creator" value="<?php echo $quote['creator']; ?>" placeholder="Quote creator...">
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
