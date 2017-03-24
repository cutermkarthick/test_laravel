@extends('newtemp.main')
@section('content')
	
    <script type="text/javascript">
      
        jQuery(document).ready(function($){
          $( "#wdate1" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

	        });
	    });

	    jQuery(document).ready(function($){
          $( "#wdate2" ).datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',
            autoclose: true,

	        });
	    });

	</script>

	{!!  Form::open(['url'=>'fair' , 'class'=>'form', 'method' => 'post']) !!}

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>

	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr>
			<td bgcolor="#F5F6F5" colspan="10"><span class="heading"><b><center>Search Criteria</center></b></span></td>
			<td bgcolor="#FFFFFF" rowspan=3  align="center"><span class="tabletext">
			<button  class="btn btn-default" type="submit">Search</button>
			</td>
		</tr>

		<tr>

			<td bgcolor="#FFFFFF"><span class="labeltext">PIN #</span></td>
			<td bgcolor="#FFFFFF"><input type="text" name="pin" size=15 value="{{$pin}}" onkeypress="javascript: return checkenter(event)"></td>

			
			<td bgcolor="#FFFFFF"><span class="labeltext"><b>WO Date:</b></td>
	        <td  bgcolor="#FFFFFF"><span class="heading"><b>From:&nbsp;</b><input type="text" name="wdate1" id="wdate1" size=10 value="{{$wdate1}}" >
	         <span class="labeltext"><b>&nbsp;&nbsp;To:&nbsp;</b>
	        <input type="text" name="wdate2" id="wdate2" size=10 value="{{$wdate2}}" >
	       </td>

		
			<td bgcolor="#FFFFFF"><span class="labeltext">Type </span></td>
			<td bgcolor="#FFFFFF"><input type="text" name="final_type" size=15 value="{{$final_type}}" onkeypress="javascript: return checkenter(event)"></td>
		</tr>

		<tr>
			<td bgcolor="#FFFFFF"><span class="labeltext">Status </span></td>
			<td bgcolor="#FFFFFF" colspan=3>
				<span class="tabletext">
		  		<select name="status" size="1" > 
		  			<option value="All" <?php if($sval == "All"){ echo "selected= 'selectd'"; } ?>>All</option>
		  			<option value="NC" <?php if($sval == "NC"){ echo "selected= 'selectd'"; } ?>>NC</option>
		  			<option value="APPROVED" <?php if($sval == "APPROVED"){ echo "selected= 'selectd'"; } ?>>APPROVED</option>
		  			<option value="CUST APPROVED" <?php if($sval == "CUST APPROVED"){ echo "selected= 'selectd'"; } ?>>CUST APPROVED</option>
		  			<option value="RE FAIR" <?php if($sval == "RE FAIR"){ echo "selected= 'selectd'"; } ?>>RE FAIR</option>
		  			<option value="DELTA FAIR" <?php if($sval == "DELTA FAIR"){ echo "selected= 'selectd'"; } ?>>DELTA FAIR</option>
		  		</select>
	  		</span>
			</td>

			<td bgcolor="#FFFFFF" colspan=4></td>
			<td bgcolor="#FFFFFF" colspan=4></td>

		</tr>

	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="6">
		<tr>
			<td><span class="heading"><b>FAIR Entries</b></span></td>
			
		</tr>
	</table>
	<br>

	<table style="table-layout: fixed" width="100%" border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="table table-bordered">
		<tr  bgcolor="#FFCC00">
        	<td bgcolor="#EEEFEE"><span class="tabletext"><b>Seq#</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>PIN</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>WO</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>WO Date</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>NC</b></span></td>
            <td bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
        </tr>

        @foreach ($results as $myrow)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"><a href="{!! route('pin_details', ['recnum'=> $myrow->recnum]) !!}">{{ $myrow->recnum }}</a></span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->crn }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->wonum }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->cofc }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->wo_date }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->type }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrow->nc }} </span> </td>
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