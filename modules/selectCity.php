<?php include_once ('dbConfig.php');
$circle = @$_POST['circle']; ?>

<select class="dropdown selectpicker show-tick me-1" data-width="fit" title="Select City" data-show-subtext="true"
    data-live-search="true" data-live-search-placeholder="🔎" data-size="10"
    data-style="btn-outline-primary text-body-emphasis" data-icon-base="bi" data-tick-icon="bi-check-lg"
    id="citySelect">
    <option data-divider="true" disabled></option>
    <option data-subtext="<Select City>" selected></option>
    <?php
    $query = "SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS City FROM 5g_data_30k WHERE CircleCode = ('$circle') ORDER BY City ASC";
    $result = mysqli_query($db, $query);

    while ($data = mysqli_fetch_assoc($result)) {
        echo '<option data-subtext="' . $circle . '">' . $data['City'] . '</option>';
    }
    ?>
</select>