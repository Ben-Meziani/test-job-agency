<?php
namespace App\Entity;

class MissionSearch {
    /**
     * @var int|null
     */
    private $maxSalary;

    /**
     * @return int|null
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