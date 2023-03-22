<?php
class DataStructure
{
    public $dataStructure;
    public $parents;

    public function __construct()
    {   
        //use a separate "parent" array to check the parent, in case the config is null, 
        //using this to get a better performance
        $this->parents = [
            'branch_a' => 'area_a',
            'branch_b' => 'area_a',
            'branch_c' => 'area_a',
            'branch_d' => 'area_a',
            'branch_e' => 'area_b',
            'branch_f' => 'area_b',
            'branch_g' => 'area_b',
            'branch_h' => 'area_b',
            'branch_i' => 'area_c',
            'branch_j' => 'area_c',
            'branch_k' => 'area_c',
            'branch_l' => 'area_c',
            'branch_m' => 'area_d',
            'branch_n' => 'area_d',
            'branch_o' => 'area_d',
            'branch_p' => 'area_d',
            'area_a' => 'division_a',
            'area_b' => 'division_a',
            'area_c' => 'division_b',
            'area_d' => 'division_b',
            'division_a' => 'client',
            'division_b' => 'client',
        ];

        $this->dataStructure =  [
            'client' => [
                'division_a' => [
                    'area_a' => [
                        'branch_a',
                        'branch_b',
                        'branch_c',
                        'branch_d'
                    ],
                    'area_b' => [
                        'branch_e',
                        'branch_f',
                        'branch_g',
                        'branch_h'
                    ],
                ],
                'division_b' => [
                    'area_c' => [
                        'branch_i',
                        'branch_j',
                        'branch_k',
                        'branch_l',
                    ],
                    'area_d' => [
                        'branch_m',
                        'branch_n',
                        'branch_o',
                        'branch_p',
                    ],
                ]
            ]
        ];
    }
}
