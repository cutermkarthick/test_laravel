@extends('newtemp.main')
@section('content')
		
		<script src="{{ asset('assets/scripts/master_data.js') }} "></script>
         <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
          });

          </script>

		<table width=100% border=0 cellspacing="0" cellpadding="0" >
			<tr>
				<td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
				<td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
			 </tr>
		</table>
		<br>
        <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">

        {!!  Form::open(['route'=>'submit_newmaster' , 'class'=>'form']) !!}
		<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
			<tr>
				<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
			</tr>

			@if(($dept =='Sales' || $dept =='SALES') || ($dept =='ENG' || $dept =='eng') )

				@if($myrow->status == 'Active')
				<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">* PIN</p></span></td>
					<td ><input type="text" size=25  name="CIM_refnum" id="CIM_refnum" value="{{ $myrow->CIM_refnum }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>

					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Type</p></span></td>
					<td ><input type="text" size=25  name="pin_type" id="pin_type" value="{{ $myrow->pin_type }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>
				</tr>

				<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR #</p></span></td>
            <td><input type="text"  style="background-color:#DDDDDD;" id="mrnum" name="mrnum" size=20 value="{{ $myrow->bomnum }}" readonly='readonly'> 
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR Iss</p></span></td>
            <td><span class="tabletext"><input type="text" name="mrissue" id="mrissue" size=20 value="{{ $myrow->mrissue }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>
				</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></span></td>
            <td><input type="text" name="partname" size=20 value="{{$myrow->partname}}" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></span></td>
            <td><span class="labeltext"><input type="text" name="partnum" size=20 value="{{ $myrow->partnum }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            
             <td><span class="labeltext"><p align="left">Part Issue</p></font></td>
            <td><input type="text" name="part_issue" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->part_issue}} "></td>

            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->attachments}}"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" style="background-color:#DDDDDD;" readonly='readonly' size=30 value="{{$myrow->customer}} ">
            </td>

            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->project}} "></td> 

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drawing_num}} ">
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drg_issue}} "></td>

           
        </tr>
          
        <tr bgcolor="#FFFFFF">
          
           <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_type}} "></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_spec}} "></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></font></td>
            <td><input type="text" name="cos" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->cos}} "></td>
            <td><span class="labeltext"><p align="left">Part List</p></font></td>
           <td><input type="text" name="part_list" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->part_list}} "></td> 
        </tr>

        <tr bgcolor="#FFFFFF">
      
             <td><span class="labeltext"><p align="left">Status</p></font></td>
              <td><span class="labeltext"><input type="text" id="status" name="status" size="15" readonly="readonly" value="{{$myrow->status}}">
              <span class="tabletext">
              <select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
                <option value='Active' selected>Active
                <option value='Inactive'>Inactive
             </select></td>
            <td colspan='2'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></font></td>
            <td><input type="text" name="tech_sheet_no" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_no}} "></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Iss</p></font></td>
            <td><input type="text" name="tech_sheet_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_issue}} "></td>
        </tr>
      
      @else

      	<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">* PIN</p></span></td>
					<td ><input type="text" size=25  name="CIM_refnum" id="CIM_refnum" value="{{ $myrow->CIM_refnum }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>

					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Type</p></span></td>
					<td ><span class="tabletext">
		      <select name="pin_type" id="pin_type">
		          <option value="Regular" <?php if( ($myrow->pin_type == "Regular") || ($myrow->pin_type == "") ) {echo "selected='selected'";}?>>Regular</option>
		          <option value="Periodic" <?php if($myrow->pin_type == "Periodic") {echo "selected='selected'";}?>>Periodic</option>
		      </select>
		      </span>
		      </td>
				</tr>

				<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR #</p></span></td>
            <td><input type="text"  style="background-color:#DDDDDD;" id="mrnum" name="mrnum" size=20 value="{{ $myrow->bomnum }}" readonly='readonly'> 
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR Iss</p></span></td>
            <td><span class="tabletext"><input type="text" name="mrissue" id="mrissue" size=20 value="{{ $myrow->mrissue }}" ></span></td>
				</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></span></td>
            <td><input type="text" name="partname" size=20 value="{{$myrow->partname}}" ></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></span></td>
            <td><span class="labeltext"><input type="text" name="partnum" size=20 value="{{ $myrow->partnum }}" ></span></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            
             <td><span class="labeltext"><p align="left">Part Issue</p></font></td>
            <td><input type="text" name="part_issue" size=20 value="{{$myrow->part_issue}}">

            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20  value="{{$myrow->attachments}}"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" ' size=30 value="{{$myrow->customer}} ">
            </td>

            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project"  size=20 value="{{$myrow->project}} "></td> 

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num"  size=20 value="{{$myrow->drawing_num}} ">
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue"  size=20 value="{{$myrow->drg_issue}} "></td>

           
        </tr>
          
        <tr bgcolor="#FFFFFF">
          
           <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type"  size=20 value="{{$myrow->rm_type}} "></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec"  size=20 value="{{$myrow->rm_spec}} "></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></font></td>
            <td><input type="text" name="cos" size=20  value="{{$myrow->cos}} "></td>
            <td><span class="labeltext"><p align="left">Part List</p></font></td>
           <td><input type="text" name="part_list"  size=20 value="{{$myrow->part_list}} "></td> 
        </tr>

        <tr bgcolor="#FFFFFF">
      
             <td><span class="labeltext"><p align="left">Status</p></font></td>
              <td><span class="labeltext"><input type="text" id="status" name="status" size="15" readonly="readonly" value="{{$myrow->status}}">
              <span class="tabletext">
              <select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
                <option value='Active' <?php if($myrow->status == "Active"){ echo "selected='selected'";}?>>Active
                <option value='Pending' <?php if($myrow->status == "Pending"){ echo "selected='selected'";}?>>Pending
                <option value='Cancelled' <?php if($myrow->status == "Cancelled"){ echo "selected='selected'";}?>>Cancelled
                <option value='Inactive' <?php if($myrow->status == "Inactive"){ echo "selected='selected'";}?> >Inactive
             </select></td>
            <td colspan='2'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></font></td>
            <td><input type="text" name="tech_sheet_no"  size=20 value="{{$myrow->tech_sheet_no}} "></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Iss</p></font></td>
            <td><input type="text" name="tech_sheet_issue"  size=20 value="{{$myrow->tech_sheet_issue}} "></td>
        </tr>

      @endif

    @else

    	@if($myrow->status == 'Active')

    			<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">* PIN</p></span></td>
					<td ><input type="text" size=25  name="CIM_refnum" id="CIM_refnum" value="{{ $myrow->CIM_refnum }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>

					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Type</p></span></td>
					<td ><input type="text" size=25  name="pin_type" id="pin_type" value="{{ $myrow->pin_type }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>
				</tr>

				<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR #</p></span></td>
            <td><input type="text"  style="background-color:#DDDDDD;" id="mrnum" name="mrnum" size=20 value="{{ $myrow->bomnum }}" readonly='readonly'> 
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR Iss</p></span></td>
            <td><span class="tabletext"><input type="text" name="mrissue" id="mrissue" size=20 value="{{ $myrow->mrissue }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>
				</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></span></td>
            <td><input type="text" name="partname" size=20 value="{{$myrow->partname}}" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></span></td>
            <td><span class="labeltext"><input type="text" name="partnum" size=20 value="{{ $myrow->partnum }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            
             <td><span class="labeltext"><p align="left">Part Issue</p></font></td>
            <td><input type="text" name="part_issue" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->part_issue}} "></td>

            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->attachments}}"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" style="background-color:#DDDDDD;" readonly='readonly' size=30 value="{{$myrow->customer}} ">
            </td>

            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->project}} "></td> 

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drawing_num}} ">
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drg_issue}} "></td>

           
        </tr>
          
        <tr bgcolor="#FFFFFF">
          
           <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_type}} "></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_spec}} "></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></font></td>
            <td><input type="text" name="cos" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->cos}} "></td>
            <td><span class="labeltext"><p align="left">Part List</p></font></td>
           <td><input type="text" name="part_list" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->part_list}} "></td> 
        </tr>

        <tr bgcolor="#FFFFFF">
      
             <td><span class="labeltext"><p align="left">Status</p></font></td>
              <td><span class="labeltext"><input type="text" id="status" name="status" size="15" readonly="readonly" value="{{$myrow->status}}">
              <span class="tabletext">
              <select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
                <option value='Active' selected>Active
                <option value='Pending'>Pending
                <option value='Cancelled'>Cancelled
                <option value='Inactive'>Inactive
             </select></td>
            <td colspan='2'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></font></td>
            <td><input type="text" name="tech_sheet_no" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_no}} "></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Iss</p></font></td>
            <td><input type="text" name="tech_sheet_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_issue}} "></td>
        </tr>

    	@else

    		<tr bgcolor="#FFFFFF">
					<td><span class="labeltext"><p align="left">* PIN</p></span></td>
					<td ><input type="text" size=25  name="CIM_refnum" id="CIM_refnum" value="{{ $myrow->CIM_refnum }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>

					<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Type</p></span></td>
					<td ><input type="text" size=25  name="pin_type" id="pin_type" value="{{ $myrow->pin_type }}"  style="background-color:#DDDDDD;" readonly="readonly"></td>
				</tr>

				<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR #</p></span></td>
            <td><input type="text"  style="background-color:#DDDDDD;" id="mrnum" name="mrnum" size=20 value="{{ $myrow->bomnum }}" readonly='readonly'> 
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>MR Iss</p></span></td>
            <td><span class="tabletext"><input type="text" name="mrissue" id="mrissue" size=20 value="{{ $myrow->mrissue }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>
				</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></span></td>
            <td><input type="text" name="partname" size=20 value="{{$myrow->partname}}" style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></span></td>
            <td><span class="labeltext"><input type="text" name="partnum" size=20 value="{{ $myrow->partnum }}" style="background-color:#DDDDDD;" readonly="readonly"></span></td>

        </tr>

         <tr bgcolor="#FFFFFF">
            
             <td><span class="labeltext"><p align="left">Part Issue</p></font></td>
            <td><input type="text" name="part_issue" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->part_issue}} "></td>

            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="text" name="attachment" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->attachments}}"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             
             <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><input type="text" name="customer" style="background-color:#DDDDDD;" readonly='readonly' size=30 value="{{$myrow->customer}} ">
            </td>

            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->project}} "></td> 

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drawing_num}} ">
            </td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->drg_issue}} "></td>

           
        </tr>
          
        <tr bgcolor="#FFFFFF">
          
           <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_type}} "></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->rm_spec}} "></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS Iss</p></font></td>
            <td><input type="text" name="cos" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="{{$myrow->cos}} "></td>
            <td><span class="labeltext"><p align="left">Part List</p></font></td>
           <td><input type="text" name="part_list" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->part_list}} "></td> 
        </tr>

        <tr bgcolor="#FFFFFF">
      
             <td><span class="labeltext"><p align="left">Status</p></font></td>
              <td><span class="labeltext"><input type="text" id="status" name="status" size="15" readonly="readonly" value="{{$myrow->status}}">
              <span class="tabletext">
              <select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
                <option value='Active' selected>Active
                <option value='Pending'>Pending
                <option value='Cancelled'>Cancelled
                <option value='Inactive'>Inactive
             </select></td>
            <td colspan='2'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Technique Sheet No</p></font></td>
            <td><input type="text" name="tech_sheet_no" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_no}} "></td>
            <td><span class="labeltext"><p align="left">Technique Sheet Iss</p></font></td>
            <td><input type="text" name="tech_sheet_issue" style="background-color:#DDDDDD;" readonly='readonly' size=20 value="{{$myrow->tech_sheet_issue}} "></td>
        </tr>

    	@endif


    @endif


    	@if($dept == 'ppc' || $dept =='PPC')

    		<tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">PPC Approved By</p></span></td>
         <td ><input type="checkbox" name="approved" id="approved" <?php if ($myrow->ppc_approved == 'yes') echo "checked='checked'"; ?> value="<?php echo $myrow->ppc_approved ?>" onclick="javascript:setappval()">
            <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow->ppc_approved_by ?>" >
          </td>
          <td><span class="labeltext"><p align="left">PPC Approved Date</p></span></td>
          <td ><input type="text" name="ppc_app_date"  id="ppc_app_date" size=20  readonly="readonly" value="<?php echo $myrow->ppc_app_date  ?>">
          <input type="hidden" name="tod_date" id="tod_date"  value="<?php echo $today ;?>">
          </td>
        </tr>
      
      @elseif($dept == "sales" || $dept == "Sales")

    		<tr bgcolor="#FFFFFF">
         	<td><span class="labeltext"><p align="left">Approved By</p></span></td>
	        <td ><input type="checkbox" name="approved" id="approved" <?php if ($myrow->ppc_approved == 'yes') echo "checked='checked'"; ?> value="<?php echo $myrow->ppc_approved ?>" onclick="javascript:setappval()">
	          <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow->ppc_approved_by ?>" >
          </td>
          <td><span class="labeltext"><p align="left">Approved Date</p></span></td>
          <td ><input type="text" name="ppc_app_date"  id="ppc_app_date" size=20  readonly="readonly" value="<?php echo $date1 ?>">
          <input type="hidden" name="tod_date" id="tod_date"  value="<?php echo $today ;?>">
          </td>
           
        </tr>

         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
           <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="<?php echo $myrow->qa_approved ?>" onclick="javascript:setqaappval()">
            <input type="hidden" name="qa_approved_by" id="qa_approved_by" value ="<?php echo $myrow->qa_approved_by ?>">
            </td>
            <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
            <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="<?php echo $date2 ?>">
            <input type="hidden" name="tod_date1" id="tod_date1"  value="<?php echo $today ;?>">
            </td>
           
        </tr>
      
      @elseif($dept == "sales" || $dept == "Sales")

      	<input type="hidden" id="approved" name="approved" value="<?php echo $myrow->ppc_approved; ?>">
        <input type="hidden" id="approved_by" name="approved_by" value="<?php echo $myrow->ppc_approved_by; ?>">
        <input type="hidden" id="ppc_app_date" name="ppc_app_date" value="<?php echo $myrow->ppc_app_date; ?>">
        <input type="hidden" id="tod_date" name="tod_date" value="<?php echo $myrow->today; ?>">


        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
           <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="<?php echo $myrow->qa_approved?>" onclick="javascript:setqaappval()">
            <input type="hidden" name="qa_approved_by" id="qa_approved_by" value ="<?php echo $myrow->qa_approved_by?>">
            </td>
            <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
            <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="<?php echo $myrow->qa_app_date ?>">
            <input type="hidden" name="tod_date1" id="tod_date1"  value="<?php echo $today ;?>">
            </td>
           
        </tr>

      @else

      	<input type="hidden" id="approved" name="approved" value="<?php echo $myrow->ppc_approved; ?>">
        <input type="hidden" id="approved_by" name="approved_by" value="<?php echo $myrow->ppc_approved_by; ?>">
        <input type="hidden" id="ppc_app_date" name="ppc_app_date" value="<?php echo $myrow->ppc_app_date; ?>">
        <input type="hidden" id="tod_date" name="tod_date" value="<?php echo $myrow->today; ?>">

        <input type="hidden" id="qa_approved" name="qa_approved" value="<?php echo $myrow->qa_approved; ?>">
        <input type="hidden" id="qa_approved_by" name="qa_approved_by" value="<?php echo $myrow->qa_approved_by; ?>">
        <input type="hidden" id="qa_app_date" name="qa_app_date" value="<?php echo $myrow->qa_app_date; ?>">
        <input type="hidden" id="tod_date1" name="tod_date1" value="<?php echo $myrow->today; ?>">

    	@endif


    <tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>Notes for PIN Master</b></center></td>
			</tr>
			<tr >
				<td colspan=10>
					<textarea  rows="6" cols="81" style="background-color:#DDDDDD;" readonly="readonly" disabled>
                    @if(!empty($notes))
							@foreach ($notes as $myrow4notes)
								<?php 
									printf("\n");
                	                printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
                	                printf("\n");
                	                printf($myrow4notes->pin_notes);
                	                printf("   \n");
								?>
							@endforeach
					@endif
					</textarea>
				</td>
			</tr>

			<tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>Add Notes</b></center></td>
			</tr>

			<tr bgcolor="#FFFFFF">
        <td colspan=8><textarea name="notes" id="notes" rows="3" cols="81" value=""></textarea></td> 
      </tr>

  </table>

  		<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
				
				<tr bgcolor="#EEEFEE">
						<td colspan=10><span class="heading"><center><b>Master Routing Flow</b></center></td>
				</tr>

				<tr>
					<td bgcolor="#EEEFEE" width=3% align="center"><span class="heading"><b>Line Num</b></span></td>
					<td bgcolor="#EEEFEE" width=5% align="center"><span class="heading"><b>OP No</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Description </b></span></td>
					<td bgcolor="#EEEFEE" width=5% align="center"><span class="heading"><b>PS NO</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Spec</b></span></td>
					<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Std Iss</b></span></td>
					<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Dept</b></span></td>

				</tr>

				@foreach ($lidetails as $myrowli)
	    	<tr>
			    <td bgcolor="#FFFFFF"><span class="tabletext"> {{ $myrowli->linenum }}</span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->op_num }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->desc }}  </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->ps_no }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->spec }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->std_iss_ref }} </span> </td>
			    <td bgcolor="#FFFFFF"><span class="tabletext">  {{ $myrowli->dept }} </span> </td>


		    </tr>
		    @endforeach
	  </table>

        <input type="hidden" name="userid" id="userid" value ="<?php echo $userid?>">
        <input type="hidden" name="RM_by_customer" size=20 value="">
        <input type="hidden" name="mps_rev" size=20 value="">
        <input type="hidden" name="mps_num" size=20 value="">
        <input type="hidden" name="model_issue" size=20 value="">
        <input type="hidden" name="pagename" id="pagename" value="edit_master_data">
        <input type="hidden" name="prevstatus" id="prevstatus" value="<?php echo $myrow->status ;?>">
        <input type='hidden' name='masterdatarecnum' value='<?php echo $masterdatarecnum; ?>'></td>

    <input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/>

{!! Form::close() !!}
@stop