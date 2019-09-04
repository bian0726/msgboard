<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Reply;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LuckyController extends AbstractController
{
    /**
     * @Route("/panel/{page}", name="app_panel", requirements={"page"="\d+"})
     */
    public function showMsgBoard(Request $request, $page = 1)
    {
        //建立留言輸入表單
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'send'])
            ->getForm();

        $em = $this->getDoctrine()->getManager();

        //分頁
        $pages = $em->getRepository(Message::class)->getTotalPage();
        $start = (($page - 1) * 3);
        $message = $em
            ->getRepository(Message::class)
            ->findBy([], ['updateTime' => 'desc'], 3, $start);

        //載入回復
        $reply = $em
            ->getRepository(Reply::class)
            ->findAll();

        //新增留言
        if ($request->getMethod() == Request::METHOD_POST) {
            $post = new Message();

            $form->handleRequest($request);
            $name = $form->getData()['name'];
            $content = $form->getData()['content'];

            $post->setUpdatetime(new \Datetime("now"));
            $post->setName($name);
            $post->setContent($content);
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_panel');
        }

        return $this->render('panel.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'reply' => $reply,
            'pages' => $pages]);
    }

    /**
     * @Route("/panel/reply/{id}", name="app_panel_reply", requirements={"id"="\d+"})
     */
    public function replyMsg(Request $request, $id)
    {
        //建立留言輸入表單
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'send'])
            ->getForm();

        //載入留言主檔
        $em = $this->getDoctrine()->getManager();
        $message = $em
            ->getRepository(Message::class)
            ->find($id);
        $form->handleRequest($request);

        if ($request->getMethod() == Request::METHOD_POST) {
            //建立回復
            $post = new Reply();
            $name = $form->getData()['name'];
            $content = $form->getData()['content'];

            //set data
            $post->setUpdatetime(new \Datetime("now"));
            $post->setName($name);
            $post->setContent($content);
            $post->setMessage($message);
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_panel');
        }

        return $this->render('reply.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/panel/del/{id}", name="app_panel_del", requirements={"id"="\d+"})
     */
    public function delMsg($id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em
            ->getRepository(Message::class)
            ->find($id);

        //處理刪除
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute('app_panel');
    }

    /**
     * @Route("/panel/put/{id}", name="app_panel_update", requirements={"id"="\d+"})
     */
    public function updateMsg(Request $request, $id)
    {
        //建立表單
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('content', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'update'])
            ->getForm();

        //載入留言
        $em = $this->getDoctrine()->getManager();
        $message = $em
            ->getRepository(Message::class)
            ->find($id);

        $form->get('name')->setData($message->getName());
        $form->get('content')->setData($message->getContent());

        //更新留言
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            $name = $form->getData()['name'];
            $content = $form->getData()['content'];
            $message->setUpdatetime(new \Datetime("now"));
            $message->setName($name);
            $message->setContent($content);
            $em->flush();

            return $this->redirectToRoute('app_panel');
        }

        return $this->render('reply.html.twig', ['form' => $form->createView()]);
    }
}
