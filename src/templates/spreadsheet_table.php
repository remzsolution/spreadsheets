<?php
    if (empty($spreadsheets) || empty($pages)) {
        redirect("404.php");
    }
?>
<table class="table table-hover table-bordered spreadsheet-table" data-pages="<?=$pages?>">
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
    for ($i = 0; $i < count($spreadsheets); $i++) {
        $sheet = $spreadsheets[$i];
        if ($i > $currentPage * SPREADHSEET_TABLE_SIZE) {
            $currentPage++;
        }
        ?>
        <tr data-page="<?=$currentPage?>">
            <td class="col-md-6">
                <a href="../index.php?opendoc=<?=$sheet->getId()?>"><?=$sheet->getName()?></a>
            </td>
            <td class="col-md-3">
                <span class="text-muted"><?=$sheet->getDateModified()?></span>
            </td>
            <td class="col-md-3">
                <span class="text-muted"><?=$sheet->getDateCreated()?></span>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
