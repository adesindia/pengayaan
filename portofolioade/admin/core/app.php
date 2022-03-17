<?php

 Class App{

     protected$controller ='portofolio';//controller default
     protected$method ='index'; //method default
     protected$params =[];     //parameter jika ada

     public function __construct()

     {
         $url=$this->parselURL();

         //pemanggilan controller

         if(file_exists('../admin/controllers/'.$url[0].'.php')){
             $this->controller =new$this->controller;

             //pemanggilan method
             
             if(isset($url[1])){
                 if(method_exist($this->controller,$url[1])){
                     $this->method =$url[1];
                     unset($url[1]);
                 }
             }

             //parameters

             if(!empty($url)){
                 $this->params =array_values($url);
             }

             //jalankan controller & method ,serta kirimparameter jika ada

             call_user_func_array([$this->method],$this->params);
         }

         public function parselURL()
         {
             if(isset($_GET['url'])){
                 //menghilangkan garis miring(/)diakhiri url

                 $url=rtrim($_GET['url'],'/');
                 // menghilangkan karakter aneh atau karakter yang memungkinkan kita di hack

                 $url = filter_var($url,FILTER_SANITIZE_URL);
                 //menghilangkan tanda garis miring (/) dan mengambil string nya.
                 $url =explode('/',$url);
                 return $url
             }
         }
     }
 }

?>
