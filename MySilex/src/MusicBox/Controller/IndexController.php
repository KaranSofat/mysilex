<?php

namespace MusicBox\Controller;

use Silex\Application;
use Doctrine\DBAL\Connection;
use MusicBox\Entity\User;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class IndexController
{

   
    public function indexAction(Request $request, Application $app)
    {
       
       $queryBuilder = $app['db']->createQueryBuilder();
       
        $queryBuilder
            ->select('a.*')
            ->from('user', 'a')
            ->where('a.status=1');
            
        $users = $queryBuilder->execute();
        $users = $users->fetchAll();
       
        return $app['twig']->render('home.twig',array('users'=>$users));
       
    }

     public function deleteAction(Request $request, Application $app,$id)
     {
     
       $app['db']->delete('user', array('id' => $id));
      return $app->redirect($app['url_generator']->generate('homepage'));
     
     }
     
      public function addUserAction(Request $request, Application $app)
     {
     
         if ($request->isMethod('POST')) {
         
         $userData = array(
         
            'first_name' => $request->get('fname'),
           	'last_name' => $request->get('lname'),
           	'password' => $request->get('password'),
           	'email' => $request->get('email'),
           	'address' => $request->get('address'),
           		'status' => 1,
           	);
           
        
            
          $app['db']->insert('user', $userData);
            return $app->redirect($app['url_generator']->generate('homepage'));
          
         }
       return $app['twig']->render('addUser.twig');
     }
     
      public function updateUserAction(Request $request, Application $app,$id)
      {
         $userData = $app['db']->fetchAssoc('SELECT * FROM user WHERE id = ?', array($id));
      
           if ($request->isMethod('POST')) {
           
           $userData = array(
         
            'first_name' => $request->get('fname'),
           	'last_name' => $request->get('lname'),
           	'password' => $request->get('password'),
           	'email' => $request->get('email'),
           	'address' => $request->get('address'),
           		
           	);
           
            $app['db']->update('user', $userData, array('id' => $id));
            return $app->redirect($app['url_generator']->generate('homepage'));
           }
            
      
      
       return $app['twig']->render('updateUser.twig',array('userData'=>$userData));
      }

       public function loginAction(Request $request, Application $app)
       {
       
       
       
       }

}
