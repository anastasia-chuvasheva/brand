<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Form\BrandWithManyModelsType;
use App\Form\NamePieceType;
use App\Repository\BrandRepository;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController

{
    #[Route('/brand', name: 'brand_show_all')]
    public function showAll(BrandRepository $brandRepository): Response
    {
        $brands = $brandRepository->findAll();

        return $this->render('brand/index.html.twig', [
            'brands' => $brands,
        ]);
    }

    #[Route('/brand/show/{brand}', name: 'brand_show_one')]
    public function showOne(ModelRepository $modelRepository, Brand $brand, Request $request): Response
    {
        $form = $this->createForm(NamePieceType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $piece = $data['piece'];

            $foundModels = $modelRepository->findModelsByAPiece($piece, $brand);

            return $this->renderForm('brand/show_one.html.twig', [
                'form' => $form,
                'brand' => $brand,
                'models' => $foundModels,
            ]);

        }

        return $this->renderForm('brand/show_one.html.twig', [
            'form' => $form,
            'brand' => $brand,
            'models' => $brand->getModels()
        ]);

    }

    #[Route('/brand/choose-one-with-many', name: 'brand_choose_one_with_many')]
    public function chooseOneWithMany(Request $request): Response
    {
//        $brands = $brandRepository->findBrandsWithManyModels(2);

        $form = $this->createForm(BrandWithManyModelsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            return $this->redirectToRoute('brand_show_one', [
                'brand' => $data['brand']->getId(),
            ]);
        }

        return $this->renderForm('brand/choose_brand_with_many.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/brand/create', name: 'brand_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brand = $form->getData();

            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('brand_show_all');
        }

        return $this->renderForm('brand/create.html.twig', [
            'form' => $form,
        ]);

    }

//    #[Route('/brand/create2', name: 'brand_create2')]
//    public function create2(BrandRepository $brandRepository, Request $request): Response
//    {
//        $brand = new Brand();
//        $form = $this->createForm(BrandType::class, $brand);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $brand = $form->getData();
//
//            $brandRepository->add($brand);
//
//            return $this->redirectToRoute('brand_show_all');
//        }
//
//        return $this->renderForm('brand/create.html.twig', [
//            'form' => $form,
//        ]);
//
//    }

    #[Route('/brand/update/{brand}', name: 'brand_update')]
    public function update(EntityManagerInterface $entityManager, Request $request, Brand $brand): Response
    {
        $form = $this->createForm(BrandType::class, $brand);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brand = $form->getData();

            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('brand_show_all');
        }

        return $this->renderForm('brand/update.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/brand/delete/{brand}', name: 'brand_delete')]
    public function delete(EntityManagerInterface $entityManager, Brand $brand): Response
    {
        $entityManager->remove($brand);
        $entityManager->flush();

        return $this->redirectToRoute('brand_show_all');
    }

}
