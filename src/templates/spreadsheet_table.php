<?php
    if (empty($spreadsheets)) {
        exit;
    }
?>
<table class="table table-hover table-bordered spreadsheet-table">
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
    for ($i = 0; $i < count($spreadsheets); $i++) {
        $sheet = $spreadsheets[$i];
        ?>
        <tr>
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
