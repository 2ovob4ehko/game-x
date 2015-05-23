<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="fights")
*/
class Fights
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  protected $id;

  /**
  * @ORM\Column(type="integer")
  */
  protected $turn;

  /**
  * @ORM\OneToOne(targetEntity="Heroes", inversedBy="fights")
  * @ORM\JoinColumn(name="attacker", referencedColumnName="id")
  */
  protected $attacker;

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
     * Set turn
     *
     * @param integer $turn
     * @return Fights
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return integer
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Add users
     *
     * @param \AppBundle\Entity\Users $users
     * @return Fights
     */
    public function addUser(\AppBundle\Entity\Users $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \AppBundle\Entity\Users $users
     */
    public function removeUser(\AppBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    public function setParam($param,$value)
    {
        $this->$param = $value;

        return $this;
    }

    /**
     * Set f_h
     *
     * @param \AppBundle\Entity\Heroes $fH
     * @return Fights
     */
    public function setFH(\AppBundle\Entity\Heroes $fH = null)
    {
        $this->f_h = $fH;

        return $this;
    }

    /**
     * Get f_h
     *
     * @return \AppBundle\Entity\Heroes
     */
    public function getFH()
    {
        return $this->f_h;
    }

    /**
     * Set s_h
     *
     * @param \AppBundle\Entity\Heroes $sH
     * @return Fights
     */
    public function setSH(\AppBundle\Entity\Heroes $sH = null)
    {
        $this->s_h = $sH;

        return $this;
    }

    /**
     * Get s_h
     *
     * @return \AppBundle\Entity\Heroes
     */
    public function getSH()
    {
        return $this->s_h;
    }

    /**
     * Set hero_f_id
     *
     * @param \AppBundle\Entity\Heroes $heroFId
     * @return Fights
     */
    public function setHeroFId(\AppBundle\Entity\Heroes $heroFId = null)
    {
        $this->hero_f_id = $heroFId;

        return $this;
    }

    /**
     * Get hero_f_id
     *
     * @return \AppBundle\Entity\Heroes
     */
    public function getHeroFId()
    {
        return $this->hero_f_id;
    }

    /**
     * Set hero_s_id
     *
     * @param \AppBundle\Entity\Heroes $heroSId
     * @return Fights
     */
    public function setHeroSId(\AppBundle\Entity\Heroes $heroSId = null)
    {
        $this->hero_s_id = $heroSId;

        return $this;
    }

    /**
     * Get hero_s_id
     *
     * @return \AppBundle\Entity\Heroes
     */
    public function getHeroSId()
    {
        return $this->hero_s_id;
    }

    /**
     * Set attacker
     *
     * @param \AppBundle\Entity\Heroes $attacker
     * @return Fights
     */
    public function setAttacker(\AppBundle\Entity\Heroes $attacker = null)
    {
        $this->attacker = $attacker;

        return $this;
    }

    /**
     * Get attacker
     *
     * @return \AppBundle\Entity\Heroes 
     */
    public function getAttacker()
    {
        return $this->attacker;
    }
}
