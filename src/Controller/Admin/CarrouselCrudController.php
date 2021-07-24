<?php

namespace App\Controller\Admin;

use App\Entity\Carrousel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
 use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
  use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
class CarrouselCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrousel::class;
    }

    public function configureActions(Actions $actions): Actions
    {
       return $actions->add(Crud::PAGE_INDEX,'detail');
    }


    public function configureFields(string $pageName): iterable
    {

             
    return [
            BooleanField::new('enabled'),
            TextField::new('title'),
            ImageField::new('cover')->setBasePath('/images/posts/')->hideOnForm(),
            TextEditorField::new('description'),
            TextareaField::new('cover')->setFormType(ImageType::class)->onlyOnForms(),
            TextField::new('link'),

   
          ];

 
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsAsDropdown()
        ;
    }
}
