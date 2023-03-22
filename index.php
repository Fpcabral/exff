<?php
require('models/OrganisationUnit.php');
require('models/OrganisationUnitConfig.php');
require('controllers/CalculateMembershipFeeController.php');

require('config/data.php');
require('config/dataStructure.php');
require('helper/utils.php');


//structures to develop. In a normal case, this should be returned by queries 
$configData = new Data();
$configDataStructure = new DataStructure();

//usefull functions like display the list of orgs
//and get the configs for orgs
$utils = new Utils();

//controller => Object that has the logic
$calculator = new CalculateMembershipFeeController();

?> 
<!-- Form to put the rent amount and period for certain org and get the Membership fee -->
<form action="" method="get">
    <label for="rent_amount">Rent Amount</label>
    <input type="number" name="amount">
    <div>
        <label for="week">Rent week</label>
        <input type="radio" name="period" value="week" id="">
        <label for="month">Rent month</label>
        <input type="radio" name="period" value="month" id="">
        <?php
        $utils->displayList($configDataStructure->dataStructure, 'client');
        ?>
    </div>
    <button type="submit">Calculate</button>
</form>
<?php


if(isset($_GET) && isset($_GET['name']) && isset($_GET['amount']) && isset($_GET['period'])){
    //get the Data structure, should return a OrganisationUnit or an error
    $organisation = $utils->getDataStructure($configData->data, $_GET['name'], $configDataStructure->parents);

    if($organisation instanceof OrganisationUnit){
        $calculation = $calculator->calculate_membership_fee($_GET['amount'], $_GET['period'], $organisation);
        if(is_int($calculation)){
            echo "The fee for ".$_GET['amount']." rent paid by ".$_GET['period']. " for the organisation " .$_GET['name']." is => ". $calculation;
        }else{
            echo "ERROR => ".$calculation;
        }
    }else{
        echo $organisation;
    }
}
