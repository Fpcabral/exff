<?php

class CalculateMembershipFeeController
{
    public function calculate_membership_fee(int $rent_amount, string $rent_period, OrganisationUnit $org) 
    {
        //validate all the data 
        $validate = $this->validator($rent_amount, $rent_period);

        //if $validate returns something it means that something is wrong, return the error
        if($validate){
            return $validate;
        }
    
        $vat = 1.2;

        //Check if org has a fixed membership fee, and if so, return it
        if($org->getConfig()->getHasFixedMembershipFee()){
            return $org->getConfig()->getFixedMembershipFeeAmount();
        }

        if($rent_period == 'month'){
            //if the period is a month
            //get the amount for the week
            $rent_amount = $rent_amount / 4;
        }

        //check if the amount is less than 12000, if so, use 12000 as default
        if($rent_amount < 12000){
            return 12000 * $vat;
        }

        //return the amount times the vat
        return (int) $rent_amount * $vat;
    } 

    public function validator(int $rent_amount, string $rent_period)
    {
        try {
            if(! in_array($rent_period, ['month', 'week'])){
                throw new Exception('This rent period is invalid');
            }

            switch($rent_period){
                case 'month':
                    if ($rent_amount < 11000) {
                        throw new Exception('Minimum rent amount per month is £110');
                    }
                    if ($rent_amount > 860000) {
                        throw new Exception('Maximum rent amount per month is £8600');
                    }
                break;

                case 'week':
                    if ($rent_amount < 2500) {
                        throw new Exception('Minimum rent amount per week is £25');
                    }
                    if ($rent_amount > 200000) {
                        throw new Exception('Maximum rent amount per week is £2000');
                    }
                break;
            }
        }
        catch(Throwable $e) {
            return $e->getMessage();
        }
    }
}