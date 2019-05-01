<?php
require_once("Entities/MonthlySalary.php");
require_once("Entities/MonthlyBonus.php");

class PaymentDatesService{
    public function calculateSalaryDates($year){
        $monthlySalary = new MonthlySalary();
        $salaryPaymentDates = $monthlySalary->calculateMonthlyPaymentDatesFromYear($year);

        return $salaryPaymentDates;
    }
    public function calculateBonusDates($year){
        $monthlyBonus = new MonthlyBonus();
        $bonusPaymentDates = $monthlyBonus->calculateMonthlyPaymentDatesFromYear($year);
    
        return $bonusPaymentDates;
    }

    public function calculateBonusSalaryDates($year){
        $months = [];
        $paymentDates = [];
        //Calls the functions to calculate the salary and bonus payment dates
        $salaryPaymentDates = $this->calculateSalaryDates($year);
        $bonusPaymentDates = $this->calculateBonusDates($year);

        //Dynamically generate an array with all the months in it
        for($i = 1; $i <= 12 ; $i++){
            $month = date('F',mktime(0,0,0,$i,10));
            array_push($months, $month);
        }

        //Create a multidimentional array for each month, with the name of the months and the payment dates in the inner array.
        foreach($months as $month){
            array_push($paymentDates,array($month,$salaryPaymentDates[$month],$bonusPaymentDates[$month]));
        }
        return $paymentDates;
    }
}