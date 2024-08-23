<?php include_once('dbConfig.php');
$circle = @$_POST['circle']; ?>

<select class="dropdown selectpicker show-tick align-self-start !me-1" data-width="fit" title="Select City"
    data-show-subtext="true" data-live-search="true" data-live-search-placeholder="🔎" data-size="10"
    data-style="btn-sm btn-outline-primary text-body-emphasis" data-icon-base="bi" data-tick-icon="bi-check-lg"
    id="citySelect">
    <option data-divider="true" disabled></option>
    <option data-subtext="<Select City>" selected></option>
    <?php
    // $query = "SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS City FROM 5g_data_30k WHERE CircleCode = ('$circle') ORDER BY City ASC";
    // $query = "SELECT * FROM city WHERE CircleCode = ('$circle')";
    $query = "SELECT * FROM city WHERE CircleID = (SELECT CircleID FROM circle WHERE CircleCode = ('$circle'));";
    $result = mysqli_query($db, $query);

    while ($data = mysqli_fetch_assoc($result)) {
        echo '<option data-subtext="' . $data['CityName'] . '">' . $data['CityCode'] . '</option>';
        // echo '<option>' . $data['CityCode'] . '</option>';
    }
    ?>
</select><i class="bi bi-chevron-right align-self-start mt-1 d-none"></i>