<?php

namespace App\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\Form\Extension\Core\Type\FileUploadType;

final class FileField implements FieldInterface
{
    use FieldTrait;

 
 
    public static function new(string $propertyName, ?string $label = null  ): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/field/file.html.twig')
            ->setFormType(FileUploadType::class)
            ->addCssClass('field-url');
     }
 

     


}
