<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user', name: 'user_')]
#[IsGranted(User::ROLE_USER_OPERATOR)]
class UserController extends AbstractController
{
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function index(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $query = $em->getRepository(User::class)->getActiveUsers();
        $users = $paginator->paginate(
            $query,
            $request->getPayload()->getInt('page', 1),
            10
        );

        return $this->render('back/user/list.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/{user}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        UserManager $userManager,
        ?User $user = null
    ): Response {
        $validationGroups = ['Default'];
        if (!$user) {
            $user = new User();
            $validationGroups[] = 'creation';
        }

        $isAdmin = \in_array(User::ROLE_SUPER_ADMIN, $this->getUser()->getRoles());

        $form = $this->createForm(
            UserType::class,
            $user,
            [
                'isAdmin' => $isAdmin,
                'action' => $request->getRequestUri(),
                'validation_groups' => $validationGroups,
            ]
        );

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            if ($user->getId()) {
                $this->addFlash('success', 'Modification effectué.');
            } else {
                $this->addFlash('success', 'Création effectué.');
            }
            $user = $form->getData();

            $userManager->createOrUpdate($user);

            return $this->json(
                [
                    'success' => true,
                    'redirectUrl' => $this->generateUrl('back_user_list'),
                ]
            );
        }

        return $this->render('back/user/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{user}/delete', name: 'delete', methods: ['POST'])]
    public function delete(User $user, UserManager $userManager): Response
    {
        try {
            $userManager->delete($user);
            $this->addFlash('success', 'Suppression effectuée.');
        } catch (\Exception) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }

        return $this->redirectToRoute('back_user_list');
    }
}
