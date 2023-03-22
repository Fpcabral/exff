<?php

class Utils
{
    public function getConfig($data, $searchName, $parents){
        //search for the org, in the config file
        $key = array_search($searchName, array_column($data, 'name'));

        if(! $key){
            //case if org doesn't exist
            throw new Exception('Organisation not found');
        }

        $item = $data[$key];

        //if the org exists go get the config, if has no config, get the "parent" config
        if($item['config'] == null){
            return $this->getConfig($data, $parents[$item['name']], $parents);
        }

        return new OrganisationUnitConfig(
            $item['config']['has_fixed_membership_fee'],
            $item['config']['fixed_membership_fee_amount']
        );
    }

    public function getDataStructure($data, $searchName, $parents){
        try{
            $config = $this->getConfig($data, $searchName, $parents);

            //return the org, with the correct name, and config
            return new OrganisationUnit($searchName, $config);
        }
        catch(Throwable $e) {
            return $e->getMessage();
        }        
    }

    public function displayList($dataStructure) {
        //display the list of orgs available
        echo "<ul>";
        foreach ($dataStructure as $key => $value) {
            echo "<li><input type='radio' name='name' value='$key'>$key</li>";
            if (is_array($value)) {
                echo "<ul>";
                if (array_keys($value) !== range(0, count($value) - 1)) {
                    $this->displayList($value);
                } else {
                    foreach ($value as $item) {
                        echo "<li><input type='radio' name='name' value='$item'>$item</li>";
                    }
                }
                echo "</ul>";
            }
        }
        echo "</ul>";
    }
}