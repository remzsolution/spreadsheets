<?php
require_once "../context.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../templates/meta_tags.php"; ?>
    <title>Editor</title>
    <?php require_once "../templates/header_styles.php"; ?>
    <link href="../assets/css/editor.css" rel="stylesheet">
    <link href="../assets/css/handsontable.full.min.css" rel="stylesheet">
</head>

<body>

<?php require_once "../templates/editor_navbar.php"; ?>

<div class="container-fluid" id="document-container"></div><!-- /.container -->

<nav class="navbar navbar-fixed-bottom">
    <div class="container-fluid">

        <div class="collapse navbar-collapse spreadsheets-tabs">
            <ul class="nav navbar-nav tabbar">
            </ul>
        </div><!-- /.navbar-collapse -->

        <div class="collapse navbar-collapse">
        </div>
    </div>
</nav>

<templates>
    <div class="hot spreadsheet" id="<?= issetGET("id") ? GET("id") : "" ?>"></div>

    <div class="modal fade" id="openFileModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>

                <div class="modal-body">
                    <div class="table-responsive"></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</templates>

<?php require_once "../templates/footer.php" ?>
<?php require_once "../templates/scripts.php" ?>
<script src="../assets/js/handsontable.full.min.js"></script>
<script src="../assets/js/editor.js"></script>
</body>

</html>
