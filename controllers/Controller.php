<?php
abstract class Controller
{

    protected $data = array();
    protected $view = "";
    protected $head = array('title' => '', 'keywords' => '', 'description' => '');  
    
    // Ošetří proměnnou pro výpis do HTML stránky
    private function protect($x = null)
    {
	if (!isset($x))
            return null;
	elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
	elseif (is_array($x))
	{
            foreach($x as $k => $v)
            {
            $x[$k] = $this->protect($v);
            }
            return $x;
	}
	else 
            return $x;
    }

    public function renderView()
    {
        if ($this->view)
        {
                extract($this->data);
                require("views/" . $this->view . ".phtml");
        }
    }
    
    public function addMessage($message)
    {
        if (isset($_SESSION['messages']))
                $_SESSION['messages'][] = $message;
        else
                $_SESSION['messages'] = array($message);
    }
    
    public static function getMessages()
    {
        if (isset($_SESSION['messages']))
        {
                $messages = $_SESSION['messages'];
                unset($_SESSION['messages']);
                return $messages;
        }
        else
                return array();
    }
    
    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }    
    
    public function userVerify($admin = false)
    {
        $userManager = new UserManager();
        $user = $userManager->getUser();
        if (!$user || ($admin && !$user['admin']))
        {
                $this->addMessage('Nedostatečná oprávnění.');
                $this->redirect('login');
        }             
    }
    
    	public function validDate($value, $format = 'Y-m-d')
	{
		try
		{
			self::datumDb($value, $format);
			return $datum->format('Y-m-d');
		}
		catch (InvalidArgumentException $e)
		{
		}
		
	}
    // Hlavní metoda controlleru
    abstract function process($params);
}
?>