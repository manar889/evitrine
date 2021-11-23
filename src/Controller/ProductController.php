<?php



namespace App\Controller;


use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();
        #$products = ["article1", "article2", "article2"];
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
    /**
     * @Route("/product/add", name="add")
     */
    public function add(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setLib("libtest2")
            ->setPu(500)
            ->setDscr("test description de l'article")
            ->setImg("http://placehold.it/350*150");
        $manager->persist($product);
        $manager->flush();
        return new Response("ajout validée" . $product->getId());
    }
    /**
     * @Route("/product/detail/{id}", name="detail")
     */
    public function detail($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id);
        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/product/delete/{id}", name="delete")
     */
    public function delete($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($product);
        $manager->flush();
        #return $this->render('product/detail.html.twig', [
        # 'product' => $product,
        #]);
        return $this->redirectToRoute('product');
    }
    /**
     * @Route("/product/add2", name="add2")
     */
    public function new(Request $request): Response
    {

        $prod = new Product();

        $form = $this->createForm(ProductType::class, $prod);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $prod->getImg();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                
            }
            $entityManager = $this->getDoctrine()->getManager();
            $prod->setImg($fileName);
            $entityManager->persist($prod);
            $entityManager->flush();

            return $this->redirectToRoute('product');
        }

        return $this->renderForm('product/new.html.twig', [
            'formpro' => $form,
        ]);
    }
}
