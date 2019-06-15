<?php
class LoginController extends Controller
{
    public function process($params)
    {
                $userManager = new UserManager();
                if ($userManager->getUser())
                        $this->redirect('administration');
                // Hlavička stránky
                $this->head['title'] = 'Přihlášení';
                if ($_POST)
                {
                        try
                        {
                                $userManager->login($_POST['name'], $_POST['password']);
                                $this->addMessage('Byl jste úspěšně přihlášen.');
                                $this->redirect('administration');
                        }
                        catch (UserError $error)
                        {
                                $this->addMessage($error->getMessage());
                        }
                }
                // Nastavení šablony
                $this->view = 'login';
    }
}
?>