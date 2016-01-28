<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Polygon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Point")
     * @ORM\JoinTable(name="polygon_points",
     *      joinColumns={@ORM\JoinColumn(name="polygon_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="point_id", referencedColumnName="id")}
     *      )
     */
    private $points;

    public function __construct() {
        $this->points = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Polygon
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     * @return Polygon
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }
}