<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class Users
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  protected $id;

  /**
  * @ORM\Column(type="string", length=100)
  */
  protected $login;

  /**
  * @ORM\Column(type="string", length=100)
  */
  protected $pass;

  /**
  * @ORM\Column(type="string", length=7)
  */
  protected $flag;

  /**
  * @ORM\OneToMany(targetEntity="Heroes", mappedBy="users")
  */
  protected $heroes;

  public function __construct()
  {
    $this->heroes = new ArrayCollection();
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
     * Set login
     *
     * @param string $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set pass
     *
     * @param string $pass
     * @return Users
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return Users
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Add heroes
     *
     * @param \AppBundle\Entity\Heroes $heroes
     * @return Users
     */
    public function addHero(\AppBundle\Entity\Heroes $heroes)
    {
        $this->heroes[] = $heroes;

        return $this;
    }

    /**
     * Remove heroes
     *
     * @param \AppBundle\Entity\Heroes $heroes
     */
    public function removeHero(\AppBundle\Entity\Heroes $heroes)
    {
        $this->heroes->removeElement($heroes);
    }

    /**
     * Get heroes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeroes()
    {
        return $this->heroes;
    }

    /**
     * Set fight
     *
     * @param \AppBundle\Entity\Fights $fight
     * @return Users
     */
    public function setFight(\AppBundle\Entity\Fights $fight = null)
    {
        $this->fight = $fight;

        return $this;
    }

    /**
     * Get fight
     *
     * @return \AppBundle\Entity\Fights
     */
    public function getFight()
    {
        return $this->fight;
    }
}
