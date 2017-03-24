
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">

	<tr>
		<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line Num</b></td>
		<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>OP Num</b></td>
		<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Description </b></td>
		<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PS No </b></td>
		<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Spec</b></td>
		<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Std Iss</b></td>
		<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Dept</b></td>
	</tr>		

	<?php
		$wpfcnt = 1;
	    $i = 1;

	    foreach ($results as $myrow) 
	    {
	    	$linenum="line_num" . $i;
           $desc="desc" . $i;
           $op_no="op_no" . $i;
           $ps_no="ps_no" . $i;
           $recnum="recnum" . $i;
           $spec ="spec" . $i;
           $dept ="dept" . $i;
           $std_iss ="std_iss" . $i;

        ?>

        <tr>
        	<td ><span class="tabletext"><input type="text"  name="{{$linenum}}"  value="{{$myrow->linenum}}" size="3%" id="{{$linenum}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$op_no}}"  value="{{$myrow->op_num}}" size="6%" id="{{$op_no}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$desc}}"  value="{{$myrow->desc}}" size="40%" id="{{$desc}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$ps_no}}"  value="{{$myrow->ps_no}}" size="5%" id="{{$ps_no}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$spec}}"  value="{{$myrow->spec}}" size="25%" id="{{$spec}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$std_iss}}"  value="{{$myrow->std_iss_ref}}" size="10%" id="{{$std_iss}}"></td>
        	<td ><span class="tabletext"><input type="text"  name="{{$dept}}"  value="{{$myrow->dept}}" size="25%" id="{{$dept}}"></td>

        </tr>

        <?php
           $i++;
	    }

	?>

</table>

<?php 
	
?>