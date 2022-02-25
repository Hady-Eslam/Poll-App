<?php

namespace Services;


class Form{

    private $FormSchema = [];
    private $BaseSchema = [
        'min' => null,
        'max' => null,
        'min_value' => null,
        'max_value' => null,
        'min_array' => null,
        'max_array' => null,
        'required' => false,
        'type' => 'string',
        'validator' => null
    ];
    private $errors = [];
    private $valid = true;

    function __construct($Data, $Files = []){
        $this->Data = $Data;
        $this->Files = $Files;
    }


    function Schema($FormSchema){
        $this->FormSchema = $FormSchema;
    }


    function isValid(){
        foreach ($this->FormSchema as $Key => $Value){
            if ( $Value['type'] == 'string' ){
                $this->valid = ( 
                    !$this->Validate_String($Key, array_merge($this->BaseSchema, $Value), $this->Data[$Key]) 
                ) ? false : $this->valid;
            }
            else if ( $Value['type'] == 'array' ){
                $this->valid = ( 
                    !$this->Validate_Array($Key, array_merge($this->BaseSchema, $Value), $this->Data[$Key]) 
                ) ? false : $this->valid;
            }
            else if ( $Value['type'] == 'date' ){
                $this->valid = ( 
                    !$this->Validate_Date($Key, array_merge($this->BaseSchema, $Value), $this->Data[$Key]) 
                ) ? false : $this->valid;
            }
        }
        return $this->valid;
    }


    private function Validate_String($Key, $Schema, $Item){

        if ( $Schema['required'] && !isset($Item) ){
            $this->errors[$Key] = 'this field is required';
            return false;
        }

        if ( $Schema['required'] || !$Schema['required'] && isset($Item) ){

            $Item = filter_var($Item, FILTER_SANITIZE_STRING);
            
            if ( !is_null($Schema['min']) && strlen($Item) < $Schema['min'] ){
                $this->errors[$Key] = 'min size for this field is '.$Schema['min'];
                return false;
            }
    
            if ( !is_null($Schema['max']) && strlen($Item) > $Schema['max'] ){
                $this->errors[$Key] = 'max size for this field is '.$Schema['max'];
                return false;
            }
        }

        $this->CleanedData[$Key] = $Item;
        return true;
    }


    private function Validate_Array($Key, $Schema, $Item){

        if ( $Schema['required'] && !isset($Item) ){
            $this->errors[$Key] = 'this field is required';
            return false;
        }

        if ( $Schema['required'] || !$Schema['required'] && isset($Item) ){
            
            if ( !is_array($Item) ){
                $this->errors[$Key] = 'this field must be an array';
                return false;
            }

            else if ( !is_null($Schema['min_array']) && sizeof($Item) < $Schema['min_array'] ){
                $this->errors[$Key] = 'min size for this field array is '.$Schema['min_array'];
                return false;
            }

            else if ( !is_null($Schema['max_array']) && sizeof($Item) > $Schema['max_array'] ){
                $this->errors[$Key] = 'max size for this field array is '.$Schema['max_array'];
                return false;
            }

            foreach ($Item as $ItemKey => $ArrayItem){

                $ArrayItem = filter_var($ArrayItem, FILTER_SANITIZE_STRING);
            
                if ( !is_null($Schema['min']) && strlen($ArrayItem) < $Schema['min'] ){
                    $this->errors[$Key] = 'min size for this field item is '.$Schema['min'];
                    return false;
                }
        
                if ( !is_null($Schema['max']) && strlen($ArrayItem) > $Schema['max'] ){
                    $this->errors[$Key] = 'max size for this field item is '.$Schema['max'];
                    return false;
                }

                $Item[$ItemKey] = $ArrayItem;
            }
        }

        $this->CleanedData[$Key] = $Item;
        return true;
    }


    function Validate_Date($Key, $Schema, $Item){

        if ( $Schema['required'] && !isset($Item) ){
            $this->errors[$Key] = 'this field is required';
            return false;
        }

        if ( $Schema['required'] || !$Schema['required'] && isset($Item) ){

            $Item = filter_var($Item, FILTER_SANITIZE_STRING);

            $Data_Array = explode('-', $Item);
            if ( !checkdate($Data_Array[1], $Data_Array[2], $Data_Array[0]) ){
                $this->errors[$Key] = 'invalid date';
                return false;
            }
        }

        $this->CleanedData[$Key] = $Item;
        return true;
    }


    function Errors(){
        return $this->errors;
    }
}
