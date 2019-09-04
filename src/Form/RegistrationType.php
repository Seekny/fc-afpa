<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Utilisateur;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_utilisateur')
            ->add('prenom_utilisateur')
            ->add('email_utilisateur')
            ->add('telephone_utilisateur')
            ->add('adresse_utilisateur')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('username')
            ->add('departement', EntityType::class, [
                'class' => 'App\Entity\Departement',
                'placeholder' => 'Sélectionnez votre département',
                'mapped' => false,
                'required' => false
            ])
        ;

        $builder->get('departement')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event)
            {
                $form = $event->getForm();
                $this->addVilleField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /* @var $ville Ville */
                $ville = $data->getVille();
                $form = $event->getForm();
                if (! $ville) 
                {
                    $this->addVilleField($form, null);
                }
            }
        );
    }

    /**
     * Rajoute un champs departement au formulaire
     * @param FormInterface $form
     * @param Departement $departement
     */
    private function addVilleField(FormInterface $form, ?Departement $departement)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder('ville', EntityType::class, null, [
            'class' => 'App\Entity\Ville',
            'placeholder' => $departement ? 'Sélectionnez votre ville' : 'Sélectionnez d\'abord votre département',
            'mapped' => false,
            'auto_initialize' => false,
            'required' => false,
            'choices' => $departement ? $departement->getPosseder() : []
            ]
        );
        $form->add($builder->getForm());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
