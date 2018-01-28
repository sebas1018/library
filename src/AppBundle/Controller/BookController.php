<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Category;
use AppBundle\Entity\Book;
use AppBundle\Entity\delivery;

class BookController extends Controller
{
    /**
    * @Route("book/create", name="createBook")
    */
    public function createBook(){
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('@App/book/createBook.html.twig', array('categories' =>$categories));
    }

    /**
     * @Route("/book/addBook" , name="addBook")
     * @Method({"POST"})
     */
     public function addBook(Request $request){

         $category = $this->getDoctrine()->getRepository(Category::class)->findOneById($request->request->get('category_id'));
         $book = new Book();
         $book->setCategory($category);
         $book->setTitulo($request->request->get('titulo'));
         $book->setAutor($request->request->get('autor'));
         $book->setMinAge($request->request->get('minAge'));
         $book->setMaxAge($request->request->get('maxAge'));

         $em  = $this->getDoctrine()->getManager();
         $em->persist($book);
         $em->flush();

        return $this->redirectToRoute('homepage');
     }

     /**
      * @Route("/book/showBooks" , name="showBooks")
      */
     public function showBooksToDelivery(){
        $books = $this->getDoctrine()->getRepository(Book::class)->getAvailableBooks();
        return $this->render('@App/book/showBookToDelivery.html.twig',array('books' => $books));
     }

     /**
      * @Route("/book/deliverBook" , name="deliverBook")
      * @Method({"POST"})
      */
      public function deliveryBook(Request $request){

          $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
          $user  = $this->getUser();
          $book = $this->getDoctrine()->getRepository(Book::class)->findOneById($request->request->get('book'));

          if($user->getAge() >= $book->getMinAge()){
              $date_delivery = new \DateTime(date('Y-m-d'));
              $delivery = new delivery();
              $delivery->setDateDelivery($date_delivery);
              $delivery->setBook($book);
              $delivery->setUser($user);
              $delivery->setIsReturned(false);

              $em  = $this->getDoctrine()->getManager();
              $em->persist($delivery);
              $em->flush();

              $this->addFlash('success','Se ha realizado la solicitud con éxito');
              return $this->redirectToRoute('homepage');
          }
          else{
            $this->addFlash('error','No puedes solicitar este libro, no cumples con la Edad requerida');
            return $this->redirect('showBooks');
          }
      }
}
