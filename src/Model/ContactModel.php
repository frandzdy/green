<?php

namespace App\Model;

use App\Enum\ContactSubject;
use Symfony\Component\Validator\Constraints as Assert;

class ContactModel
{
    use NotificationModelTrait;

    /**
     * Sujet du formulaire de, contactez-nous.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    private ?int $subject = null;

    /**
     * Retourne le sujet.
     */
    public function getSubject(): ?string
    {
        return ContactSubject::getLabel($this->subject);
    }

    /**
     * set le sujet.
     */
    public function setSubject(?int $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
