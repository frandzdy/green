<?php

namespace App\Service;

use App\Exception\FileNotFoundException;
use Liip\ImagineBundle\Message\WarmupCache;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Gestionnaire des fichiers de l'application.
 */
class FileUploadManager
{
    /**
     * Constructor.
     *
     * @param mixed $fileUploadParameters
     */
    public function __construct(
        protected LoggerInterface $logger,
        #[Autowire('%file_uploader_config%')]
        protected array $fileUploadParameters,
        protected SluggerInterface $slugger
    ) {}

    /**
     * Déplace un fichier dans le dossier qui lui correspond et retourne son nouveau nom.
     */
    public function uploadPrivateFile(string $directory, UploadedFile $file): string
    {
        try {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $fileName = $safeFilename.'-'.\uniqid().'.'.$file->guessExtension();
            $file->move($this->getDirectoryPrivatePath($directory), $fileName);

            return $fileName;
        } catch (\Exception $exception) {
            $this->logger->error('Erreur upload fichier : ', ['message' => $exception->getMessage()]);

            return '';
        }
    }

    /**
     * Retourne le nom du répertoire recherché.
     */
    public function getDirectoryPrivatePath(string $directory): string
    {
        $path = $this->fileUploadParameters['base_path_private'];

        return $path.($this->fileUploadParameters['directories'][$directory] ?? $this->fileUploadParameters['directories']['default']);
    }
}
