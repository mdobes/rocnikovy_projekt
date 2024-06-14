<?php

namespace App\Entities;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Entity
 */
#[Entity]
class Post
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
    private $title;

    /**
     * @Column(type="string")
     */
    #[Column(type: 'string')]
    private $slug;

    /**
     * @Column(type="text")
     */
    #[Column(type: 'string')]
    private $perex;

    /**
     * @Column(type="text")
     */
    #[Column(type: 'string')]
    private $content;

    /**
     * @Column(type="boolean")
     */
    #[Column(type: 'boolean')]
    protected $isActive;

    /**
     * @Column(type="datetime")
     */
    #[Column(type: 'datetime')]
    protected $publish_date;

    /**
     * @Column(type="datetime", nullable=true)
     */
    #[Column(type: 'datetime', nullable: true)]
    protected $updatedAt;

    /**
     * @Column(type="datetime", nullable=true)
     */
    #[Column(type: 'datetime', nullable: true)]
    protected $createdAt;

    /**
     * @ManyToOne(targetEntity="App\Entities\User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE", nullable=false
     */
    #[ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    #[JoinColumn(nullable: false)]
    protected $author;

    /**
     * @Column(type="string")
     */
    #[Column(type: 'string')]
    private $coverImage;

    /**
     * @Column(type="integer")
     */
    #[Column(type: 'integer')]
    private $readingTime;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        $slug = new Slugify();
        $this->setSlug($slug->slugify($title));

        $this->updatedAt = new \DateTime();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getPerex()
    {
        return $this->perex;
    }

    public function setPerex($perex)
    {
        $this->perex = $perex;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;

        $wordCount = str_word_count(strip_tags($content));
        $readingTime = round($wordCount / 265); // Prumerny pocet prectenych slov za minutu

        if($readingTime < 1) $readingTime = 1; // Kvuli prilis kratkym prispevkum

        $this->setReadingTime($readingTime);
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getPublishDate()
    {
        return $this->publish_date;
    }

    public function setPublishDate($publishDate)
    {
        $this->publish_date = $publishDate;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($active)
    {
        $this->isActive = $active;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(User $user = null)
    {
        $this->author = $user;

        return $this;
    }

    public function getCoverImage()
    {
        return $this->coverImage;
    }

    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;
    }

    public function getReadingTime()
    {
        return $this->readingTime;
    }

    public function setReadingTime($readingTime)
    {
        $this->readingTime = $readingTime;
    }
}