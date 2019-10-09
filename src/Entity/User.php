<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invoice", mappedBy="user_ID")
     */
    private $user_ID;
    
    public function __construct()
    {
        parent::__construct();
        $this->user_ID = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getUserID(): Collection
    {
        return $this->user_ID;
    }

    public function addUserID(Invoice $userID): self
    {
        if (!$this->user_ID->contains($userID)) {
            $this->user_ID[] = $userID;
            $userID->setUserID($this);
        }

        return $this;
    }

    public function removeUserID(Invoice $userID): self
    {
        if ($this->user_ID->contains($userID)) {
            $this->user_ID->removeElement($userID);
            // set the owning side to null (unless already changed)
            if ($userID->getUserID() === $this) {
                $userID->setUserID(null);
            }
        }

        return $this;
    }
}