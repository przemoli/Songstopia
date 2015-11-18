<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Band
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BandRepository")
 */
class Band
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
     * @var date
     *
     * @ORM\Column(type="date")
     */
    private $founded;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Album", mappedBy="band")
     */
    private $albums;


    /**
     * Constructor
     */
    public function __construct() {
      $this->albums = new ArrayCollection();
    }

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
     * @return Band
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
     * Set founded
     *
     * @param \DateTime $founded
     *
     * @return Band
     */
    public function setFounded($founded)
    {
        $this->founded = $founded;

        return $this;
    }

    /**
     * Get founded
     *
     * @return \DateTime
     */
    public function getFounded()
    {
        return $this->founded;
    }

    /**
     * Add album
     *
     * @param \AppBundle\Entity\Album $album
     *
     * @return Band
     */
    public function addAlbum(\AppBundle\Entity\Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \AppBundle\Entity\Album $album
     */
    public function removeAlbum(\AppBundle\Entity\Album $album)
    {
        $this->albums->removeElement($album);
    }

    /**
     * Get albums
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbums()
    {
        return $this->albums;
    }
}
