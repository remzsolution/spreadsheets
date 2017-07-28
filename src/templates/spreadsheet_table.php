<?php
    if (empty($spreadsheets) || empty($pages)) {
        redirect("401.php");
    }
?>
<table class="table table-hover table-bordered spreadsheet-table"
       data-pages="<?=$pages?>" data-page-size="<?=SPREADSHEET_TABLE_SIZE?>"
       data-active-page="1">
    <thead>
    <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Modified</th>
        <th class="text-center">Created</th>
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
            <td class="col-md-6 lead text-center">
                <a href="../pages/editor.php?id=<?=$sheet->getId()?>"><?=$sheet->getName()?></a>
            </td>
            <td class="col-md-3 text-center">
                <span class="text-muted"><?=date("d.m.Y H:i:s", $sheet->getDateModified());?></span>
            </td>
            <td class="col-md-3 text-center">
                <span class="text-muted"><?=date("d.m.Y H:i:s", $sheet->getDateCreated());?></span>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>