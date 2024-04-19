<?php include_once ('dbConfig.php');
$circle = @$_POST['circle']; ?>

<select class="dropdown selectpicker show-tick" data-width="fit" title="Select Sector" data-show-subtext="true"
    data-live-search="true" data-live-search-placeholder="🔎" data-size="10"
    data-style="btn-outline-primary text-body-emphasis" data-icon-base="bi" data-tick-icon="bi-check-lg"
    id="sectorSelect">
    <option data-divider="true" disabled></option>
    <?php
    $query = "SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS ExtractString FROM 5g_data WHERE CircleCode = ('$circle') ORDER BY ExtractString ASC";
    $result = mysqli_query($db, $query);

    while ($data = mysqli_fetch_assoc($result)) {
        echo '<option data-subtext="' . $circle . '">' . $data['ExtractString'] . '</option>';
    }
    ?>
</select>