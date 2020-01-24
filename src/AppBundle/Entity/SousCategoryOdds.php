<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategoryOdds
 *
 * @ORM\Table(name="sous_category_odds")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SousCategoryOddsRepository")
 */
class SousCategoryOdds
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var mixed
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Odd",cascade={"merge"} ,fetch="EAGER")
     */

    private $odds;

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
     * @return SousCategoryOdds
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
}

