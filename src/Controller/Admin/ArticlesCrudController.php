<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }
    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm(); 
            yield IdField::new('user')->hideOnForm();    
            yield TextField::new('title');
            yield TextEditorField::new('article');
            yield DateTimeField::new('date')->hideOnForm();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setDate(new \DateTime("", new \DateTimeZone('Europe/Paris')));
        $entityInstance->setUser($this->getUser());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
