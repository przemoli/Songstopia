<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AlbumRepository")
 */
class Album
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
    private $published;

    /**
     * @var Band
     *
     * @ORM\ManyToOne(targetEntity="Band", inversedBy="albums")
     * @ORM\JoinColumn(name="band_id", referencedColumnName="id",
     *   nullable=false)
     */
    private $band;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Song", mappedBy="album")
     */
    private $songs;


    /**
     * Constructor
     */
    public function __construct() {
      $this->songs = new ArrayCollection();
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
     * @return Album
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
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Album
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }
}
