<?php
    if (empty($spreadsheets) || empty($pages)) {
        redirect("404.php");
    }
?>
<table class="table table-hover table-bordered spreadsheet-table"
       data-pages="<?=$pages?>" data-page-size="<?=SPREADSHEET_TABLE_SIZE?>"
       data-active-page="1">
    <thead>
    <tr>
        <th>Name</th>
        <th>Modified</th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var Spreadsheet[] $spreadsheets */
    $currentPage = 1;
    foreach ($spreadsheets as $i => $sheet) {
        if ($i + 1 > $currentPage * SPREADSHEET_TABLE_SIZE) {
            $currentPage++;
        }
        ?>
        <tr data-page="<?=$currentPage?>">
            <td class="col-md-8">
                <a href="../index.php?opendoc=<?=$sheet->getId()?>"><?=$sheet->getName()?></a>
            </td>
            <td class="col-md-2">
                <span class="text-muted"><?=$sheet->getDateModified()?></span>
            </td>
            <td class="col-md-2">
                <span class="text-muted"><?=$sheet->getDateCreated()?></span>
            </td>
        </tr>
        <?php


    }
    ?>
    </tbody>
</table>
