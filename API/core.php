<?php

class LOAD_DATA extends DB
{
    
    
    //- fungsi ini (paging) harus berada di paling bawah ya, biar gampang nyarinya -//
    public function paging($parameter)
    {
        if ($parameter==0)
        {
            echo '<script type=text/javascript>window.location.href="?pid=1";</script>';
        }
        if ($parameter== 1)
        {
            $paging = ((($parameter - 1) * 10));
        }else
        {
            $paging = ((($parameter - 1) * 10) + 1);
        }
        
        return $paging;
    }
    
}
?>