<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Camera extends Point
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="stream_url", type="text")
     */
    private $stream_url;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Camera
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreamUrl()
    {
        return $this->stream_url;
    }

    /**
     * @param string $stream_url
     * @return Camera
     */
    public function setStreamUrl($stream_url)
    {
        $this->stream_url = $stream_url;
        return $this;
    }
}