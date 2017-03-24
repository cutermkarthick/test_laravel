@extends('newtemp.main')
@section('content')
	<?php 
		$userid = session('user');
		$userid = Session::get('user');
	?>


	<script src="{{ asset('assets/scripts/master_data.js') }} "></script>
	 <script type="text/javascript">

    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });

  </script>

	{!!  Form::open(['route'=>'submit_newmaster' , 'class'=>'form']) !!}

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
		<tr>
			<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
			<td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
		 </tr>
	</table>
	<br>

	<input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
	
	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
		</tr>

		<tr bgcolor="#FFFFFF">
			<td><span class="labeltext"><p align="left">* PIN</p></span></td>
			<td ><input type="text" size=25  name="CIM_refnum" id="CIM_refnum" value=""  ></td>

			<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Type</p></span></td>
      <td ><span class="tabletext">
      <select name="pin_type" id="pin_type">
          <option value="Regular" selected>Regular</option>
          <option value="Periodic">Periodic</option>
      </select>
      </span>
      </td>
		</tr>

		<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR #</p></span></td>
            <td><input type="text"  style="background-color:#DDDDDD;" id="mrnum" name="mrnum" size=20 value="" readonly='readonly'> 
            <button type="button" class="btn btn-default" onclick="Getmr()">Get</button>
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR Iss</p></span></td>
            <td><span class="tabletext"><input type="text" name="mrissue" id="mrissue" size=20 value=""></span></td>

		
		</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></span></td>
            <td><input type="text" name="partname" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></span></td>
            <td><span class="labeltext"><input type="text" name="partnum" size=20 value=""></span></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Project</p></span></td>
            <td><input type="text" name="project" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Customer</p></span></td>
            <td><input type="text" name="customer" size=20 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Issue</p></span></td>
            <td><input type="text" name="part_issue" size=20 value=""></td>        
            <td><span class="labeltext"><p align="left">Attachments</p></span></td>
            <td><input type="text" name="attachment" size=20 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></span></td>
            <td><input type="text" name="drawing_num" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></span></td>
            <td><input type="text" name="drg_issue" size=20 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></span></td>
            <td><input type="text" name="rm_type" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></span></td>
            <td><input type="text" name="rm_spec" size=20 value=""></td>
        </tr>
        

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></span></td>
            <td><input type="text" name="cos" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Part List</p></span></td>
            <td><input type="text" name="part_list" size=20 value=""></td>        
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></span></td>
            <td><input type="text" name="tech_sheet_no" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Issue</p></span></td>
            <td><input type="text" name="tech_sheet_issue" size=20 value=""></td>        
        </tr>

       <input type="hidden" name="RM_by_CIM" size=20 value="0">
       <input type="hidden" name="RM_by_customer" size=20 value="">
       <input type="hidden" name="mps_rev" size=20 value="">
       <input type="hidden" name="mps_num" size=20 value="">
       <input type="hidden" name="model_issue" id="model_issue" size=20 value="">

  </table>

  <div id="mr_li">
    
	</div>

		<input type="hidden" id="mrrecnum" name="mrrecnum" value="">
		<input type="hidden" id="index" value>
		<input type="hidden" name="pagename" id="pagename" value="newmaster_data">

  	<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/>
{!! Form::close() !!}
@stop