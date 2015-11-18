<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Song
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SongRepository")
 */
class Song
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
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $name;

    /**
     * @var Album
     *
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="songs")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id",
     *   nullable=false)
     */
    private $album;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Song
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set album
     *
     * @param \AppBundle\Entity\Album $album
     *
     * @return Song
     */
    public function setAlbum(\AppBundle\Entity\Album $album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AppBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
