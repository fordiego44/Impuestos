<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidatorCustom extends Model
{
     public function validateRegister($request) {
         $errors = new \stdClass();
         $verify = User::where('email', $request->email)->first();
         //die(json_encode($verify));
         if (isset($verify->email))  $errors->email_register =  'El email ya esta registrado';
         
         if (!isset($request->names)) $errors->names = 'El campo nombre es requerido';
         if (!isset($request->email)) $errors->email =  'El campo email es requerido';
         // if (!isset($email_register)) $errors->email_register =  'El email ya esta registrado';
         if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido';
         if (!isset($request->password_confirmation)) $errors->password_confirmation = 'El campo contraseña es requerido';
         //die(json_encode($errors));
         if ($request->password !== $request->password_confirmation) $errors->password_equal = 'Las contraseñas no coincide'; 
         return $errors;

     }
     public function validateLogin($request) {
      $verify = User::where('email', $request->email)->first(); 
      $errors = new \stdClass(); 

      if (!isset($verify->email))  $errors->email_register =  'El email no esta registrado';


      if (!isset($request->email)) $errors->email =  'El campo email es requerido';
      if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido'; 
      return $errors;
    }
    public function validateLoginCostumer($request) {
        $verify = Costumer::where('email', $request->email)->first(); 
        $errors = new \stdClass(); 
        //die(json_encode($verify->email));

        if (!isset($verify->email))  $errors ->email_register =  'El email no esta registrado';
  
  
        if (!isset($request->email)) $errors->email =  'El campo email es requerido';
        if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido'; 
         //die(json_encode($errors));

        return $errors;
    }
    public function validateRegisterCostumer($request) {
        $errors = new \stdClass();
        $verify = Costumer::where('email', $request->email)->first(); 
        if (isset($verify->email))  $errors->email_register =  'El email ya esta registrado';
        
        if (!isset($request->names)) $errors->names = 'El campo nombre es requerido';
        if (!isset($request->email)) $errors->email =  'El campo email es requerido'; 
        if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido';
        if (!isset($request->password_confirmation)) $errors->password_confirmation = 'El campo contraseña es requerido';
       // die(json_encode($errors));
        if ($request->password !== $request->password_confirmation) $errors->password_equal = 'Las contraseñas no coincide'; 
        return $errors;

    }

    public function validateLoginRepartidor($request) {
        $verify = Deliverier::where('email', $request->email)->first(); 
        $errors = new \stdClass(); 
  
        if (!isset($verify->email))  $errors->email_register =  'El email no esta registrado';
  
  
        if (!isset($request->email)) $errors->email =  'El campo email es requerido';
        if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido'; 
        return $errors;
      }
      public function validateLoginAdmin($request) {
        $verify = Admin::where('email', $request->email)->first(); 
        //die($verify);
        $errors = new \stdClass();  
        if (!isset($verify->email))  $errors->email_register =  'El email no esta registrado'; 
        if (!isset($request->email)) $errors->email =  'El campo email es requerido';
        if (!isset($request->password)) $errors->password = 'El campo contraseña es requerido'; 
        return $errors;
      }
}
