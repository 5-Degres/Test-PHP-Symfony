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


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @author Andrea Porcella <andreaporcella@gmail.com>
 * 
 */
#[Route('/api')]
class UserController extends AbstractController
{
    /**
     * NOTE: For standard formats, Symfony will also automatically choose the best
     * Content-Type header for the response.
     *
     * See https://symfony.com/doc/current/routing.html#special-parameters
     */
    #[Route('/user', name: 'user_index', defaults: ['page' => '1', '_format'=>'application/json'], methods: ['GET'])]
    #[Cache(smaxage: 10)]
    public function index(Request $request, int $page, UserRepository $user):Response
    {
        $data = [];
        $finded = $user->findAll($page);
        if(is_array($finded)) {
            foreach($finded as $user){
                $data[] = [
                    'fullname'=>$user->getFullName(),
                    'username'=>$user->getUsername(),
                    'email'=>$user->getEmail(),
                    'password'=>$user->getPassword(),
                    'roles'=>$user->getRoles()
                ];
            }
        }
        $return  = [
            'success'=> (!empty($data))? true : false,
            'payload'=> (!empty($data))? $data : null,
        ];
        return $this->json($return);
    }

}
