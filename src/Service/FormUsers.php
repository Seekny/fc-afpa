<?php

namespace App\Service;

use App\Form\RegistrationType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;

class FormUsers
{
 
 private $form; 
 
 private $router;
 
 private $formFactory;
 
 public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory) {
 
 $this->router = $router;
 
 $this->formFactory = $formFactory;
 
 $this->form = $this->formFactory->create(
RegistrationType::class,
 NULL, 
 array(
 'attr' => 
 array(
 'action' => $this->router->generate('add-users')
 )
 )
 );
 }
 
 public function getForm() {
 return $this->form;
 }
}