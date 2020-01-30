<?php
class EditingController extends Controller
{
        public function process($params)
        {           
                $this->userVerify(true);
                // Hlavička stránky
                $this->head['title'] = 'Editace cosmonautů';
                // Vytvoření instance modelu
                $cosmonautManager = new CosmonautManager();
                // Příprava prázdného cosmonauta                   
                $cosmonaut = array(
                        'kosmonaut_id' => '',
                        'jmeno' => '',
                        'prijmeni' => '',
                        'datum_narozeni' => '',
                        'superschopnost' => '',                        
                );
                    
                // Je odeslán formulář
                if ($_POST)
                {        
                        // Získání kosmonauta z $_POST
                        $keys = array('jmeno', 'prijmeni', 'datum_narozeni', 'superschopnost');
                        $cosmonaut = array_intersect_key($_POST, array_flip($keys));                         
                      try
                        {$cosmonaut['datum_narozeni']=DatumHelper::datumDb($cosmonaut['datum_narozeni']);                      
                        // Uložení kosmonauta do DB
                        $cosmonautManager->insertCosmonaut($_POST['kosmonaut_id'], $cosmonaut);
                        $this->addMessage('Kosmonaut byl úspěšně uložen.');
                        $this->redirect('cosmonaut/' . $cosmonaut['url']);}
                      catch(Exception $e)
                        {                        
                        $this->addMessage($e->getMessage());                        
                        }                         
                }
                        // Je zadaný kosmonaut k editaci
                else if (!empty($params[0]))
                {       
                        $loadedCosmonaut = $cosmonautManager->getCosmonaut($params[0]);
                        if ($loadedCosmonaut)
                                $cosmonaut = $loadedCosmonaut;
                        else
                                $this->addMessage('Kosmonaut nebyl nalezen');   
                }                                                               
                 
                        $this->data['cosmonaut'] = $cosmonaut;
                        $this->view = 'editing';        
                        // Hlavička stránky
                        $this->head['title'] = 'Editace kosmonautů';
        }
}           	