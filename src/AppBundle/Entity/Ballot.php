<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ballot
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BallotRepository")
 */
class Ballot
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
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Nomination", mappedBy="ballot")
     */
    private $nominations;


    /**
     * Constructor
     */
    public function __construct() {
      $this->nominations = new ArrayCollection();
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
     * @return Ballot
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
     * Set description
     *
     * @param string $description
     *
     * @return Ballot
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add nomination
     *
     * @param \AppBundle\Entity\Nomination $nomination
     *
     * @return Ballot
     */
    public function addNomination(\AppBundle\Entity\Nomination $nomination)
    {
        $this->nominations[] = $nomination;

        $nomination->setBallot($nomination);

        return $this;
    }

    /**
     * Remove nomination
     *
     * @param \AppBundle\Entity\Nomination $nomination
     */
    public function removeNomination(\AppBundle\Entity\Nomination $nomination)
    {
        $this->nominations->removeElement($nomination);
    }

    /**
     * Get nominations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNominations()
    {
        return $this->nominations;
    }
}
