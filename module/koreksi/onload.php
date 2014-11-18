<script type='text/javascript'>
    
    function load_data()
    {
	<?php
	if ($dataArr->Golongan !='')
	{
	    switch ($dataArr->Golongan)
	    {
		case '01':
		    {
			?>$("#parent1").slideDown("fast");<?php
		    }
		    break;
		case '02':
		    {
			?>$("#parent2").slideDown("fast");<?php
		    }
		    break;
		case '03':
		    {
			?>$("#parent3").slideDown("fast");<?php
		    }
		    break;
		case '04':
		    {
			?>$("#parent4").slideDown("fast");<?php
		    }
		    break;
		case '05':
		    {
			?>$("#parent5").slideDown("fast");<?php
		    }
		    break;
		case '06':
		    {
			?>$("#parent6").slideDown("fast");<?php
		    }
		    break;
		case '07':
		    {
			?>$("#parent7").slideDown("fast");<?php
		    }
		    break;
	    }
	}
	
	if ($dataArr->CaraPerolehan!='')
	{
	    switch ($dataArr->CaraPerolehan)
	    {
		case '1':
		    {
		    ?>
                    $("#hide11").slideUp("fast");
                    $("#hide7").slideUp("fast");
                    $("#hide9").slideUp("fast");
                    $("#hide10").slideUp("fast"); 
                    $("#hide8").slideDown("fast"); 
                    <?php
		    }
		    break;
		case '2':
		    {
		    ?>
                    $("#hide7").slideUp("fast");
                    $("#hide11").slideUp("fast");
                    $("#hide8").slideUp("fast");
                    $("#hide10").slideUp("fast"); 
                    $("#hide9").slideDown("fast");
                    <?php
		    }
		    break;
		case '3':
		    {
		    ?>
                    $("#hide7").slideUp("fast");
                    $("#hide8").slideUp("fast");
                    $("#hide11").slideUp("fast");
                    $("#hide9").slideUp("fast"); 
                    $("#hide10").slideDown("fast"); 
                    <?php
		    }
		    break;
		case '4':
		    {
		    ?>
                    $("#hide7").slideUp("fast");
                    $("#hide8").slideUp("fast");
                    $("#hide9").slideUp("fast"); 
                    $("#hide10").slideUp("fast"); 
                    $("#hide11").slideDown("fast"); 
                    <?php
		    }
		    break;
		default:
                    {
                    ?>
                    $("#hide9").slideUp("fast");
                    $("#hide8").slideUp("fast");
                    $("#hide11").slideUp("fast");
                    $("#hide10").slideUp("fast"); 
                    $("#hide7").slideDown("fast"); 
                    <?php 
                    }
	    }
	}
        
        if ($dataArr->PenghapusanAset!='')
	{
	    switch ($dataArr->PenghapusanAset)
	    {
		case '1':
		    {
		    ?>
                    $("#hide4").slideUp("fast");
                    $("#hide6").slideUp("fast");
                    $("#hide5").slideDown("fast");
                    <?php
		    }
		    break;
		case '2':
		    {
		    ?>
                    $("#hide4").slideUp("fast");
                    $("#hide5").slideUp("fast");
                    $("#hide6").slideDown("fast");
                    <?php
		    }
		    break;
		
		default:
                    {
                    ?>
                    $("#hide6").slideUp("fast");
                    $("#hide5").slideUp("fast");
                    $("#hide4").slideDown("fast");
                    <?php 
                    }
	    }
	}
	?>
	
	
	
    }
    
</script>