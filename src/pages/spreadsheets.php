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
        <table class="table table-hover table-bordered spreadsheet-table">
            <thead>
            <tr>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
                <th>Heading 1</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < 10; $i++) {
                ?>
                <tr>
                    <td class="col-md-5">Data 1</td>
                    <td class="col-md-3">Data 1</td>
                    <td class="col-md-2">Data 1</td>
                    <td class="col-md-2">Data 1</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

</div><!-- /.container -->

<?php require_once "../templates/footer.php" ?>
<?php require_once "../templates/scripts.php" ?>
</body>

</html>
