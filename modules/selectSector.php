<?php include_once ('dbConfig.php');
$city = @$_POST['city']; ?>

<select class="dropdown selectpicker show-tick" data-width="fit" title="Select SAP ID" data-show-subtext="true"
    data-live-search="true" data-live-search-placeholder="🔎" data-size="10"
    data-style="btn-outline-primary text-body-emphasis" data-icon-base="bi" data-tick-icon="bi-check-lg"
    id="sectorSelect">
    <option data-divider="true" disabled></option>
    <option data-subtext="<Select SAP ID>" selected></option>
    <?php
    $query = "WITH temp AS (SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS City, SAP_ID FROM 5g_data_30k) SELECT DISTINCT SAP_ID FROM temp WHERE City = ('$city') ORDER BY SAP_ID ASC";
    $result = mysqli_query($db, $query);

    while ($data = mysqli_fetch_assoc($result)) {
        echo '<option data-subtext="">' . $data['SAP_ID'] . '</option>';
    }
    ?>
</select>