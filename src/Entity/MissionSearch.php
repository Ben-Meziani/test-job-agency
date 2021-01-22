<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class MissionSearch {
    /**
     * @var int|null
     */
    private $maxSalary;

      /**
     * @var int|null
     */
    private $minSalary;

    /**
     * @return int|null
     * @Assert\Range(max=800000, min=1)
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

    /**
     * @return int|null
     * @Assert\Range(max=800000, min=1)
     */
    public function getMinSalary(): ?int
    {
        return $this->minSalary;
    }

    /**
     * @param int|null $minSalary
     * @return MissionSearch
     */
    public function setMinSalary(int $minSalary): MissionSearch
    {
        $this->minSalary = $minSalary;
        return $this;
    }
}