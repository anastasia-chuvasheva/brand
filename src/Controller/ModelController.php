<?php

namespace App\Controller;

use App\Entity\Model;
use App\Form\ModelType;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModelController extends AbstractController
{
    #[Route('/model', name: 'model_show_all')]
    public function showAll(ModelRepository $modelRepository): Response
    {
        $models = $modelRepository->findAll();

        return $this->render('model/index.html.twig', [
            'models' => $models,
        ]);
    }

    #[Route('/model/show/{model}', name: 'model_show_one')]
    public function showOne(Model $model): Response
    {

        return $this->render('model/show_one.html.twig', [
            'model' => $model,
        ]);
    }

    #[Route('/model/create', name: 'model_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $model = new Model();

        $form = $this->createForm(ModelType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $model = $form->getData();
            $entityManager->persist($model);
            $entityManager->flush();
            return $this->redirectToRoute('model_show_all');
        }

        return $this->renderForm('model/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/model/update/{model}', name: 'model_update')]
    public function update(Request $request, EntityManagerInterface $entityManager, Model $model): Response
    {
        $form = $this->createForm(ModelType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $model = $form->getData();
            $entityManager->persist($model);
            $entityManager->flush();

            return $this->redirectToRoute('model_show_all');
        }

        return $this->renderForm('model/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/model/delete/{model}', name: 'model_delete')]
    public function delete(EntityManagerInterface $entityManager, Model $model): Response
    {

        $entityManager->remove($model);
        $entityManager->flush();

        return $this->redirectToRoute('model_show_all');

    }
}
