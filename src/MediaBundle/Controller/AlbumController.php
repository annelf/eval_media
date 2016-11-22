<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MediaBundle\Form\AlbumType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Album controller.
 *
 * @Route("album")
 */
class AlbumController extends Controller
{
    /**
     * Lists all album entities.
     *
     * @Route("/", name="album_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('MediaBundle:Album')->findAll();

        return $this->render('album/index.html.twig', array(
            'albums' => $albums,
        ));
    }

    /**
     * Creates a new album entity.
     *
     * @Route("/new", name="album_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $album = new Album();
        $form = $this->createForm('MediaBundle\Form\AlbumType', $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush($album);

            return $this->redirectToRoute('album_show', array('id' => $album->getId()));
        }

        return $this->render('album/new.html.twig', array(
            'album' => $album,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a album entity.
     *
     * @Route("/{id}", name="album_show")
     * @Method("GET")
     */
    public function showAction(Album $album)
    {
        $deleteForm = $this->createDeleteForm($album);

        return $this->render('album/show.html.twig', array(
            'album' => $album,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing album entity.
     *
     * @Route("/{id}/edit", name="album_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Album $album)
    {
        $deleteForm = $this->createDeleteForm($album);
        $editForm = $this->createForm('MediaBundle\Form\AlbumType', $album);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('album_edit', array('id' => $album->getId()));
        }

        return $this->render('album/edit.html.twig', array(
            'album' => $album,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a album entity.
     *
     * @Route("/{id}", name="album_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Album $album)
    {
        $form = $this->createDeleteForm($album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush($album);
        }

        return $this->redirectToRoute('album_index');
    }

    /**
     * Creates a form to delete a album entity.
     *
     * @param Album $album The album entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Album $album)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('id' => $album->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/product/new", name="app_product_new")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(AlbumType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but the original `$task` variable has also been updated
            $album = $form->getData();
            $file = $album->getImage();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $album->setImage($fileName);

            // ... perform some action, such as saving the thask to the database
            // for example if task is a Doctrine entity save it !
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('album_index');
        }

        return $this->render('album/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
