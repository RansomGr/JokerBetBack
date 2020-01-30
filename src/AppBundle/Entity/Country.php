<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getIdCountry()
    {
        return $this->id_country;
    }

    /**
     * @param int $id_country
     */
    public function setIdCountry($id_country)
    {
        $this->id_country = $id_country;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_country", type="string")
     */
    private $id_country;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\League",cascade={"merge"} ,fetch="EAGER" ,mappedBy="country")
     */
    private $leagues;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sport",cascade={"merge"} ,fetch="EAGER" )
     */
    private $sport;
    /**
     * Get id
     *
     * @return int
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
     * @return Country
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
     * @return mixed
     */
    public function getLeagues()
    {
        return $this->leagues;
    }

    /**
     * @param mixed $leagues
     */
    public function setLeagues($leagues)
    {
        $this->leagues = $leagues;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
    }




}

