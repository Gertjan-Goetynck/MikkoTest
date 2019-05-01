<?php 
class MonthlySalary{
    public function calculateMonthlyPaymentDatesFromYear($year){
        $paymentDates = [];
        //Calculates the dates where a salary is payed. Uses a for loop to loop through months
        for($i = 1; $i <= 12; $i++){
            //Generates the name of a month based on the index of the for loop, so it can be used as a named key for the array
            $month = date('F',mktime(0,0,0,$i,10));
            //Sets the first of the month
            $firstOfMonth = "1-".$i."-".$year;
            //Uses t to set the date to the last day of the month
            $paymentDate = date("t-m-Y",strtotime($firstOfMonth));
            //Checks which day the last day of the month is
            $dayOfMonth = date('l',strtotime($paymentDate));       
            //Checks if the last day of the month is during a weekend, and sets paymentDate to the friday before if so
            if($dayOfMonth === 'Saturday' || $dayOfMonth === 'Sunday'){                    
                $paymentDate = date("d-m-Y", strtotime("last friday ".strval($year)."-".strval($i+1)));
            }
            //Adds the paymentDate to the paymentDates array, using the month as a key
            $paymentDates[$month] = $paymentDate;
        }
        return $paymentDates;
    }
}
