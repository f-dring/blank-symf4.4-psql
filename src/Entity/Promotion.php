<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PromotionHasProduct::class, mappedBy="promotion", orphanRemoval=true)
     */
    private $promotionHasProducts;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    public function __construct(User $user)
    {
        $this->promotionHasProducts = new ArrayCollection();
        $this->createdBy = $user;
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PromotionHasProduct[]
     */
    public function getPromotionHasProducts(): Collection
    {
        return $this->promotionHasProducts;
    }

    public function addPromotionHasProduct(PromotionHasProduct $promotionHasProduct): self
    {
        if (!$this->promotionHasProducts->contains($promotionHasProduct)) {
            $this->promotionHasProducts[] = $promotionHasProduct;
            $promotionHasProduct->setPromotion($this);
        }

        return $this;
    }

    public function removePromotionHasProduct(PromotionHasProduct $promotionHasProduct): self
    {
        if ($this->promotionHasProducts->contains($promotionHasProduct)) {
            $this->promotionHasProducts->removeElement($promotionHasProduct);
            // set the owning side to null (unless already changed)
            if ($promotionHasProduct->getPromotion() === $this) {
                $promotionHasProduct->setPromotion(null);
            }
        }

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
