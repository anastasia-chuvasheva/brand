<?php

namespace App\Form;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandWithManyModelsType extends AbstractType
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choices' => $this->brandRepository->findBrandsWithManyModels(3),
                'choice_label' => 'name',
                'label' => false,

        ])
            ->add('submit', SubmitType::class);
    }
}