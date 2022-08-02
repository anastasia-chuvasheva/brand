<?php

namespace App\Form;

use App\Repository\BrandRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NamePieceType extends AbstractType
{
    /**
     * @var BrandRepository
     */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('piece', TextType::class)
           ->add('submit', SubmitType::class);
    }

}