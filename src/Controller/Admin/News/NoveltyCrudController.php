<?php

namespace App\Controller\Admin\News;

use App\Entity\Novelty;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Field\FileField;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use App\Form\PerformanceType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
 use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
class NoveltyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Novelty::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('/admin/galleries.css') ;
    }


    public function configureFields(string $pageName): iterable
    {

             
    return [
            BooleanField::new('enabled'),
            TextField::new('title'),
            ImageField::new('cover')->setBasePath('/images/posts/')->hideOnForm(),
            TextField::new('sub_title'),
            TextareaField::new('cover')->setFormType(ImageType::class)->onlyOnForms(),
            TextEditorField::new('content'),
            AssociationField::new('category'),
            CollectionField::new('galleries')->setEntryType(ImageType::class)->onlyOnForms(),
            CollectionField::new('galleries')->setTemplatePath('admin/post/galleries.html.twig')->onlyOnDetail()
          ];

 
    }
 
    public function configureActions(Actions $actions): Actions
    {
       return $actions->add(Crud::PAGE_INDEX,'detail');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsAsDropdown()
        ;
    }

 
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('sub_title')
            ->add('content')
            ->add('category') 
            ->add(BooleanFilter::new('enabled'))
        ;
    }

}
