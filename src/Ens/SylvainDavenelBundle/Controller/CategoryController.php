<?php

namespace Ens\SylvainDavenelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ens\SylvainDavenelBundle\Entity\Category;
use Ens\SylvainDavenelBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/ens_category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Route("/", name="ens_category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('Euse Symfony\Bundle\FrameworkBundle\Controller\Controller;nsSylvainDavenelBundle:Category')->findAll();

        return $this->render('EnsSylvainDavenelBundle:category:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/new", name="ens_category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('Ens\SylvainDavenelBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('ens_category_show', array('id' => $category->getId()));
        }

        return $this->render('EnsSylvainDavenelBundle:category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{slug}", name="ens_category_show")
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $category = $em->getRepository('EnsSylvainDavenelBundle:Category')->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $category->setActiveJobs($em->getRepository('EnsSylvainDavenelBundle:Job')->getActiveJobs($category->getId()));

        return $this->render('EnsSylvainDavenelBundle:category:show.html.twig', array(
            'category' => $category,
        ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="ens_category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('Ens\SylvainDavenelBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('ens_category_edit', array('id' => $category->getId()));
        }

        return $this->render('EnsSylvainDavenelBundle:category:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}", name="ens_category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('ens_category_index');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ens_category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
