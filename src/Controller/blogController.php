<?php

namespace App\Controller;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Form\postType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


class blogController  extends AbstractController
{

    private $formFactory;
    private $entityManager;
    private $router;
    private $flashBag;

    public function __construct(FormFactoryInterface $formFactory,
    EntityManagerInterface $entityManager,RouterInterface $router,FlashBagInterface $flashBag)
    {
        $this->formFactory = $formFactory;
        $this->entityManager=$entityManager;
        $this->router = $router;
        $this->flashBag = $flashBag;
    }

           /**
           * 
           * @route("/",name="home")
           */
    public function index(){
        $repo=$this->getDoctrine()->getRepository(Post::class);

        $posts=$repo->findAll();
        return $this->render('index.html.twig',[
            'posts'=>$posts,
        ]);
    }

 
          /**
    *@route("/add",name="post_add")
    
    */

    public function add(Request $request)
    {
        $post=new Post();
        $form =$this->formFactory->create(postType::class,$post);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) 
        {
           $this->entityManager->persist($post);
           $this->entityManager->flush();
           $this->flashBag->add('notice','post Added successfully!');

           return new RedirectResponse($this->router->generate('home'));

        }
         return $this->render('add.html.twig',[
              'form'=> $form->createView(),
         ]); 
    }


          /**
    *@route("/blog/edit/{id}", name="blog_edit")
    
    */
    public function edit(Post $post,Request $request) 
    {
        $form =$this->formFactory->create(postType::class,$post);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()) 
        {
           $this->entityManager->persist($post);
           $this->entityManager->flush();
           $this->flashBag->add('notice','post Updated successfully!');

           return new RedirectResponse($this->router->generate('home'));

        }
         return $this->render('edit.html.twig',[
              'form'=> $form->createView(),
         ]); 
    }

              /**
    *@route("/blog/delete/{id}", name="blog_delete")
    
    */

    public function delete(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
        $this->flashBag->add('notice','post Deleted successfully!');
        return new RedirectResponse($this->router->generate('home'));

    }




    /**
     * @route("/blog/show/{id}",name="blog_show")
     */

     public function show($id)
     {

        $repo=$this->getDoctrine()->getRepository(Post::class);
        $post=$repo->find($id);

        return $this->render('show.html.twig',[
             'post'=>$post,
        ]);
     }



}

























?>