<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="integer")
     */
    private $clicks;

    /**
     * @ORM\OneToMany(targetEntity=PromotionHasProduct::class, mappedBy="product", orphanRemoval=true)
     */
    private $promotionOfProduct;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    public function __construct()
    {
        $this->promotionOfProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * @return Collection|PromotionHasProduct[]
     */
    public function getPromotionOfProduct(): Collection
    {
        return $this->promotionOfProduct;
    }

    public function addPromotionOfProduct(PromotionHasProduct $promotionOfProduct): self
    {
        if (!$this->promotionOfProduct->contains($promotionOfProduct)) {
            $this->promotionOfProduct[] = $promotionOfProduct;
            $promotionOfProduct->setProduct($this);
        }

        return $this;
    }

    public function removePromotionOfProduct(PromotionHasProduct $promotionOfProduct): self
    {
        if ($this->promotionOfProduct->contains($promotionOfProduct)) {
            $this->promotionOfProduct->removeElement($promotionOfProduct);
            // set the owning side to null (unless already changed)
            if ($promotionOfProduct->getProduct() === $this) {
                $promotionOfProduct->setProduct(null);
            }
        }

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
