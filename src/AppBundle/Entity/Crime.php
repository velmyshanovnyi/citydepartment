<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Crime extends Point
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="reporter_id", referencedColumnName="id")
     */
    private $reporter;

    /**
     * @ORM\ManyToOne(targetEntity="CrimeType")
     * @ORM\JoinColumn(name="crime_type", referencedColumnName="id")
     */
    private $crime_type;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Crime
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @param mixed $reporter
     * @return Crime
     */
    public function setReporter($reporter)
    {
        $this->reporter = $reporter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrimeType()
    {
        return $this->crime_type;
    }

    /**
     * @param mixed $crime_type
     * @return Crime
     */
    public function setCrimeType($crime_type)
    {
        $this->crime_type = $crime_type;
        return $this;
    }
}