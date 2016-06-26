<?php
// In a controller
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;

class ContactController extends AppController
{
    public function index()
    {
        $contact = new ContactForm();
        //$contact->setErrors(["email" => ["_required" => "Your email is required"]]);
        if ($this->request->is('post')) {
            if ($contact->execute($this->request->data)) {
                $this->Flash->success('We will get back to you soon.');
            } else {

                $errors = $contact->errors();
                //debug($errors);
                $contact->setErrors($errors);
                //$this->Flash->error('There was a problem submitting your form.');
            }
        }

        if ($this->request->is('get')) {
            //Values from the User Model e.g.
            $this->request->data['name'] = 'John Doe';
            $this->request->data['email'] = 'john.doe@example.com';
        }

        $this->set('contact', $contact);
    }
}