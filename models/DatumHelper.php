<?php
class DatumHelper
 {    
    public static function datumCzech($value)
    {   
        if (!empty($value))
	{
        $datum = new DateTime($value);
		return $datum->format('d.m.Y');
        }
    }
    
    public static function datumDb($value, $format='Y-m-d')
    {   
        //pokud bude zadán měsíc česky textem 
        $mesice = ['ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince'];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];          
        $value= str_replace($mesice, $months, $value);
        //pokud bude datum  zadáno ve tvaru d/m/Y
        $a = explode("/", $value);
        if ($a[0]<32)        
        $value = implode($a, "."); 
        //odstranění případných mezer v zadání datumu
        $value = str_replace(" ", "", $value);       
        try{$datum = new DateTime($value);}        
        catch(Exception $e){}  
        $errors = DateTime::getLastErrors();
        // Vyvolání chyby
        if ($errors['warning_count'] + $errors['error_count'] > 0)
            throw new Exception('Zadejte prosím existující datum.');     
        return $datum->format('Y-m-d');
    } 
}         
