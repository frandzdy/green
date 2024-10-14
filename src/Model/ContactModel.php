<?php

namespace App\Model;

use App\Enum\ContactSubject;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class ContactModel
{
    use NotificationModelTrait;

    /**
     * Sujet du formulaire de, contactez-nous.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    private ?string $subject = null;

    #[Assert\File(maxSize: '2M', mimeTypes: ['application/pdf', 'application/x-pdf'])]
    public ?UploadedFile $uploadFile = null;

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
    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getUploadFile(): ?UploadedFile
    {
        return $this->uploadFile;
    }

    public function setUploadFile(?UploadedFile $uploadFile): void
    {
        $this->uploadFile = $uploadFile;
    }
}
