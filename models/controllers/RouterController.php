<?php
class RouterController extends Controller
{
    protected $controller;
    private function dashesToCamel($text)
    {
    $text = str_replace('-', ' ', $text);
    $text = ucwords($text);
    $text = str_replace(' ', '', $text);
    return $text;
    }
    
    private function parseURL($url)
    {
    $parsedURL = parse_url($url);
    $parsedURL["path"] = ltrim($parsedURL["path"], "/");
    $parsedURL["path"] = trim($parsedURL["path"]);
    $explodedUrl = explode("/", $parsedURL["path"]);
    return $explodedUrl; 
    }
    
    public function process($params)
    {
    $parsedURL = $this->parseURL($params[0]);
    
    if (empty($parsedURL[0]))
        $this->redirect('cosmonaut');
    $controllerClass = $this->dashesToCamel(array_shift($parsedURL)) . 'Controller';
    if (file_exists('controllers/' . $controllerClass . '.php'))
        $this->controller = new $controllerClass;
    else
        $this->redirect('error');
    
    $this->controller->process($parsedURL);
    $this->data['title'] = $this->controller->head['title'];
    $this->data['description'] = $this->controller->head['description'];
    $this->data['keywords'] = $this->controller->head['keywords'];
    $this->data['messages'] = $this->getMessages();
    // Nastavení hlavní šablony
    $this->view = 'layout';
    }
}    
?>