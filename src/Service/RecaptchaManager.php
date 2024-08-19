<?php

namespace App\Service;

use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\Client\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;
use GuzzleHttp\Client;
use \Exception;
use Psr\Log\LoggerInterface;

readonly class RecaptchaManager
{
    /**
     * Client guzzle.
     */
    protected Client $guzzle;

    public function __construct(private LoggerInterface $logger)
    {
        $this->guzzle = new Client(
            [
                'http_errors' => false,
            ]
        );
    }

    /**
     * Contrôle si le formulaire est envoyé par une personne et non un robot.
     */
    public function checkForm(string $googleRecaptchaSkey, string $token): bool
    {
        try {
            $res = $this->guzzle->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'form_params' => [
                        'secret' => $googleRecaptchaSkey,
                        'response' => $token,
                    ],
                ]
            );

            if ('200' == $res->getStatusCode()) {
                $this->logger->info('GOOGLE RECAPTCHA', json_decode($res->getBody(), true));

                return json_decode($res->getBody(), true)['success'];
            } else {
                $this->logger->error('GOOGLE RECAPTCHA', json_decode($res->getBody(), true));

                return false;
            }
        } catch (\Exception $exception) {
            $this->logger->error('GOOGLE RECAPTCHA ERROR', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    public function newCheckForm(string $token, string $action, string $recaptchaKey): void
    {
        // À FAIRE : mettre en cache le code de génération du client (recommandé) ou appeler client.close() avant de quitter la méthode.
        $client = new RecaptchaEnterpriseServiceClient();
        $projectName = $client->projectName("green");

        // Définissez les propriétés de l'événement à suivre.
        $event = (new Event())
            ->setSiteKey($recaptchaKey)
            ->setToken($token);

        // Créez la demande d'évaluation.
        $assessment = (new Assessment())
            ->setEvent($event);

        try {
            $response = $client->createAssessment(
                $projectName,
                $assessment
            );

            // Vérifiez si le jeton est valide.
            if ($response->getTokenProperties()->getValid() == false) {
                printf('The CreateAssessment() call failed because the token was invalid for the following reason: ');
                printf(InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
                return;
            }

            // Vérifiez si l'action attendue a été exécutée.
            if ($response->getTokenProperties()->getAction() == $action) {
                // Obtenez le score de risques et le ou les motifs.
                // Pour savoir comment interpréter l'évaluation, consultez les pages suivantes :
                // https://cloud.google.com/recaptcha-enterprise/docs/interpret-assessment
                printf('The score for the protection action is:');
                printf($response->getRiskAnalysis()->getScore());
            } else {
                printf(
                    'The action attribute in your reCAPTCHA tag does not match the action you are expecting to score'
                );
            }
        } catch (Exception $e) {
            printf('CreateAssessment() call failed with the following error: ');
            printf($e);
        }
    }
}
