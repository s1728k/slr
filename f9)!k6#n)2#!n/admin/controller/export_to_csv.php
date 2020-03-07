<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
$table = ucfirst($_GET['lead_cat']);
include($app_key.'/model/'.$table.'.php');

if($id){
    // $row = Contact::find($id,$_SESSION['admin_role'].'_export_to_csv');
}else{
    $rows = $table::where(null, null,'visibles','sort:ORDER BY status_date',[]);
}
?>

<?php
    if($id){
        $file_name="report_".$row['id'].'.csv';
        $file_path = $_SERVER['DOCUMENT_ROOT']."/assets/report_".$row['id'].'.csv';
        $myfile = fopen($file_path, "w");
        foreach ($row as $k => $v) {
            fputcsv($myfile, [$k, $v]);
        }
        fclose($myfile);
    }else{
        $file_name="report".'.csv';
        $file_path = $_SERVER['DOCUMENT_ROOT']."/assets/report".'.csv';
        $myfile = fopen($file_path, "w");
        fputcsv($myfile, array_keys($rows[0]));
        foreach ($rows as $row) {
            fputcsv($myfile, $row);
        }
        fclose($myfile);
    }

    if (is_writable($file_path)) {
        header('Content-Type: application/octet-stream');
        // header('Content-Type: application/x-msdownload');
        header('Content-Disposition: attachment; filename="'.$file_name.'"');
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        // header('Expires: 0');
        // header('Content-Length: ' . filesize($file_path));
        // readfile($file_path);
        set_time_limit(0);
        $file = @fopen($file_path,"rb");
        while(!feof($file))
        {
            print(@fread($file, 1024*8));
            ob_flush();
            flush();
        }
    }
?>