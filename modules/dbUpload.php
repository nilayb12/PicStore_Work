<?php include_once('dbConfig.php');

if (isset($_POST['uploadBtn'])) {
    $errDupl = $errSize = [];
    for ($i = 0; $i < count($_FILES['uploadFile']['name']); ++$i) {

        $fileName = $_FILES['uploadFile']['name'][$i];
        $tmpName = $_FILES['uploadFile']['tmp_name'][$i];
        // $a = $_SESSION['circle'] == 'NHQ' ? 1 : 0;
        $folderPath = substr($_POST['pathVal'], 2, 2) . '/' . substr($_POST['pathVal'], 5, 4) . '/' . substr($_POST['pathVal'], 0);
        if (!file_exists($folderPath)) {
            @mkdir('images/' . $folderPath, 0777, true);
        }
        $filePath = 'images/' . $folderPath . '/' . $fileName;

        if (!empty($fileName)) {
            $sql = "INSERT INTO image (FilePath, FileName) VALUES (('$folderPath'), ('$fileName'))";
            if (file_exists($filePath)) {
                array_push($errDupl, $fileName);
            } elseif (($_FILES['uploadFile']['size'][$i] >= 4194304) || ($_FILES['uploadFile']['size'][$i] == 0)) {
                array_push($errSize, $fileName);
            } else {
                mysqli_query($db, $sql);
                move_uploaded_file($tmpName, $filePath);
            }
        }
    }
    function arrWrite($errArr)
    {
        $ret = 'File(s) Not Uploaded:\n';
        foreach ($errArr as $i) {
            $ret .= '→ ' . $i . '\n';
        }
        return $ret;
    }
    if (count($errDupl) > 0) {
        // echo "<script type='text/javascript'>
        //     $(document).ready(function(){
        //         $('#uplModal').modal('show');
        //     });
        // </script>";
        echo "<script type='text/javascript'>
            $(document).ready(function(){
                alert('" . arrWrite($errDupl) . "New Image(s) can\'t have the Same Name as Existing Image(s).');
            });
        </script>";
    }
    if (count($errSize) > 0) {
        echo "<script type='text/javascript'>
            $(document).ready(function(){
                alert('" . arrWrite($errSize) . "Size must be < 4MB.');
            });
        </script>";
    }
}
?>