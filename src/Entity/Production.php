<?php

namespace App\Entity;
use App\Entity\Image;
use App\Entity\Performance;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ProductionRepository::class)
 * @Vich\Uploadable
 */
class Production
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
    * @ORM\Column(type="boolean")
    */
    private $enabled;
    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
    * @ORM\OneToOne(targetEntity="Image" ,cascade={"persist"})
    * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
    * 
    */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sub_title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;


    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;



    /**
     *
     * @Vich\UploadableField(mapping="prods_attachement", fileNameProperty="attachement")
     * @Assert\File(
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * 
     * @var File|null
     */
    private $attachementFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $attachement;


    /**
     * @ORM\ManyToMany(targetEntity="Performance" ,cascade={"persist"} )
     * @ORM\JoinTable(name="productions_performances",
     *      joinColumns={@ORM\JoinColumn(name="production_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="performance_id", referencedColumnName="id", unique=true)}
     *      )
     * 
     *
    */
    private $performances;


    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    
    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

 
     /**
     * @ORM\ManyToMany(targetEntity="Image" ,cascade={"persist"} )
     * @ORM\JoinTable(name="productions_galleries",
     *      joinColumns={@ORM\JoinColumn(name="production_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     *      )
     * 
     *
    */

    private $galleries;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updateAt = new \DateTime();
        $this->performances = new ArrayCollection();
        $this->galleries = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubTitle(): ?string
    {
        return $this->sub_title;
    }

    public function setSubTitle(string $sub_title): self
    {
        $this->sub_title = $sub_title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    public function setAttachementFile(?File $attachementFile = null): void
    {
        $this->attachementFile = $attachementFile;

        if (null !== $attachementFile) {

            $this->updatedAt = new \DateTime();
        }
    }

    public function getAttachementFile(): ?File
    {
        return $this->attachementFile;
    }

    public function getAttachement(): ?string
    {
        return $this->attachement;
    }

    public function setAttachement(string $attachement): self
    {
        $this->attachement = $attachement;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCover(): ?Image
    {
        return $this->cover;
    }

    public function setCover(?Image $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances[] = $performance;
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        $this->performances->removeElement($performance);

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Image $gallery): self
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries[] = $gallery;
        }

        return $this;
    }

    public function removeGallery(Image $gallery): self
    {
        $this->galleries->removeElement($gallery);

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
