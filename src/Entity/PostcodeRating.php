<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostcodeRating
 *
 * @ORM\Table(name="postcode_rating")
 * @ORM\Entity(repositoryClass="App\Repository\PostcodeRepository")
 */
class PostcodeRating
{
    /**
     * @var string
     *
     * @ORM\Column(name="postcode_area", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postcodeArea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rating_factor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ratingFactor;

    public function getPostcodeArea(): ?string
    {
        return $this->postcodeArea;
    }

    public function getRatingFactor(): ?string
    {
        return $this->ratingFactor;
    }

    public function setRatingFactor(?string $ratingFactor): self
    {
        $this->ratingFactor = $ratingFactor;

        return $this;
    }


}
