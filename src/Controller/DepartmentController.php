<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Service\DeptService;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

/**
     * @Route("/department", name="department")
     */
class DepartmentController extends AbstractController
{
    /**
     * @Route("", name=".index")
     */
    public function index(DepartmentRepository $deptRepo): Response
    {
        $dept = $deptRepo->findAll();

        return $this->render('department/index.html.twig', [
            'department' =>$dept,
        ]);
    }

     /**
     * @Route("/add", name=".add")
     */
    public function add(Request $request,DeptService $deptserv)
    {
        $dept = new Department();
        $form = $this->createForm(DepartmentType::class,$dept);
        $dept = $deptserv->createDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('success','Succesfully added '.$dept);
          
            return $this->redirectToRoute('department.index');
        }
        return $this->render('department/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'add',
        ]);
    }
     /**
     * @Route("/edit/{id}", name=".edit")
     */
    public function edit($id,DepartmentRepository $deptRepo,DeptService $deptserv,Request $request)
    {


        $dept = $deptRepo->findOneById($id);
        $form = $this->createForm(DepartmentType::class,$dept);
        $dept = $deptserv->updateDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('success','Succesfully updated '.$dept);
          
            return $this->redirectToRoute('department.index');
        }
        return $this->render('department/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'edit',
            'department' => $dept,
        ]);
    }
     /**
     * @Route("/delete/{id}", name=".delete")
     */
    public function delete($id,DepartmentRepository $deptRepo,DeptService $deptserv,Request $request)
    {
       // dump($request);
        $dept = $deptRepo->findOneById($id);
        $form = $this->createForm(DepartmentType::class,$dept);
        $dept = $deptserv->destroyDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('danger','Succesfully deleted '.$dept);
          
            return $this->redirectToRoute('department.index');
        }
        return $this->render('department/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'delete',
        ]);
    }
     /**
     * @Route("/show", name=".show")
     */
    public function show(Request $request,DeptService $deptserv)
    {
        $dept = new Department();
        $form = $this->createForm(DepartmentType::class,$dept);
        $dept = $deptserv->createDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('success','Succesfully added '.$dept);
          
            return $this->render('department/index.html.twig', [
                'department' => $form->createView(),
                'method' => 'add',
            ]);
        }
        return $this->render('department/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'add',
        ]);
    }
   
}
