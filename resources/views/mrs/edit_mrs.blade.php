@extends('newtemp.main')
@section('content')
	<?php 
     $userid = session('user');
     $dept = session('department');
     $edept = session('department');
     $userrole = session('userrole');

		 $myrow = $details[0];
		 $today = date('Y-m-d') ;
     $myrevrow=$myrevrow[0];
		
	?>	

	<script src="{{ asset('assets/scripts/master_route.js') }} "></script>
	<script type="text/javascript">
      
        jQuery(document).ready(function($){
          $( "#date" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true,
                    showOtherMonths: true,
                    selectOtherMonths: false,

                  });
    });
  </script>

  {!!  Form::open(['route'=>'submit_editmrs' , 'class'=>'form', 'name'=>'myForm']) !!}

	<table width=100% border=0 cellspacing="0" cellpadding="0" >
    <tr>
      <td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
      <td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
     </tr>
  </table>
  <br>

  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>Edit Master Routing Header</b></span></td>
		</tr>
    <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">

    @if(($dept =='Sales' || $dept =='SALES') || ($dept =='ENG' || $dept =='eng'))
        
        @if($myrow->status == 'Active')

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DOC ID</p></span></td>
            <td  ><input type="text" size=25  name="doc_id" id="doc_id" value="{{ $myrow->doc_id }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Issue</p></font></span></td>
            <td><input type="text" name="issue" id="issue" style="background-color:#DDDDDD;" readonly="readonly"  size=25 value="{{ $myrow->issue }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></span></td>
            <td  ><input type="text" size=20  name="customer" id="customer" value="{{ $myrow->customer }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Date</p></font></span></td>
            <td><input type="text" name="date" id="date" style="background-color:#DDDDDD;" readonly="readonly"  size=20 value="{{ $myrow->date }}"></td>
          </tr>


          <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Scope</p></font></td>
                <td><textarea name="scope" id="scope" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->scope }}</textarea>
                <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
                <td><textarea name="response" id="response" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->response }}</textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Reference</p></font></td>
                <td><textarea name="reference" id="reference" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->reference }}</textarea></td>
                <td><span class="labeltext"><p align="left">status</p></font></td>
                <td><input type="text" name="status" id="status" size=20 value="{{ $myrow->status }}" style="background-color:#DDDDDD;"  readonly="readonly">
                  <select name="sostate" size="1" width="20" onchange="onSelectStatuss()">
                  <option value="Active" <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?>>Active</option>
                  <option value="Inactive" <?php if($myrow->status == "Inactive"){ echo "selected= 'selectd'"; } ?>>Inactive</option></select>
                </td>
            </tr>

        @else

      		<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DOC ID</p></span></td>
            <td  ><input type="text" size=25  name="doc_id" id="doc_id" value="{{ $myrow->doc_id }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Issue</p></font></span></td>
            <td><input type="text" name="issue" id="issue"   size=25 value="{{ $myrow->issue }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></span></td>
            <td  ><input type="text" size=20  name="customer" id="customer" value="{{ $myrow->customer }}" ></span></td>

            <td><span class="labeltext"><p align="left">Date</p></font></span></td>
            <td><input type="text" name="date" id="date"   size=20 value="{{ $myrow->date }}"></td>
          </tr>


          <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Scope</p></font></td>
                <td><textarea name="scope" id="scope" rows="3" cols="50" >{{ $myrow->scope }}</textarea>
                <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
                <td><textarea name="response" id="response" rows="3" cols="50" >{{ $myrow->response }}</textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Reference</p></font></td>
                <td><textarea name="reference" id="reference" rows="3" cols="50" >{{ $myrow->reference }}</textarea></td>
                <td><span class="labeltext"><p align="left">status</p></font></td>
                <td><input type="text" name="status" id="status" size=20 value="{{ $myrow->status }}" style="background-color:#DDDDDD;"  readonly="readonly">
                  <select name="sostate" size="1" width="20" onchange="onSelectStatuss()">
                  <option value="Active" <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?>>Active</option>
                  <option value="Pending" <?php if($myrow->status == "Pending"){ echo "selected= 'selectd'"; } ?>>Pending</option>
              		<option value="Cancelled" <?php if($myrow->status == "Cancelled"){ echo "selected= 'selectd'"; } ?>>Cancelled </option>
                  <option value="Inactive" <?php if($myrow->status == "Inactive"){ echo "selected= 'selectd'"; } ?>>Inactive</option></select>
                </td>
            </tr>


        @endif

    @else

    		@if($myrow->status == 'Active')

  				<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DOC ID</p></span></td>
            <td  ><input type="text" size=25  name="doc_id" id="doc_id" value="{{ $myrow->doc_id }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Issue</p></font></span></td>
            <td><input type="text" name="issue" id="issue" style="background-color:#DDDDDD;" readonly="readonly"  size=25 value="{{ $myrow->issue }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></span></td>
            <td  ><input type="text" size=20  name="customer" id="customer" value="{{ $myrow->customer }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Date</p></font></span></td>
            <td><input type="text" name="date" id="date" style="background-color:#DDDDDD;" readonly="readonly"  size=20 value="{{ $myrow->date }}"></td>
          </tr>


          <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Scope</p></font></td>
                <td><textarea name="scope" id="scope" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->scope }}</textarea>
                <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
                <td><textarea name="response" id="response" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->response }}</textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Reference</p></font></td>
                <td><textarea name="reference" id="reference" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->reference }}</textarea></td>
                <td><span class="labeltext"><p align="left">status</p></font></td>
                <td><input type="text" name="status" id="status" size=20 value="{{ $myrow->status }}" style="background-color:#DDDDDD;"  readonly="readonly">
                </td>
            </tr>

        @else

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DOC ID</p></span></td>
            <td  ><input type="text" size=25  name="doc_id" id="doc_id" value="{{ $myrow->doc_id }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Issue</p></font></span></td>
            <td><input type="text" name="issue" id="issue" style="background-color:#DDDDDD;" readonly="readonly"  size=25 value="{{ $myrow->issue }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></span></td>
            <td  ><input type="text" size=20  name="customer" id="customer" value="{{ $myrow->customer }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">Date</p></font></span></td>
            <td><input type="text" name="date" id="date" style="background-color:#DDDDDD;" readonly="readonly"  size=20 value="{{ $myrow->date }}"></td>
          </tr>


          <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Scope</p></font></td>
                <td><textarea name="scope" id="scope" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->scope }}</textarea>
                <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
                <td><textarea name="response" id="response" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->response }}</textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Reference</p></font></td>
                <td><textarea name="reference" id="reference" rows="3" cols="50" style="background-color:#DDDDDD;"  readonly="readonly">{{ $myrow->reference }}</textarea></td>
                <td><span class="labeltext"><p align="left">status</p></font></td>
                <td><input type="text" name="status" id="status" size=20 value="{{ $myrow->status }}" style="background-color:#DDDDDD;"  readonly="readonly">
                </td>
            </tr>

    		@endif

    @endif

    <tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>MRS Notes for Master Routing</b></center></td>
			</tr>
			<tr >
				<td colspan=10>
					<textarea  rows="6" cols="81" style="background-color:#DDDDDD;" readonly="readonly" disabled>
						@foreach ($linotes as $myrow4notes)
							<?php 
								printf("\n");
                printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
                printf("\n");
                printf($myrow4notes->mrsnotes);
                printf("   \n");
							?>
						@endforeach
					</textarea>
				</td>
			</tr>

			<tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>Add Notes</b></center></td>
			</tr>

			<tr bgcolor="#FFFFFF">
        <td colspan=8><textarea name="notes" id="notes" rows="3" cols="81" value=""></textarea></td> 
      </tr>

      @if(($dept =='Sales' || $dept =='SALES'))
        
        @if($myrow->status == 'Active')

          <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Approved By</p></font></td>
             <td ><input type="checkbox" name="approved" id="approved" <?php if ($myrow->approved == 'yes') echo "checked='checked'"; ?> value="{{$myrow->approved}}" onclick="return false">
              <input type="hidden" name="approved_by" id="approved_by" value="{{$myrow->approved_by}} ">
              </td>
              <td><span class="labeltext"><p align="left">Approved Date</p></font></td>
              <td ><input type="text" name="app_date"  id="app_date" size=20  readonly="readonly" value="{{ $myrow->approved_date }}">
              <input type="hidden" name="tod_date" id="tod_date"  value="{{$today}}">
              </td>
          </tr>

        @else

        	<tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Approved By</p></font></td>
             <td ><input type="checkbox" name="approved" id="approved" <?php if ($myrow->approved == 'yes') echo "checked='checked'"; ?> value="{{$myrow->approved}}" onclick="javascript:setappval()">
              <input type="hidden" name="approved_by" id="approved_by" value="{{$myrow->approved_by}} ">
              </td>
              <td><span class="labeltext"><p align="left">Approved Date</p></font></td>
              <td ><input type="text" name="app_date"  id="app_date" size=20  readonly="readonly" value="{{ $myrow->approved_date }}">
              <input type="hidden" name="tod_date" id="tod_date"  value="{{$today}}">
              </td>
          </tr>

        @endif

      @elseif($dept =='QAS' || $dept =='QAS')

      		<input type="hidden" id="approved" name="approved" value="{{$myrow->approved}}">
          <input type="hidden" id="approved_by" name="approved_by" value="{{$myrow->approved_by}}">
          <input type="hidden" id="app_date" name="app_date" value="{{ $myrow->approved_date }}">
          <input type="hidden" id="tod_date" name="tod_date" value="{{$today}}">

      @else

      		<input type="hidden" id="approved" name="approved" value="{{$myrow->approved}}">
          <input type="hidden" id="approved_by" name="approved_by" value="{{$myrow->approved_by}}">
          <input type="hidden" id="app_date" name="app_date" value="{{ $myrow->approved_date }}">
          <input type="hidden" id="tod_date" name="tod_date" value="{{$today}}">

      @endif


      <input type="hidden" name="userid" id="userid" value ="{{ $userid }}">
      <input type='hidden' name='dept' id="dept" value='{{ $dept }}'>
      <input type='hidden' name='pagename' id="pagename" value='edit_route_master'>
      <input type="hidden" name="prevstatus" id="prevstatus" value="{{$myrow->status}}">
  </table>

  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr bgcolor="#EEEFEE">
			<td colspan=10><span class="heading"><center><b>MRS Revision History</b></center></span></td>
		</tr>

		<tr>
			<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Rev #</b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Rev Date</b></span></td>
			<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Descriptions </b></span></td>
			<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Owner</b></span></td>
			<td bgcolor="#EEEFEE" width=7% align="center"><span class="heading"><b>Approved By</b></span></td>
			<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Approved Date</b></span></td>
		</tr>



			@if(!empty($rev_his))

					@foreach($rev_his as $rev)

						@if($rev->approved_by != "" || $rev->approved_by != null)

							<tr>
								<td><center><input type="text"  value="{{$rev->rev_num}}" style="background-color:#DDDDDD;"  readonly="readonly"   size="3%"><center></td>
                <td><center><input type="text"  value="{{$rev->rev_date}}" style="background-color:#DDDDDD;"  readonly="readonly"   size="8%"><center></td>
                <td><center><textarea   style="background-color:#DDDDDD;"  readonly="readonly"   rows=2 cols=40>{{$rev->desc}}</textarea><center></td>
                <td><center><input type="text"  value="{{$rev->owner}} " style="background-color:#DDDDDD;"  readonly="readonly"   size="8%"><center></td>
                <td><center><input type="text"  value="{{$rev->approved_by}}" style="background-color:#DDDDDD;"  readonly="readonly"   size="8%"><center></td>
                <td><center><input type="text"  value="{{$rev->approved_date}}" style="background-color:#DDDDDD;"  readonly="readonly"   size="8%"><center></td>
							</tr>

						@endif

					@endforeach

			@endif

	</table>

	<table id="myTable2" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
		<tr bgcolor="#EEEFEE">
			<td colspan=10><span class="heading"><center><b>New Revision</b></center></span></td>
		</tr>	



		@if(!empty($myrevrow) && ($myrevrow->approved_by == "" || $myrevrow->approved_by == null ))

					<td bgcolor="#EEEFEE" width=2% align="center"><span class="heading"><b>Rev #</b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Rev Date</b></span></td>
					<td bgcolor="#EEEFEE" width=10% align="center"><span class="heading"><b>Descriptions </b></span></td>
					<td bgcolor="#EEEFEE" width=6% align="center"><span class="heading"><b>Owner</b></span></td>

					@if($userid == "atpl" )
						<td bgcolor="#EEEFEE"><span class="heading"><b><center>Approved By </center></b></span></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Approval Date</center></b></span></td>
					@endif
					</tr>

					<tr bgcolor="#FFFFFF">
            <input type="hidden" name="prev_revnum" id="prev_revnum" value="{{$myrevrow->rev_num}}">
            <input type="hidden" name="rev_recnum" id="rev_recnum" value="{{$myrevrow->recnum}} ">
	          <td><center><input type="text" id="rev_num"  name="rev_num" value="{{$myrevrow->rev_num}}"  style="background-color:#DDDDDD;"  readonly="readonly" size="3%"><center></td>
	          <td><center><input type="text" id="rev_date"  name="rev_date" value="{{$myrevrow->rev_date}} "   style="background-color:#DDDDDD;"  readonly="readonly" size="8%"><center></td>
	          <td><center><textarea id="rev_desc"  name="rev_desc" rows="2" cols="40">{{$myrevrow->desc}} </textarea><center></td>
	          <td><center><input type="text" id="rev_owner"  name="rev_owner" value="{{$myrevrow->owner}}"   style="background-color:#DDDDDD;"  readonly="readonly" size="8%"><center></td>

	          @if($userid == "atpl" )
	          	<td ><center><input type="checkbox" name="rev_approved" id="rev_approved"  onclick="javascript:setappval4rev()">
              <input type="hidden" name="rev_approved_by" id="rev_approved_by" value="" ></center>
              </td>
              <td ><center><input type="text" name="rev_app_date"  id="rev_app_date" size=20  readonly="readonly" value=""></center>
              <input type="hidden" name="revapp_date" id="revapp_date"  value="<?php echo $today ;?>">
              </td>

            @else

            	<td ><center><input type="checkbox" name="rev_approved" id="rev_approved" <?php if ($myrow->approved == 'yes') echo "checked='checked'"; ?> value="{{$myrevrow->approved}}" onclick="javascript:setappval()">
                <input type="hidden" name="rev_approved_by" id="rev_approved_by" value="{{$myrevrow->approved_by}}" ></center>
                </td>
              <td ><center><input type="text" name="rev_app_date"  id="rev_app_date" size=20  readonly="readonly" value="{{$myrevrow->approved_date}}">
                <input type="hidden" name="revapp_date" id="revapp_date"  value="{{$myrevrow->approved_date}}">
                </center>
              </td>

	        
				@endif
				<tr>
		
		@else

			<tr bgcolor="#FFFFFF">
        <td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev #</center></b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Date</center></b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
      </tr>

      <tr bgcolor="#FFFFFF">
      	<input type="hidden" name="prev_revnum" id="prev_revnum" value="">
	      <td><center><input type="text" id="rev_num"  name="rev_num" value="{{$mr_rev_num}}"  style="background-color:#DDDDDD;"  readonly="readonly" size="3%"><center></td>
	      <td><center><input type="text" id="rev_date"  name="rev_date" value="<?php echo date('Y-m-d');?>"   style="background-color:#DDDDDD;"  readonly="readonly" size="8%"><center></td>
	      <td><center><textarea id="rev_desc"  name="rev_desc" rows="2" cols="40"></textarea><center></td>
	      <td><center><input type="text" id="rev_owner"  name="rev_owner" value="<?php echo $userid;?>"   style="background-color:#DDDDDD;"  readonly="readonly" size="8%"><center></td>
	      <input type="hidden" name="rev_approved" id="rev_approved" value="">
          <input type="hidden" name="rev_approved_by" id="rev_approved_by" value="">
          <input type="hidden" name="rev_app_date" id="rev_app_date" value="">
      </tr>

		@endif
	</table>

	<div id="bom_li">

			<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
			  <tr bgcolor="#DDDEDD">
			    <td colspan=4><span class="heading"><center><b>Master Routing Line Items</b></center></span></td>
			  </tr>

			  @if( $dept == 'Sales' || $userid =="ENG" )

			  	@if($myrow->status != 'Active')

			  		<tr bgcolor="#FFFFFF">
			  			<td colspan=10>
			  				<a href="javascript:addRowsEdit('myTable',document.myForm.index.value)">
			  				<button type="button" class="btn btn-default">AddRow</button></a>
			  				</td>
			  		</tr>

			  	@endif

			  @endif

				  <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="table table-bordered">
					  <tr bgcolor="#FFFFFF">
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Line Num</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>OP NO</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Spec</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Std Iss</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>PS NO</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>PS Iss #</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Cofc Display</center></b></span></td>
						  <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dept</center></b></span></td>
					  </tr>

					  <?php
					  	$i = 1;

					  	foreach ($lidetails as  $myrowli) 
					  	{
					  			$linenum="line_num" . $i;
				          $desc="desc" . $i;
				          $op_no="op_no" . $i;
				          $ps_no="ps_no" . $i;
					        $spec="spec" . $i;
				          $recnum="recnum" . $i;
				          $dept="dept" . $i;
				          $std_iss="std_iss" . $i;
				          $display="display" . $i;
				          $ps_recnum="ps_recnum" . $i;
				          $ps_issue = "ps_issue" .$i;


				      ?>

				      @if($userid == 'atpl' || $userid == "eng")

				      		@if($myrow->status == 'Active' )

				      			<tr bgcolor="#FFFFFF">
				              <td><center><input type="text" id="{{$linenum}}"  name="{{$linenum}}" value="{{$myrowli->linenum}} " style="background-color:#DDDDDD;"  readonly="readonly"   size="3%"><center></td>
				               <td><center><input type="text" id="{{$op_no}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$op_no}}" value="{{$myrowli->op_num}}" size="10%"><center></td>
				               <td><center><input type="text" id="{{$desc}}"   name="{{$desc}}" value="{{$myrowli->desc}} "  size="40%"><center></td>

				              
				              <td><span class="tabletext"><center><input type="text"  name="{{$spec}}" id="{{$spec}}" value="{{$myrowli->spec}}" size="20%" style="background-color:#DDDDDD;" readonly="readonly"><img src="{{ asset('assets/images/bu-get.gif') }}" onclick="getspec4mrs({{$i}})"></center></center></td>

				              <td><span class="tabletext"><center><input type="text"  name="{{$std_iss}}" id="{{$std_iss}}" value="{{$myrowli->std_iss_ref}}" size="5%" style="background-color:#DDDDDD;" readonly="readonly"></center></td>


				              <td><center><input type="text" id="{{$ps_no}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_no}}" value="{{$myrowli->ps_no}}"  size="10%" ><center>
				                <input type="hidden" id="{{$ps_recnum}}"  name="{{$ps_recnum}}" value="{{$myrowli->link2ps}}"  size="20%" >
				               </td>
				              <td><center><input type="text" id="{{$ps_issue}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_issue}}" value="{{$myrowli->ps_issue}}"  size="10%" ><center>
				               </td>

				              <td><center><input type="text" id="{{$display}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$display}}" value="{{$myrowli->display}}"  size="20%" ><center></td>

			              @if($edept == 'Sales')
			              
				              <td>
				              	<select name="{{$dept}}" id="{{$dept}}" width="100" >
			              		 	<option value="ppc" <?php if($myrowli->dept == "ppc") {echo "selected='selected'"; } ?>>PPC</option>
		                      <option value="stores" <?php if($myrowli->dept == "stores") {echo "selected='selected'"; } ?>>Stores</option>
		                      <option value="qa" <?php if($myrowli->dept == "qa") {echo "selected='selected'"; } ?> >QA</option>
		                      <option value="fpi" <?php if($myrowli->dept == "fpi") {echo "selected='selected'"; } ?>>FPI</option>
		                      <option value="mpi" <?php if($myrowli->dept == "mpi") {echo "selected='selected'"; } ?>>MPI</option>
		                      <option value="prodn" <?php if($myrowli->dept == "prodn") {echo "selected='selected'"; } ?> >Prodn</option>
		                      <option value="paint" <?php if($myrowli->dept == "paint") {echo "selected='selected'"; } ?> >Paint</option>
		                    </select>
		                  </td>
		                @else

		                	<td><center><input type="text" name="{{$dept}}"  id="{{$dept}}" value="{{$myrowli->dept}}"  size="5%" style="background-color:#DDDDDD;" readonly="readonly"><center>
		                @endif
		                <input type="hidden" name="{{$recnum}}" id="{{$recnum}}" value="{{$myrowli->recnum}}">
		                </tr>
		              @else

		              		<tr bgcolor="#FFFFFF">
					              <td><center><input type="text" id="{{$linenum}}"  name="{{$linenum}}" value="{{$myrowli->linenum}} "    size="3%"><center></td>
					               <td><center><input type="text" id="{{$op_no}}"  name="{{$op_no}}" value="{{$myrowli->op_num}}" size="10%"><center></td>
					               <td><center><input type="text" id="{{$desc}}"   name="{{$desc}}" value="{{$myrowli->desc}} "  size="40%"><center></td>
					              
					              <td><span class="tabletext"><center><input type="text"  name="{{$spec}}" id="{{$spec}}" value="{{$myrowli->spec}}" size="20%" style="background-color:#DDDDDD;" readonly="readonly"><img src="{{ asset('assets/images/bu-get.gif') }}" onclick="getspec4mrs({{$i}})"></center></center></td>

					              <td><span class="tabletext"><center><input type="text"  name="{{$std_iss}}" id="{{$std_iss}}" value="{{$myrowli->std_iss_ref}}" size="5%" ></center></td>


					              <td><center><input type="text" id="{{$ps_no}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_no}}" value="{{$myrowli->ps_no}}"  size="10%" ><center>
					                <input type="hidden" id="{{$ps_recnum}}"  name="{{$ps_recnum}}" value="{{$myrowli->link2ps}}"  size="20%" >
					               </td>
					              <td><center><input type="text" id="{{$ps_issue}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_issue}}" value="{{$myrowli->ps_issue}}"  size="10%" ><center>
					               </td>

					              

					              <td>
					              	<select id="{{$display}}" name="{{$display}}">
					              		<option value="yes" <?php if($myrowli->display == "yes") {echo "selected='selected'"; } ?>>Yes</option>
					              		<option value="no" <?php if($myrowli->display == "no") {echo "selected='selected'"; } ?>>No</option>
					              	</select>
					              </td>

					              <td>
					              	<select name="{{$dept}}" id="{{$dept}}" width="100" >
				              		 	<option value="ppc" <?php if($myrowli->dept == "ppc") {echo "selected='selected'"; } ?>>PPC</option>
			                      <option value="stores" <?php if($myrowli->dept == "stores") {echo "selected='selected'"; } ?>>Stores</option>
			                      <option value="qa" <?php if($myrowli->dept == "qa") {echo "selected='selected'"; } ?> >QA</option>
			                      <option value="fpi" <?php if($myrowli->dept == "fpi") {echo "selected='selected'"; } ?>>FPI</option>
			                      <option value="mpi" <?php if($myrowli->dept == "mpi") {echo "selected='selected'"; } ?>>MPI</option>
			                      <option value="prodn" <?php if($myrowli->dept == "prodn") {echo "selected='selected'"; } ?> >Prodn</option>
			                      <option value="paint" <?php if($myrowli->dept == "paint") {echo "selected='selected'"; } ?> >Paint</option>
			                    </select>
			                  </td>
			                
			                <input type="hidden" name="{{$recnum}}" id="{{$recnum}}" value="{{$myrowli->recnum}}">
			              </tr>
				      		@endif

				      @else

				      		<tr bgcolor="#FFFFFF">
				              <td><center><input type="text" id="{{$linenum}}"  name="{{$linenum}}" value="{{$myrowli->linenum}} " style="background-color:#DDDDDD;"  readonly="readonly"   size="3%"><center></td>
				               <td><center><input type="text" id="{{$op_no}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$op_no}}" value="{{$myrowli->op_num}}" size="10%"><center></td>
				               <td><center><input type="text" id="{{$desc}}"   name="{{$desc}}" value="{{$myrowli->desc}} "  size="40%"><center></td>

				              
				              <td><span class="tabletext"><center><input type="text"  name="{{$spec}}" id="{{$spec}}" value="{{$myrowli->spec}}" size="20%" style="background-color:#DDDDDD;" readonly="readonly"><img src="{{ asset('assets/images/bu-get.gif') }}" onclick="getspec4mrs({{$i}})"></center></center></td>

				              <td><span class="tabletext"><center><input type="text"  name="{{$std_iss}}" id="{{$std_iss}}" value="{{$myrowli->std_iss_ref}}" size="5%" style="background-color:#DDDDDD;" readonly="readonly"></center></td>


				              <td><center><input type="text" id="{{$ps_no}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_no}}" value="{{$myrowli->ps_no}}"  size="10%" ><center>
				                <input type="hidden" id="{{$ps_recnum}}"  name="{{$ps_recnum}}" value="{{$myrowli->link2ps}}"  size="20%" >
				               </td>
				              <td><center><input type="text" id="{{$ps_issue}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$ps_issue}}" value="{{$myrowli->ps_issue}}"  size="10%" ><center>
				               </td>

				              <td><center><input type="text" id="{{$display}}" style="background-color:#DDDDDD;"  readonly="readonly" name="{{$display}}" value="{{$myrowli->display}}"  size="20%" ><center></td>

				              @if($edept =='Sales')
				              <td>
				              	<select name="{{$dept}}" id="{{$dept}}" width="100" >
			              		 	<option value="ppc" <?php if($myrowli->dept == "ppc") {echo "selected='selected'"; } ?>>PPC</option>
		                      <option value="stores" <?php if($myrowli->dept == "stores") {echo "selected='selected'"; } ?>>Stores</option>
		                      <option value="qa" <?php if($myrowli->dept == "qa") {echo "selected='selected'"; } ?> >QA</option>
		                      <option value="fpi" <?php if($myrowli->dept == "fpi") {echo "selected='selected'"; } ?>>FPI</option>
		                      <option value="mpi" <?php if($myrowli->dept == "mpi") {echo "selected='selected'"; } ?>>MPI</option>
		                      <option value="prodn" <?php if($myrowli->dept == "prodn") {echo "selected='selected'"; } ?> >Prodn</option>
		                      <option value="paint" <?php if($myrowli->dept == "paint") {echo "selected='selected'"; } ?> >Paint</option>
		                    </select>
		                  </td>
		                @else
		                	<td><center><input type="text" name="{{$dept}}"  id="{{$dept}}" value="{{$myrowli->dept}}"  size="5%" style="background-color:#DDDDDD;" readonly="readonly"><center>
		                @endif
		                <input type="hidden" name="{{$recnum}}" id="{{$recnum}}" value="{{$myrowli->recnum}}">
		              </tr>
				      @endif

				    <?php
				    		$i++;
					  	}
					  ?>

					  <input type="hidden" id="index" name="index" value="{{$i}}">
					  <input type="hidden" name= "masterdatarecnum" id= "masterdatarecnum" value="{{$myrow->recnum}}">

			</table>
	</div>

	<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields4Edit()"/>

{!! Form::close() !!}
@stop