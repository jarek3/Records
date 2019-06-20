<?php
class RegistrationController extends Controller
{
    public function process($params)
    {
                // Hlavička stránky
                $this->head['title'] = 'Registrace';
                if ($_POST)
                {
                        try
                        {
                                $userManager = new UserManager();
                                $userManager->register($_POST['name'], $_POST['password'], $_POST['confirm_password'], $_POST['rok']);
                                $userManager->login($_POST['name'], $_POST['password']);
                                $this->addMessage('Byl jste úspěšně zaregistrován.');
                                $this->redirect('administration');
                        }
                        catch (UserError $error)
                        {
                                $this->addMessage($error->getMessage());
                        }
                }
                // Nastavení šablony
                $this->view = 'registration';
    }
}
?>