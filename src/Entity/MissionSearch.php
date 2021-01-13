<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class MissionSearch {
    /**
     * @var int|null
     */
    private $maxSalary;

    /**
     * @return int|null
     * @Assert\Range(max=800000)
     */
    public function getMaxSalary(): ?int
    {
        return $this->maxSalary;
    }

    /**
     * @param int|null $maxSalary
     * @return MissionSearch
     */
    public function setMaxSalary(int $maxSalary): MissionSearch
    {
        $this->maxSalary = $maxSalary;
        return $this;
    }
}