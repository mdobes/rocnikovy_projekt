<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Entity
 */
#[Entity]
class User
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    protected $id;

    /**
     * @Column(type="string")
     */
    #[Column(type: 'string')]
    private $username;

    /**
     * @Column(type="string")
     */
    #[Column(type: 'string')]
    private $password;

    /**
     * @Column(type="boolean")
     */
    #[Column(type: 'boolean')]
    private $isSuperAdmin;

    /**
     * @Column(type="boolean")
     */
    #[Column(type: 'boolean')]
    private $isDeleted = false;

    /**
     * @OneToMany(targetEntity="App\Entities\Post", mappedBy="author", cascade={"remove"})
     */
    #[OneToMany(targetEntity: Post::class, mappedBy: 'author')]
    private $posts;


    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $slug
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getIsSuperAdmin()
    {
        return $this->isSuperAdmin;
    }

    public function setSuperAdmin($superAdmin)
    {
        $this->isSuperAdmin = $superAdmin;
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    public function setIsDeleted($deleted)
    {
        $this->isDeleted = $deleted;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function addPost(Post $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }
}