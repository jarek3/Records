<?php
class ContactController extends Controller
{
	public function process($params)
	{
		$this->head['title'] = 'Kontaktní formulář';
		
		if ($_POST)
		{
			try
			{			
				$emailSender = new EmailSender();
				$emailSender->sendWAntispam($_POST['year'], "jaropato3@gmail.com", "Email z webu", $_POST['message'], $_POST['email']);
				$this->addMessage('Email byl úspěšně odeslán.');
				$this->redirect('contact');
			}
			catch (UserError $error)
			{
				$this->addMessage($error->getMessage());
			}
		}
		
		$this->view = 'contact';
    }
}