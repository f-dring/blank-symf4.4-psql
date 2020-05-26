<?php

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
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="createdBy")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=PromotionHasProduct::class, mappedBy="createdBy")
     */
    private $promotionsHaveProducts;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="createdBy")
     */
    private $promotions;

    public function __construct()
    {
        parent::__construct();
        // your own logic

        $this->products = new ArrayCollection();
        $this->promotionsHaveProducts = new ArrayCollection();
        $this->promotions = new ArrayCollection();    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCreatedBy() === $this) {
                $product->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PromotionHasProduct[]
     */
    public function getPromotionsHaveProducts(): Collection
    {
        return $this->promotionsHaveProducts;
    }

    public function addPromotionsHaveProduct(PromotionHasProduct $promotionsHaveProduct): self
    {
        if (!$this->promotionsHaveProducts->contains($promotionsHaveProduct)) {
            $this->promotionsHaveProducts[] = $promotionsHaveProduct;
            $promotionsHaveProduct->setCreatedBy($this);
        }

        return $this;
    }

    public function removePromotionsHaveProduct(PromotionHasProduct $promotionsHaveProduct): self
    {
        if ($this->promotionsHaveProducts->contains($promotionsHaveProduct)) {
            $this->promotionsHaveProducts->removeElement($promotionsHaveProduct);
            // set the owning side to null (unless already changed)
            if ($promotionsHaveProduct->getCreatedBy() === $this) {
                $promotionsHaveProduct->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setCreatedBy($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->contains($promotion)) {
            $this->promotions->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getCreatedBy() === $this) {
                $promotion->setCreatedBy(null);
            }
        }

        return $this;
    }
}
