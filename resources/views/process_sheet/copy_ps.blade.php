@extends('newtemp.main')
@section('content')
	<?php 
		$userid = session('username');
		$userid = Session::get('username');

		$myrow = $details[0];
		$today = date('Y-m-d') ;
	?>

	{!!  Form::open(['route'=>'submit_copyps' , 'class'=>'form']) !!}

	<script src="{{ asset('assets/scripts/bom.js') }} "></script>
	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">*PS #</p></span></td>
			<td  ><input type="text" size=25  name="bomnum" id="bomnum" value=""  ></span></td>

			<td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
			<td><input type="text" name="bomdate" id="bomdate"  size=25 value=""></td>
		</tr>

		<tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">PS Name</p></font></td>
      <td><input type="text" size=35 name="type" value="{{ $myrow->type }}"  ></td>
      <td><span class="labeltext"><p align="left">Scope</p></font></td>
      <td><textarea name="desc" rows="4" cols="40" >{{ $myrow->bomdescr }}</textarea>
      </td>      
    </tr>

    <tr bgcolor="#FFFFFF">
      <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
      <td><input type="text" name="se"   size=25 value="<?php echo $myrow->fname." ".$myrow->lname ?>">
      <td><span class="labeltext"><p align="left">Issue</p></font></td>
      <td><input type="text" size=25 name="issue" value="{{ $myrow->issue }}" ></td>
    </tr>

    <tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>Add Notes</b></center></td>
		</tr>

		<tr bgcolor="#FFFFFF">
      <td colspan=8><textarea name="notes" id="notes" rows="3" cols="81" value=""></textarea></td> 
    </tr>

	</table>

	<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE" width=2%><span class="heading"><b>Line</b></span></td>
			<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Description</b></span></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Subprocess</b></span></td>
			<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Tank #</b></span></td>
			<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Param Name</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Min</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Max</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty Check</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Paint Check</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Time Check</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Form 2</b></span></td>
			<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Additional Instrns</b></span></td>
			<td bgcolor="#EEEFEE" width=25%><span class="heading"><b>Instructions</b></span></td>
		</tr>
		<?php 
			$i=1;
      $flag=0;

     	while($i<=30 && $flag==0)  
      { 
        if($flag==0)
        {
					foreach($lidetails as $myrowli)
					{
					  $linenumber="linenum" . $i;
		        $prevlinenumber="prevlinenum" . $i;
		        $itemname="itemname" . $i;
	          $lirecnum="lirecnum" . $i;
		        $itemdesc="itemdesc" . $i;
		        $value="value" . $i;
		        $comments="comments" . $i;
		        $vendrecnum="vendrecnum" . $i;
            $partrecnum="partrecnum" . $i;
            $workcenter="workcenter" . $i;
            $optemp_min="optemp_min" . $i;
            $optemp_max="optemp_max" . $i;               
            $qty_check="qty_check" . $i;                
            $paint_check="paint_check" . $i;                
            $time_check="time_check" . $i;  
            $form2="form2" . $i;
            $ps_tanknum="ps_tanknum" . $i;


       			if ($myrowli->tank_num == "0" || $myrowli->tank_num == "" || $myrowli->tank_num == NULL ) 
          	{
              $tanknum = "NA";
              $recnum = "0";
           	}
						?>
						<tr>
							<td ><span class="tabletext"><input type="text" id="{{ $linenumber }}"  name="{{ $linenumber }}"  value="{{ $myrowli->line_num }}" size="2%"></td>
						 	<td><input type="text" name="{{$itemdesc}}"  id="{{$itemdesc}}" size="40%" value="{{$myrowli->item_desc}}" ></td>

			       	<td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="{{$myrowli->item_value}}" ></td>
			       	<td>
			       		<select name="{{$ps_tanknum}}" id="{{$ps_tanknum}}" >
			       			<option value={{$recnum}}  <?php if($recnum == "0"){ echo "selected='selected'";} ?> >{{ $tanknum }} </option>
			       			@foreach ($list_tanks as $li_tank)
			       				<option value='{{$li_tank->recnum}}' <?php if($li_tank->recnum == $myrowli->tank_num){ echo "selected= 'selectd'"; } ?> >{{$li_tank->tank_num}}
			       			@endforeach
			         	</select>
			        </td>

			       	<td><input type="text" name="{{$itemname}}" id="{{$itemname}}" size="15%" value="{{$myrowli->item_name}}" ></td>
			       	<td><input type="text" name="{{$optemp_min}}" id="{{$optemp_min}}" size="4%" value="{{$myrowli->optemp_min}}" ></td>

			       	<td><input type="text" name="{{$optemp_max}}" id="{{$optemp_max}}" size="4%" value="{{$myrowli->optemp_max}}" ></td>
			       	<td>
			       		<select name="{{$qty_check}}" id="{{$qty_check}}" >
				          <option value='Yes' <?php if($myrowli->qty_check == "Yes"){ echo "selected= 'selectd'"; } ?> >Yes
				          <option value='No' <?php if($myrowli->qty_check  == "No" || $myrowli->qty_check == ""){ echo "selected= 'selectd'";} ?>>No
			         	</select>
			        </td>

			       	<td>
			       		<select name="{{$paint_check}}" id="{{$paint_check}}" >
				          <option value='Yes' <?php if($myrowli->paint_check == "Yes"){ echo "selected= 'selectd'"; } ?> >Yes
				          <option value='No' <?php if($myrowli->paint_check  == "No" || $myrowli->paint_check == ""){ echo "selected= 'selectd'";} ?>>No
			         	</select>
			       	</td>
			       	<td>
			       		<select name="{{$time_check}}" id="{{$time_check}}" >
				          <option value='Yes' <?php if($myrowli->time_check == "Yes"){ echo "selected= 'selectd'"; } ?> >Yes
				          <option value='No' <?php if($myrowli->time_check  == "No" || $myrowli->time_check == ""){ echo "selected= 'selectd'";} ?>>No
			         	</select>
			       	</td>

			       	<td>
			       		<select name="{{$form2}}" id="{{$form2}}" >
				          <option value='Yes' <?php if($myrowli->form2 == "Yes"){ echo "selected= 'selectd'"; } ?> >Yes
				          <option value='No' <?php if($myrowli->form2  == "No" || $myrowli->form2 == ""){ echo "selected= 'selectd'";} ?>>No
			         	</select>
			       	</td>
			       	<td><input type="text" name="{{$workcenter}}" id="{{$workcenter}}" size="35%" value="{{$myrowli->workcenter}}" ></td>
			       	<td><input type="text" name="{{$comments}}" id="{{$comments}}" size="40%" value="{{$myrowli->comments}}" ></td>

			       	<input type="hidden" name="{{$vendrecnum}}" id="{{$vendrecnum}}" value="{{$myrowli->link2vendor}}">
			       	<input type="hidden" name="{{$partrecnum}}" id="{{$partrecnum}}" value="{{$myrowli->link2parts}}">
			       	<input type="hidden" name="{{$prevlinenumber}}" id="{{$prevlinenumber}}" value="{{$myrowli->line_num}}">
			       	<input type="hidden" name="{{$lirecnum}}" id="{{$lirecnum}}" value="{{$myrowli->recnum}}">
			       	<input type="hidden" name="userid" id="userid" value ="atpl">
						</tr>
					<?php 
						$i++;
					} 
				}
				$flag=1;
			}

			while($i<=30)
    	{	 
    		$linenumber="linenum" . $i;
        $prevlinenumber="prevlinenum" . $i;
        $itemname="itemname" . $i;
        $lirecnum="lirecnum" . $i;
        $itemdesc="itemdesc" . $i;
        $value="value" . $i;
        $comments="comments" . $i;
        $vendrecnum="vendrecnum" . $i;
        $partrecnum="partrecnum" . $i;
        $workcenter="workcenter" . $i;
        $optemp_min="optemp_min" . $i;
        $optemp_max="optemp_max" . $i;               
        $qty_check="qty_check" . $i;                
        $paint_check="paint_check" . $i;                
        $time_check="time_check" . $i;  
        $form2="form2" . $i;
        $ps_tanknum="ps_tanknum" . $i;


				?>
				<tr>
					<td ><span class="tabletext"><input type="text" id="{{ $linenumber }}"  name="{{ $linenumber }}"  value="" size="2%"></td>
				 	<td><input type="text" name="{{$itemdesc}}"  id="{{$itemdesc}}" size="40%" value="" ></td>

	       	<td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="" ></td>
	       	<td>
	       		<select name="{{$ps_tanknum}}" id="{{$ps_tanknum}}" >
	       			<option value="please select" selected disabled>Please select</option>
	         	  <option value="0" >NA</option>
	       			<option value={{$recnum}}  <?php if($recnum == "0"){ echo "selected='selected'";} ?> >{{ $tanknum }} </option>
	       			@foreach ($list_tanks as $li_tank)
	       				<option value='{{$li_tank->recnum}}'>{{$li_tank->tank_num}}
	       			@endforeach
	         	</select>
	        </td>

	       	<td><input type="text" name="{{$itemname}}" id="{{$itemname}}" size="15%" value="" style=""></td>
	       	<td><input type="text" name="{{$optemp_min}}" id="{{$optemp_min}}" size="4%" value="" ></td>

	       	<td><input type="text" name="{{$optemp_max}}" id="{{$optemp_max}}" size="4%" value="" ></td>
	       	<td>
	       		<select name="{{$qty_check}}" id="{{$qty_check}}" >
		          <option value='Yes'>Yes
		          <option value='No' selected>No
	         	</select>
	        </td>

	       	<td>
	       		<select name="{{$paint_check}}" id="{{$paint_check}}" >
		          <option value='Yes'>Yes
		          <option value='No' selected>No
	         	</select>
	       	</td>
	       	<td>
	       		<select name="{{$time_check}}" id="{{$time_check}}" >
		          <option value='Yes'>Yes
		          <option value='No' selected>No
	         	</select>
	       	</td>

	       	<td>
	       		<select name="{{$form2}}" id="{{$form2}}" >
		          <option value='Yes'>Yes
		          <option value='No' selected>No
	         	</select>
	       	</td>
	       	<td><input type="text" name="{{$workcenter}}" id="{{$workcenter}}" size="35%" value=""></td>
	       	<td><input type="text" name="{{$comments}}" id="{{$comments}}" size="40%" value=""></td>

	       	
				</tr>
			<?php 
				 $i++;
    	}
			?>

		<input type="hidden" name="index" id="index" value="{{$i}}">
	</table>

	<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/>
	{!! Form::close() !!}
@stop