<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nomination
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\NominationRepository")
 */
class Nomination
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
     * @var integer
     *
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    private $votes;

    /**
     * @var Ballot
     *
     * @ORM\ManyToOne(targetEntity="Ballot", inversedBy="nominations")
     * @ORM\JoinColumn(name="ballot_id", referencedColumnName="id",
     *   nullable=false)
     */
    private $ballot;


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
     * Set votes
     *
     * @param integer $votes
     *
     * @return Nomination
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Get votes
     *
     * @return integer
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Set ballot
     *
     * @param \AppBundle\Entity\Ballot $ballot
     *
     * @return Nomination
     */
    public function setBallot(\AppBundle\Entity\Ballot $ballot)
    {
        $this->ballot = $ballot;

        return $this;
    }

    /**
     * Get ballot
     *
     * @return \AppBundle\Entity\Ballot
     */
    public function getBallot()
    {
        return $this->ballot;
    }
}
