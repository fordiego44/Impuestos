<?php

namespace App\Imports;
use App\Product;
use App\Attribute;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
          // dd($collection);
          return  Maatwebsite\Excel\Concerns\ToCollection;
      foreach ($collection as $key => $value) {
        if (($key >= 4) && ($value[3] != null) && ($value[7]== 'NO' || $value[7]== 'SI' || $value[7]== 'no' || $value[7]== 'si' || $value[7]== 'No' || $value[7]== 'Si'))
        {
          $a = $value[7];

          // dd('Hola');
                $plato = new Product;
                $plato->id_user =  session('user')->id;
                $plato->name =  $value[3];
                $plato->description =  $value[4];
                $plato->price = $value[5];
                $plato->image = $value[6];
                $plato->id_category = '0';
                $plato->state_delete  = 0 ;
                $plato->slug  = strtr($value[3], " ", "-");
                $plato->save();

                $recenGenerate = Product::orderBy('id', 'desc')->where('name',$value[3])->where('id_user', session('user')->id)->take(1)->get();
                // dd($recenGenerate[0]['id']);

        }
        else {

          if ($key >= 4) {
            if ( ($a == 'SI' || $a == 'si' || $a == 'Si') && ($value[7] != null)) {

              // dd('Con atributos');
              $atributo = new Attribute;
              $atributo->id_product = $recenGenerate[0]['id'];
              $atributo->name = $value[7];
              $atributo->value = $value[8];
              $atributo->variation = 0 ;
              $atributo->state_delete  = 0;
              $atributo->save();
            } else {
              if ($a == 'NO' || $a == 'no' || $a == 'No') {
                // dd('Sin atributos');
              }
            }
          }

        }
        // dd($key,$value[1]);
      }

    }
}
