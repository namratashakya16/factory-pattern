<?php
   /*
   Plugin Name: Design Pattern
   Plugin URI: http://localhost/namrata/wordpress/wp-content/plugins/
   description: xyz 
   Version: 1.2
   Author: namrata
   Author URI: http://localhost/namrata
   */
 

class Factory{
   public function __construct(){     
         add_action( 'wp_enqueue_scripts', array($this,'add_factory_scripts' ));           
         add_action( 'wp-footer', array($this,'add_sripts' ));           
         add_action('wp_ajax_create', array($this,'create'));
         add_action('wp_ajax_nopriv_create', array($this,'create'));

   } 
   public  function add_factory_scripts() {       
        
         wp_register_script( 'factory_script', get_template_directory_uri() . '/js/factory.js', array( 'jquery' ) );
         wp_enqueue_script( 'factory_script');
         wp_localize_script( 'factory_script', 'ajax_admin', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
  }

  public function create(){
        $html="";
        $html.="<table>";       
        $plate = new Make;
        $BaseThali = new BaseThaliRestaurant;
        $type=$_POST["thali"];

        if ($type=="GujaratiThali") 
        {       
        $order = $BaseThali->createThali("GujaratiThali", $plate);

        $html.="<tr><th>Ordered Gujarati Thali</th></tr>";

        $plate->addSabji = "140";
        $plate->addRoti = "8";
        $plate->addRice = "70";
        $plate->addDal = "65";
        $plate->extra = "140";

         }
        else{
        $order = $BaseThali->createThali("PunjabiThali", $plate);

        $plate->addSabji = "140";
        $plate->addRoti = "10";
        $plate->addRice = "70";
        $plate->addDal = "65"; 
        $plate->saag = "55"; 
        $plate->extra = "160";

         $html.="<tr><th>Ordered Punjabi Thali</th></tr>";        
         $html.="<td>" . $order->saag() . "</td>"; 
                               
        }
        $html.="<tr><td>" .  $order->addSabji() . "</td></tr>"; 
        $html.="<tr><td>" . $order->addRoti() . "</td></tr>";
        $html.="<tr><td>" . $order->addRice() . "</td></tr>";
        $html.="<tr><td>" . $order->addDal(). "</td></tr>";
        $html.="<tr><td>" . $order->extra() . "</td></tr>";
      echo $html;     
      wp_die();  
    }

}
new Factory();


interface Thali{     
     public function addSabji();
     public function addDal();
     public function addRice();
     public function addRoti();
}

class Make{
    public $addSabji;
    public $addRoti;
    public $addRice;
    public $addDal;
}

class GujaratiThali implements Thali{

    private $make;
    public function __construct(Make $plate) {
        $this->make = $plate;
    }
    public function addSabji(){        
        return "2 sabji in gujarati thali (per :- ".$this->make->addSabji .") <br/>";
    }
    public function addRoti(){
        return "4 roti in gujarati thali (per :- ".$this->make->addRoti .")<br/>";
    }
    public function addRice(){
        return "1 plate rice in gujarati thali (per :- ".$this->make->addRice .")<br/>";
    }
    public function addDal(){
        return "1 plate dal in gujarati thali (per :- ".$this->make->addDal .")<br/>";
    }
    public function extra(){
        return "extra dishes in gujarati thali :- Gujarati-Mixed-Veg-Shaak, Kandvi, Gujarati Aloo (for :- ".$this->make->extra .") <br/>";
    }

}

class PunjabiThali  implements Thali{

    private $make;
    public function __construct(Make $plate) {
        $this->make = $plate;
    }
    public function addSabji(){
        return "1 sabji in punjabi thali (per :- ".$this->make->addSabji .")";
    }
    public function addRoti(){
        return "5 roti in punjabi thali (per :- ".$this->make->addRoti .")";
    }
    public function addRice(){
        return "1 platerice in punjabi thali (per :- ".$this->make->addRice .")";
    }
    public function addDal(){
        return "1 plate dal makhani in punjabi thali (per :- ".$this->make->addDal .")";
    }
    public function saag(){
        return "1 plate Sarson in punjabi thali (for :-".$this->make->saag .")";
    }
    public function extra(){
        return "extra dishes in punjabi thali :- Chole Bhature(for :-".$this->make->extra .")";
    }
}


class BaseThaliRestaurant{
    public function createThali($class, $make)
    {
        return new $class($make);
    }
}

