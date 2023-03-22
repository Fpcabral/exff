<?php

class OrganisationUnitConfig
{
    public ?bool $has_fixed_membership_fee;

    public ?int $fixed_membership_fee_amount;

    public function __construct($has_fixed_membership_fee,$fixed_membership_fee_amount)
    {
        $this->has_fixed_membership_fee = $has_fixed_membership_fee;
        $this->fixed_membership_fee_amount = $fixed_membership_fee_amount;        
    }

    public function setHasFixedMembershipFee(bool $has_fixed_membership_fee)
    {
        $this->has_fixed_membership_fee = $has_fixed_membership_fee;
    }

    public function getHasFixedMembershipFee()
    {
        return $this->has_fixed_membership_fee;
    }

    public function setFixedMemberShipFeeAmount(int $fixed_membership_fee_amount)
    {
        $this->fixed_membership_fee_amount = $fixed_membership_fee_amount;
    }

    public function getFixedMembershipFeeAmount()
    {
        return $this->fixed_membership_fee_amount;
    }
}