<?php require_once "../context.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../templates/meta_tags.php"; ?>
    <title>Spreadsheets</title>
    <?php require_once "../templates/header_styles.php" ?>
</head>

<body>

<?php require_once "../templates/navbar.php" ?>

<div class="container">

    <h1 class="page-header">Spreadsheets search table</h1>

    <div class="search-box">
        <form>
            <input type="text" id="search-bar" placeholder="Search for spreadsheet names" class="form-control">
        </form>
    </div>
    <hr>

    <div class="table-responsive">
    </div>

    <div class="text-center">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

</div><!-- /.container -->

<?php require_once "../templates/footer.php" ?>
<?php require_once "../templates/scripts.php" ?>
</body>

</html>
