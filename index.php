<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oxford Dictionary">
    <meta name="author" content="Paulo Azevedo">

    <title>Oxford Dictionary</title>

    <!-- Bootstrap core CSS -->
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">

    <link href="resources/css/custom.css" rel="stylesheet">

  </head>

  <body>

    <main role="main" class="container">

      <div class="jumbotron">
        <h1 class="display-5">Oxford Dictionary Widget</h1>
        <hr class="my-4">
        <form id="word-search" name="word-search">
          <div class="row">
            <div class="col-9">
              <div class="form-group">
                <label for="word">Word</label>
                <input type="text" class="form-control" id="word" name="word" aria-describedby="wordHelp" placeholder="Enter word">
                <small id="wordHelp" class="form-text text-muted">Type a word below to search for results.</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="lang">Language</label>
                <select class="form-control" id="lang" name="lang">
                  <option value="en">English</option>
                  <option value="es">Spanish</option>
                  <option value="lv">Latvian</option>
                  <option value="hi">Hindi</option>
                  <option value="sw">Swahili</option>
                  <option value="ta">Tamil</option>
                  <option value="gu">Gujarati</option>
                </select>
                <small id="wordHelp" class="form-text text-muted">Type a word below to search for results.</small>
              </div>
            </div>
          </div>
          <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr class="my-4">
        <div class="loader hidden"></div>
        <div class="result"></div>
      </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <script src="resources/js/custom.js"></script>
  </body>
</html>
