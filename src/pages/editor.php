<?php
require_once("../context.php");

$docId = GET("document");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../templates/meta_tags.php"; ?>
    <title>Editor</title>

    <?php require_once "../templates/header_styles.php" ?>
    <link href="../assets/css/editor.css" rel="stylesheet">
    <link href="../assets/css/handsontable.full.min.css" rel="stylesheet">
</head>

<body>

<?php require_once "../templates/navbar.php" ?>

<div class="container-fluid">

    <div class="hot spreadsheet" id="document1" data-document-id="<?= $docId ?>"></div>

</div><!-- /.container -->

<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">

        <div class="collapse navbar-collapse spreadsheets-tabs">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#document1">Document 1</a></li>
                <li><a href="#">Document 2</a></li>
                <li><a href="#">Documendasdasdasdt 3</a></li>
                <li><a href="#">Document 4</a></li>
                <li><a href="#">Document 5</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->

        <div class="collapse navbar-collapse">
        </div>
    </div>
</nav>

<?php require_once "../templates/footer.php" ?>
<?php require_once "../templates/scripts.php" ?>
<script src="../assets/js/handsontable.full.min.js"></script>
<script src="../assets/js/editor.js"></script>
</body>

</html>
