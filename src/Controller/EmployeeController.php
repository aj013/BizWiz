<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EmployeeService;
use App\Service\DeptService;
use App\Repository\EmployeesRepository;
    /**
     * @Route("/employee", name="employee")
     */
class EmployeeController extends AbstractController
{
    /**
     * @Route("", name=".index")
     */
    public function index(EmployeesRepository $empRepo): Response
    {
        $emp = $empRepo->findAll();

        return $this->render('employee/index.html.twig', [
            'employee' =>$emp,
        ]);
    }
    /**
     * @Route("/add", name=".add")
     */
    public function add(Request $request,EmployeeService $empserv)
    {
        $dept = new Employees();
        $form = $this->createForm(EmployeeType::class,$dept);
        $dept = $empserv->createDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('success','Succesfully added '.$dept);
          
            return $this->redirectToRoute('employee.index');
        }
        return $this->render('employee/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'add',
        ]);
    }
     /**
     * @Route("/edit/{id}", name=".edit")
     */
    public function edit($id,EmployeesRepository $deptRepo,EmployeeService $empserv,Request $request)
    {


        $dept = $deptRepo->findOneById($id);
        $form = $this->createForm(EmployeeType::class,$dept);
        $dept = $empserv->updateDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('success','Succesfully updated '.$dept);
          
            return $this->redirectToRoute('employee.index');
        }
        return $this->render('employee/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'edit',
            'department' => $dept,
        ]);
    }
     /**
     * @Route("/delete/{id}", name=".delete")
     */
    public function delete($id,EmployeesRepository $deptRepo,EmployeeService $empserv,Request $request)
    {
       // dump($request);
        $dept = $deptRepo->findOneById($id);
        $form = $this->createForm(EmployeeType::class,$dept);
        $dept = $empserv->destroyDept($form,$request);
        if($dept !== false)
        {
            $this->addFlash('danger','Succesfully deleted '.$dept);
          
            return $this->redirectToRoute('employee.index');
        }
        return $this->render('employee/form.html.twig', [
            'form' => $form->createView(),
            'method' => 'delete',
        ]);
    }
     /**
     * @Route("/show", name=".show")
     */
    public function show(Request $request,DeptService $deptserv)
    {
        $dept = new Employees();
        $form = $this->createForm(EmployeeType::class,$dept);
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
