<?php

namespace App\Enum;

/**
 * ContactSubject.
 */
enum ContactSubject: int
{
    public const SUBJECT_CREATE = 1;

    public const SUBJECT_REBUILD = 2;

    public const SUBJECT_AUDITION = 3;

    public const SUBJECT_JOIN_US = 4;

    public const SUBJECT_OTHER = 5;

    /**
     * Retourne la liste des sujets contacts disponibles.
     *
     * @return array<int, string>
     */
    public static function getAvailableContactSubjects(): array
    {
        return [
            self::SUBJECT_CREATE => 'Création d\'un site internet éco-responsable',
            self::SUBJECT_REBUILD => 'Refonte de votre site internet',
            self::SUBJECT_AUDITION => 'Auditer votre site internet',
            self::SUBJECT_JOIN_US => 'Nous rejoindre',
            self::SUBJECT_OTHER => 'Autre',
        ];
    }

    /**
     * Retourne la liste des sujets contacts disponibles.
     */
    public static function getLabel(?int $key = null): ?string
    {
        $arrayContactSubject = self::getAvailableContactSubjects();

        return $key ? $arrayContactSubject[$key] : '';
    }

    /**
     * Affiche le label de l'item.
     */
    public function label(): ?string
    {
        return self::getAvailableContactSubjects()[$this->value] ?? null;
    }
}
