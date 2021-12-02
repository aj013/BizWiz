<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;

class EmployeeService
{
    private $em;


    function __construct(EntityManagerInterface $emi)
    {
        $this->em = $emi;
    }

    function createDept($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emp = $form->getData();
            $this->em->persist($emp);
            $this->em->flush();
            
            return $emp->getFullname();
        } else {
            return false;
        }
    }
    function updateDept($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emp = $form->getData();
            $this->em->persist($emp);
            $this->em->flush();
            
            return $emp->getFullname();
        } else {
            return false;
        }
    }
    function destroyDept($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emp = $form->getData();
            $this->em->remove($emp);
            $this->em->flush();
            
            return $emp->getFullname();
        } else {
            return false;
        }
    
    }
}
