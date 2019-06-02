<?php

/**
 * Returns array of color for avatar
 * 
 */
if(!function_exists('avatar_colors')){
    function avatar_colors($index){
        $colors = [
            'blue','azure','indigo','purple','pink','red',
            'orange','yellow','lime','green','teal','cyan',
            'gray','gray-dark',
        ];

        $length = count($colors);
        $result = $index;

        if($index <= $length){
            return $colors[$index-1];
        }else{
            while ($result > $length){                
                $result -= $length;                             
                if($result <= $length) break;
            }
            return $colors[$result];
        }        
    }
}

if(!function_exists('getinitial')){
    function getinitial($fullname){

        $expr = '/(?<=\s|^)[a-z]/i';
        preg_match_all($expr,$fullname,$matches);
        
        return implode('',$matches[0]);
    }
}

