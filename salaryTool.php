<?php 
require_once("Business/PaymentDatesService.php");
require_once("Business/DownloadDataService.php");

//Checks if the post year variable is set and generates a multidimensional array with payment dates if it is
if(isset($_POST["year"])){
    $paymentDatesService = new PaymentDatesService();
    $salaryBonusDates = $paymentDatesService->calculateBonusSalaryDates($_POST["year"]);

    //Checks if the action is set and calls the downloadCsv function if so
    if(isset($_POST["action"])){
        $downloadDataService = new DownloadDataService();
        //Add a switch case to easily add new file types in the future
        switch($_POST["action"]){
            case 'CSV':
                $fileName = 'payment_dates_'.$_POST['year'].'.csv';
                $downloadDataService->downloadCsv($fileName, $salaryBonusDates);
                break;
        }
  
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Monthly  payment dates</h1>
<!-- 1970 was chosen as a minimum value for the year since this is the startdate of the Unix timestamp. This is in order to avoid wrong values when going below it. 
No server side validation was added because it would be redundant. HTML5 only allows number values because of the input type, and using POST makes errors due to a wrong url parameters not an issue
-->

<form method="POST" action="salaryTool.php">
    <label>Please enter a year: <input name="year" required type="number" min="1970" <?php if(isset($_POST["year"])){echo 'value='.$_POST["year"];} else{echo 'value=1970';}?> max="9999"></label>
    <input type="submit" value="Calculate payment dates" />
</form>
<br />
<?php
if(isset($salaryBonusDates)){
    echo '
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Salary date</th>
                <th>Bonus date</th>
            </tr>
        </thead>
    <tbody>';
            //Generates a table with the data that will be printed
            for($row = 0; $row < count($salaryBonusDates); $row++){
                echo '<tr>';
                for($col = 0; $col <3; $col++){
                    echo '<td>'.$salaryBonusDates[$row][$col].'</td>';
                }
                echo '</tr>';
            }
    echo '
        </tbody>
    </table>
    ';
    //Generates a form to download the data, and adds the year to a hidden field to avoid the table from disapearing after pressing the download button
    echo '
    <br/>
    <form method="post" action="salaryTool.php">
            <input type="hidden" name="year" value="'.$_POST['year'].'"/>
            <label>Select a file type:<br/><input type="radio" name="action" value="CSV" checked />CSV</label><br/>
            <input type="submit" value="Download file" />
    </form>
    ';
}

?>

</body>
</html>