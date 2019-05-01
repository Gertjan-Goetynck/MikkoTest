<?php
class MonthlyBonus{
    public function calculateMonthlyPaymentDatesFromYear($year){
        $paymentDates = [];
        //Loops through 1-12 to emulate the months
        for($i=1; $i<=12;$i++){
            //Generates the name of the month based on the for loop index
            $month = date('F',mktime(0,0,0,$i,10));
            //Sets the payment date to the 15th of january of the next year if the current month is December. This to avoid having a 13th month in the data. Sets the payment date to the 15th of the next month otherwise
            if($i === 12){
                $paymentDate = date("d-m-Y",strtotime("15-01-".strval($year+1)));
            }else{
                $paymentDate = date("d-m-Y",strtotime("15-".strval($i+1)."-".strval($year)));
            }
            //gets the day of the month of a given date
            $dayOfMonth = date('l',strtotime($paymentDate));
            //Sets the payment date to the next wednesday if the given date is during a weekend
            if($dayOfMonth === 'Saturday' || $dayOfMonth === 'Sunday'){
                $paymentDate = date("d-m-Y", strtotime("next wednesday ".$paymentDate));
            }
            //Adds the payment date to an associative array using the months as keys
            $paymentDates[$month] = $paymentDate;
        }

        return $paymentDates;
    }
}