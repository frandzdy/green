<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

trait NotificationModelTrait
{
    /**
     * Nom de la société du formulaire de contact.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    #[Assert\Length(max: 100)]
    private ?string $companyName;

    /**
     * Prénom du formulaire de contact.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    #[Assert\Length(max: 100)]
    private ?string $firstname;

    /**
     * Nom du formulaire de contacte.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    #[Assert\Length(max: 100)]
    private ?string $lastname;

    /**
     * E-mail du formulaire de contact.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    #[Assert\Email(message: 'Format e-mail incorrect.')]
    #[Assert\Length(max: 255)]
    private ?string $email;

    /**
     * Téléphone du formulaire de contact.
     */
    #[Assert\Length(max: 20, maxMessage: '20 caractères maximum.')]
    private ?string $phone = null;

    /**
     * Message du formulaire de contact.
     */
    #[Assert\NotBlank(message: 'Information requise.')]
    #[Assert\Length(max: 400, maxMessage: '400 caractères maximum.')]
    private ?string $message;

    /**
     * Retourne le nom de l'entreprise du contact.
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * Set le nom de l'entreprise du contact.
     */
    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Retourne le prénom du contact.
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set le prénom du contact.
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Retourne le nom du contact.
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * set le nom du contact.
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Retourne l'e-mail du contact.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set l'e-mail du contact.
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Retourne le téléphone du contact.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set le téléphone du contact.
     */
    public function setPhone(?string $phone = null): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Retourne le message.
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set le message.
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
