<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
#[Route('/api')]
class PostController extends AbstractController
{
    /**
     * NOTE: For standard formats, Symfony will also automatically choose the best
     * Content-Type header for the response.
     *
     * See https://symfony.com/doc/current/routing.html#special-parameters
     */
    #[Route('/post', name: 'post_index', defaults: ['page' => '1', '_format'=>'application/json'], methods: ['GET'])]
    #[Cache(smaxage: 10)]
    public function index(Request $request, int $page, PostRepository $posts):Response
    {
        $data = [];
        $finded = $posts->findAll();
        if($finded) {
            foreach($finded as $post){
                $author = $post->getAuthor();
                $data[] = [
                    'title'=>$post->getTitle(),
                    'summary'=>$post->getSummary(),
                    'content'=>$post->getContent(),
                    'publishedAt' => $post->getPublishedAt(),
                    'author' => [
                        "fullname"=>$author->getFullName(),
                        "slug"=>$author->getUsername()
                    ],
                    'tags' => $post->getTags()
                ];
            }
        }
        $return  = [
            'success'=> (!empty($data))? true : false,
            'count' => (!empty($data))? count($data) : 0,
            'payload'=> (!empty($data))? $data : null,
        ];
        
        return $this->json($return);
    }

}
