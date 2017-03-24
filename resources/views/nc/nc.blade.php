@extends('newtemp.main')
@section('content')
	
	<script type="text/javascript">
      
        jQuery(document).ready(function($){
          $( "#final_date1" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

	        });
	    });

	    jQuery(document).ready(function($){
          $( "#final_date2" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

	        });
	    });

	</script>

	{!!  Form::open(['url'=>'nc' , 'class'=>'form', 'method' => 'post']) !!}

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<br>

	<tr><td><span class="heading"><i>Please click on the CIM Ref No to Edit/Delete</i></span></td></tr>
	

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="12"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">CRN No</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="refno_oper" size="1" width="50">
						<option value="like" <?php if($refno_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($refno_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_refno" size=15 value="{{$final_refno}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">WO No </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="wono_oper" size="1" width="50">
						<option value="like" <?php if($wono_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($wono_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_wono" size=15 value="{{$final_wono}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">C Of C No </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="cofc_oper" size="1" width="50">
						<option value="like" <?php if($cofc_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($cofc_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_cofc" size=15 value="{{$final_cofc}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Status </span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="status" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="Open" <?php if($sval == "Open"){ echo "selected= 'selectd'"; } ?>>Open</option>
		  			<option value="Pending" <?php if($sval == "Pending"){ echo "selected= 'selectd'"; } ?>>Pending</option>
		  			<option value="Closed" <?php if($sval == "Closed"){ echo "selected= 'selectd'"; } ?>>Closed</option>
		  			<option value="Cancelled" <?php if($sval == "Cancelled"){ echo "selected= 'selectd'"; } ?>>Cancelled</option>
		  		</select>
	  		</span>
			</td>

		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Id No</span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="idno_oper" size="1" width="50">
						<option value="like" <?php if($idno_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($idno_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_idno" size=15 value="{{$final_idno}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Part No </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="part_oper" size="1" width="50">
						<option value="like" <?php if($part_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($part_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_part" size=15 value="{{$final_part}}" onkeypress="javascript: return checkenter(event)"></td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Customer </span></td>
			<td bgcolor="#FFFFFF">
				<span class="tabletext">
					<select name="cust_oper" size="1" width="50">
						<option value="like" <?php if($cust_oper == "like"){echo "selected='selected'";}?>>Like</option>
						<option value="=" <?php if($cust_oper == "="){echo "selected='selected'";}?>>=</option>
					</select>
				</span>
			</td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_cust" size=15 value="{{$final_cust}}" onkeypress="javascript: return checkenter(event)"></td>

			<td bgcolor="#FFFFFF"><span class="labeltext">Create Date:</td>
	        <td  bgcolor="#FFFFFF"><span class="heading">From:&nbsp;<input type="text" name="final_date1" id="final_date1" size=10 value="{{$final_date1}}" >
	         <span class="labeltext">&nbsp;&nbsp;To:&nbsp;
	        <input type="text" name="final_date2" id="final_date2" size=10 value="{{$final_date2}}" >
	       </td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>List of Nc's</b></span></td>
			
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
		<tr  bgcolor="#FFCC00">
        	<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Id No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Create Date</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>CIM Ref No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>C Of C No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Batch No.</b></span></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
        </tr>

         @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->create_date }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->wonum }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->refnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->cofcnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->customer }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partname }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->partnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->bachnum }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->status }} </span> </td>
		    </tr>
	    @endforeach



    </table>


    @if($totpages != 0)
		<span class="labeltext"> <?php echo $first.' ' . $prev;?>  Showing page <strong>{{ $pageNum }} </strong> of <strong>{{ $totpages }}</strong> pages <?php echo $next.' ' . $last;?> </span>
	@else
		<span class="labeltext" style="text-align: center;">No matching records found</center>
	@endif

	{!! Form::close() !!}

@stop