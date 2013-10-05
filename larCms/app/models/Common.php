<?php



class Common{
    
    /*
     * Method to strip tags globally.
     */
    public static function global_xss_clean()
    {
        // Recursive cleaning for array [] inputs, not just strings.
        $sanitized = static::array_strip_tags(Input::get());
        Input::merge($sanitized);
    }

    public static function array_strip_tags($array)
    {
        $result = array();

        foreach ($array as $key => $value) {
            // Don't allow tags on key either, maybe useful for dynamic forms.
            $key = strip_tags($key);
            // If the value is an array, we will just recurse back into the
            // function to keep stripping the tags out of the array,
            // otherwise we will set the stripped value.
            if (is_array($value)) {
                $result[$key] = static::array_strip_tags($value);
            } else {
                $result[$key] = trim(strip_tags($value));
            }
        }

        return $result;
    }
    
    public static function pre($output)
    {
        $debug = debug_backtrace();
        echo "<pre>";
        print_r($output);
	print_r("\n//FILE ".$debug[0]['file']);
	print_r("\n//LINE ".$debug[0]['line']."\n");
        echo "</pre>";
    }
    
    public static function getIntForInQuery($array, $val = 'id')
    {
        $return = "(";
        foreach($array as $item){
            $return .= $item[$val].",";
        }
        return substr($return,0, -1).")";
    }
    
    public static function getCleaned($var)
    {
        return ucfirst(str_replace("_"," ",$var));
    }
}


 
