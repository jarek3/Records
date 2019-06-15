<?php
class CosmonautController extends Controller
{
        public function process($params)
        {
                // Vytvoření instance modelu, který nám umožní pracovat s kosmonauty
                $cosmonautManager = new CosmonautManager();
                $userManager = new UserManager();                                 
                $user = $userManager->getUser();
                $this->data['admin'] = $user && $user['admin'];
                
                // Je zadán kosmonaut ke smazání
        if (!empty($params[1]) && $params[1] == 'delete')
        {
                $this->userVerify(true);
                $cosmonautManager->deleteCosmonaut($params[0]);
                $this->addMessage('Kosmonaut byl úspěšně odstraněn');
                $this->redirect('cosmonaut');
        }                
                
                // Je zadán kosmonaut
        if (!empty($params[0]))
            {
                 // Získání kosmonauta
                $cosmonaut = $cosmonautManager->getCosmonaut($params[0]);
                // Pokud nebyl kosmonaut nalezen
                if (!$cosmonaut)
                        $this->redirect('error');

                // Naplnění proměnných pro šablonu 
                $this->data['name'] = $cosmonaut['jmeno'];
                $this->data['surname'] = $cosmonaut['prijmeni'];
                $this->data['birthdate'] = DatumHelper::datumCzech($cosmonaut['datum_narozeni']);
                $this->data['power'] = $cosmonaut['superschopnost'];
               
                // Nastavení šablony
                $this->view = 'cosmonaut';
            }
        else
                // Není zadán kosmonaut, vypíšeme všechny
            {
                $cosmonauts = $cosmonautManager->getCosmonauts();
                $this->data['cosmonauts'] = $cosmonauts;
                $this->view = 'cosmonaut';
            }
        }    
}
?>