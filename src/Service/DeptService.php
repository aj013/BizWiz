<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;


class DeptService
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
            $dept = $form->getData();
            $this->em->persist($dept);
            $this->em->flush();
            
            return $dept->getCode();
        } else {
            return false;
        }
    }
    function updateDept($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dept = $form->getData();
            $this->em->persist($dept);
            $this->em->flush();
            
            return $dept->getCode();
        } else {
            return false;
        }
    }
    function destroyDept($form, $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dept = $form->getData();
            $this->em->remove($dept);
            $this->em->flush();
            
            return $dept->getCode();
        } else {
            return false;
        }
    
    }
}
