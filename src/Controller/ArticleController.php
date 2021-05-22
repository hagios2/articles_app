<?php


namespace App\Controller;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("article/index", name="article_index")
     *
     */
    public function index()
    {
//        $article = ArticleRepository::findAll();
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('articles/index.html.twig', ['articles' => $article]);
    }

    /**
     *@Route("/article/create", name="create_article")
     * @Method({"GET"}, {"POST"})
     */
    public function create(Request $request)
    {
        $article = new Article();

        $form  = $this->createFormBuilder($article)
        ->add('title', TextType::class, ['label' => 'Body', 'attr' => ['class' => 'form-control']])
        ->add('body', TextareaType::class, ['label' => 'Body', 'required' => false, 'attr' => ['class' => 'form-control']])
        ->add('Save', SubmitType::class, ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary mt-3']])
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $article = $form->getData();

            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->persist($article);

            $entitymanager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('articles/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/article/edit/{id}/details", name="article_update")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(int $id, Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form  = $this->createFormBuilder($article)
            ->add('title', TextType::class, ['label' => 'Body', 'attr' => ['class' => 'form-control']])
            ->add('body', TextareaType::class, ['label' => 'Body', 'required' => false, 'attr' => ['class' => 'form-control']])
            ->add('Save', SubmitType::class, ['label' => 'Edit', 'attr' => ['class' => 'btn btn-primary mt-3']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('articles/edit.html.twig', ['form' => $form->createView()]);
    }


    /**
    *@Route("/article/create", name="store_article")
    */
    public function store(Request $request, ValidatorInterface $validator)
    {
        $entitymanager = $this->getDoctrine()->getManager();

        $article = new Article();

        $article->setTitle('Keyboard');

        $article->setBody('Ergonomic and stylish!');

        $errors = $validator->validate($article);

        if(count($errors) > 0)
        {
            return new Response((string) $errors, 400);
        }

        $entitymanager->persist($article);

        $entitymanager->flush();

        return new Response('Saved new article with title '.$article->getTitle());
    }

    /**
     * @Route("/article/{article_id}/detail", name="show_article")
     * @Method({"GET"})
     */
    public function show(Article $article)
    {
//        $article = $this->getDoctrine()
//            ->getRepository(Article::class)
//            ->find($article_id);

        return $this->render('articles/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/article/{article_id}/update", name="show_article")
     * @Method({"GET"})
     */
    public function update(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $article->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('show_article', [
            'id' => $article->getId()
        ]);
    }

    /**
     * @Route("/articles/delete/{id}/article")
     * @Method({"DELETE"})
     */
    public function destroy($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

//        return $this->redirectToRoute('article_index', [
//            'id' => $article->getId()
//        ]);
    }
}