<?php
class DownloadDataService{
    public function downloadCSV($name, $data){
        //Sets the headers
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$name}");
        header("Expires: 0");
        header("Pragma: public");
        //Opens a file with write access
        $fh = fopen( 'php://output', 'w' );
        $headerDisplayed = false;

        //loops through the outer array
        foreach ( $data as $dataItem ) {
            //Sets the headers of the array if this is the first loop, and sets headerDisplayed on false to avoid adding them every other line
            if ( !$headerDisplayed ) {
                fputcsv($fh, array('Year','Salary payment date','Bonus payment date'));
                $headerDisplayed = true;
            }
            //Writes the data of the inner array to the CSV
            fputcsv($fh, $dataItem);
        }
        fclose($fh);
        exit;
    }
}