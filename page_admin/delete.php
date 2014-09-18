<?php

class DELETE_ADMIN extends DB {
    
    public function delete_table_admin ($table, $condition)
    {
        /* Delete from Operator where ID = 1
         *
         */
        
        $query = "DELETE FROM $table WHERE $condition";
        $result = $this->query($query) or die ($this->error());
        
        return true;
    }
}
?>