<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class MissionData {

    /**
     * @var int
     */
    public $page = 1;


    /**
     * @var string
     */
    public $q= '';

    
    /**
     * @var string
     */
    public $p= '';

    /**
     * @var null|integer
     * @Assert\Range(max=65000)
     */
    public $max;

     /**
     * @var null|integer
     * @Assert\Range(min=0)
     */
    public $min;



}