<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\ImageType;
use App\Field\FileField ;
use App\Form\PerformanceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
 use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
 use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
 use Vich\UploaderBundle\Form\Type\VichFileType;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

     
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('category')
            ->add(BooleanFilter::new('status'))
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {

      //  $attachementFile = TextareaField::new('attachementFile')->setFormType(VichImageType::class);
    // $attachement = ImageField::new('attachement')->setBasePath('/attachements/posts');
        
    return [
            TextField::new('title'),
            TextField::new('sub_title'),
            TextEditorField::new('content'),
            AssociationField::new('category'),
            BooleanField::new('status'),
            TextareaField::new('attachementFile')->setFormType(VichFileType::class)->onlyOnForms(),
            FileField::new('attachement')
            ->formatValue(function ($value) {
            return "/attachements/programs/".$value;
            })
             ->hideOnForm(),            
            CollectionField::new('performances')->setEntryType(PerformanceType::class)->onlyOnForms(),
            CollectionField::new('performances')->setTemplatePath('admin/post/performances.html.twig')->onlyOnDetail(),
            CollectionField::new('galleries')->setEntryType(ImageType::class)->onlyOnForms(),
            CollectionField::new('galleries')->setTemplatePath('admin/post/galleries.html.twig')->onlyOnDetail()
          ];


       /*   if( $pageName ==Crud::PAGE_DETAIL || $pageName ==Crud::PAGE_INDEX ) 
            $fields[] = $attachement;
           else
           $fields[] = $attachementFile;

        return $fields;*/
    }
 
    public function configureActions(Actions $actions): Actions
    {
       return $actions->add(Crud::PAGE_INDEX,'detail');
    }
    
}
