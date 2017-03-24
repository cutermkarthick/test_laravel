@extends('newtemp.main')
@section('content')
	<?php 
     $userid = session('user');
     $dept = session('department');
     $userrole = session('userrole');

		 $myrow = $details[0];
		 $today = date('Y-m-d') ;
		
	?>

	{!!  Form::open(['route'=>'submit_editps' , 'class'=>'form']) !!}
  <script type="text/javascript">
    var APP_URL = "{{ json_encode(url('/')) }}";
  </script>
  <script type="text/javascript">
    var tanks= <?php echo json_encode($list_tanks ); ?>;
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });

  </script>
	<script src="{{ asset('assets/scripts/bom.js') }} "></script>
  <script type="text/javascript">
      
        jQuery(document).ready(function($){
          $( "#datepicker" ).datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true,
                    showOtherMonths: true,
                    selectOtherMonths: false,

                  });
    });
  </script>

  <table width=100% border=0 cellspacing="0" cellpadding="0" >
    <tr>
      <td ><span class="welcome"><b>Welcome <?php echo $userid?></b></span></td>
      <td align="right">&nbsp;<a href="{{route('logout')}}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','{{ asset('assets/images/logout_mo.gif') }}',1)"><img name="Image16" border="0" src="{{ asset('assets/images/logout.gif') }}"></a></td>
     </tr>
  </table>
  <br>

	<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="table table-bordered">
		<tr>
			<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b>General Information</b></span></td>
		</tr>
    <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">

    @if(($dept =='Sales' || $dept =='SALES') || ($dept =='ENG' || $dept =='eng'))
        
        @if($myrow->status == 'Active')
        
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*PS #</p></span></td>
            <td  ><input type="text" size=25  name="bomnum" id="bomnum" value="{{ $myrow->bomnum }}" style=";background-color:#DDDDDD;" readonly="readonly"></span></td>

            <td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
            <td><input type="text" name="bomdate" id="bomdate" style="background-color:#DDDDDD;" readonly="readonly"  size=25 value="{{ $myrow->bomdate }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PS Name</p></font></td>
            <td><input type="text" size=35 name="type" value="{{ $myrow->type }}"  style="background-color:#DDDDDD;" readonly></td>
            <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
            <td><input type="text" name="se"   size=25 value="<?php echo $myrow->fname." ".$myrow->lname ?>" style="background-color:#DDDDDD;" readonly></td>      
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Scope</p></font></td>
            <td colspan=3>
              <textarea name="desc" rows="4" cols="40" style="background-color:#DDDDDD;" readonly>{{ $myrow->bomdescr }}</textarea> 
            </td>
          </tr>

          <tr bgcolor="#FFFFFF">   
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="labeltext"><input type="text" id="status" name="status" size="15"  value="{{ $myrow->status }}" style="background-color:#DDDDDD;" readonly>
              <span class="tabletext"><select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
               <option value='Active' <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?> >Active
               <option value='Inactive' <?php if($myrow->status  == "Inactive"){ echo "selected= 'selectd'";} ?>>Inactive
               </select>
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><input type="text" size=25 name="issue" value="{{ $myrow->issue }}" style="background-color:#DDDDDD;" readonly="readonly"></td>        
          </tr>

        @else
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*PS #</p></span></td>
            <td  ><input type="text" size=25  name="bomnum" id="bomnum" value="{{ $myrow->bomnum }}" style=";background-color:#DDDDDD;" ></span></td>

            <td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
            <td><input type="text" name="bomdate" id="datepicker"   size=25 value="{{ $myrow->bomdate }}"></td>
         </tr>

         <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">PS Name</p></font></td>
          <td><input type="text" size=35 name="type" value="{{ $myrow->type }}"  ></td>
          <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
          <td><input type="text" name="se"   size=25 value="<?php echo $myrow->fname." ".$myrow->lname ?>">
          <button type="button" class="btn btn-default" onclick="GetAllEmps1()">Get Employee</button>
          </td>      
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Scope</p></font></td>
          <td colspan=3>
            <textarea name="desc" rows="4" cols="40" >{{ $myrow->bomdescr }}</textarea> 
          </td>
        </tr>

        <tr bgcolor="#FFFFFF">   
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td><span class="labeltext"><input type="text" id="status" name="status" size="15"  value="{{ $myrow->status }}">
            <span class="tabletext"><select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
             <option value='Active' <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?> >Active
             <option value='Inactive' <?php if($myrow->status  == "Inactive"){ echo "selected= 'selectd'";} ?>>Inactive
             <option value='Pending' <?php if($myrow->status  == "Pending"){ echo "selected= 'selectd'";} ?>>Pending
             <option value='Cancelled' <?php if($myrow->status  == "Cancelled"){ echo "selected= 'selectd'";} ?>>Cancelled
             </select>
          <td><span class="labeltext"><p align="left">Issue</p></font></td>
          <td><input type="text" size=25 name="issue" value="{{ $myrow->issue }}"  ></td>        
        </tr>

        @endif

    @else

        @if($myrow->status == 'Active')
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*PS #</p></span></td>
            <td  ><input type="text" size=25  name="bomnum" id="bomnum" value="{{ $myrow->bomnum }}" style=";background-color:#DDDDDD;" ></span></td>

            <td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
            <td><input type="text" name="bomdate" id="bomdate" style="background-color:#DDDDDD;"  size=25 value="{{ $myrow->bomdate }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PS Name</p></font></td>
            <td><input type="text" size=35 name="type" value="{{ $myrow->type }}"  style="background-color:#DDDDDD;" readonly></td>
            <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
            <td><input type="text" name="se"   size=25 value="<?php echo $myrow->fname." ".$myrow->lname ?>" style="background-color:#DDDDDD;" readonly></td>      
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Scope</p></font></td>
            <td colspan=3>
              <textarea name="desc" rows="4" cols="40" style="background-color:#DDDDDD;" readonly>{{ $myrow->bomdescr }}</textarea> 
            </td>
          </tr>

          <tr bgcolor="#FFFFFF">   
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="labeltext"><input type="text" id="status" name="status" size="15"  value="{{ $myrow->status }}" style="background-color:#DDDDDD;" readonly>
              <span class="tabletext"><select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
               <option value='Active' <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?> >Active
               <option value='Inactive' <?php if($myrow->status  == "Inactive"){ echo "selected= 'selectd'";} ?>>Inactive
               </select>
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><input type="text" size=25 name="issue" value="{{ $myrow->issue }}" style="background-color:#DDDDDD;" ></td>        
          </tr>

        @else
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*PS #</p></span></td>
            <td  ><input type="text" size=25  name="bomnum" id="bomnum" value="{{ $myrow->bomnum }}" style=";background-color:#DDDDDD;" ></span></td>

            <td><span class="labeltext"><p align="left">*PS Date</p></font></span></td>
            <td><input type="text" name="bomdate" id="bomdate" style="background-color:#DDDDDD;"  size=25 value="{{ $myrow->bomdate }}"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PS Name</p></font></td>
            <td><input type="text" size=35 name="type" value="{{ $myrow->type }}"  style="background-color:#DDDDDD;" readonly></td>
            <td><span class="labeltext"><p align="left">Responsibility</p></font></td>
            <td><input type="text" name="se"   size=25 value="<?php echo $myrow->fname." ".$myrow->lname ?>" style="background-color:#DDDDDD;" readonly></td>      
          </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Scope</p></font></td>
          <td colspan=3>
            <textarea name="desc" rows="4" cols="40" style="background-color:#DDDDDD;" readonly>{{ $myrow->bomdescr }}</textarea> 
          </td>
        </tr>

        <tr bgcolor="#FFFFFF">   
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td><span class="labeltext"><input type="text" id="status" name="status" size="15"  value="{{ $myrow->status }}"  readonly="readonly">
            <span class="tabletext"><select name="statusval" size="1" width="100" onchange="onSelectStatus()" >
             <option value='Active' <?php if($myrow->status == "Active"){ echo "selected= 'selectd'"; } ?> >Active
             <option value='Inactive' <?php if($myrow->status  == "Inactive"){ echo "selected= 'selectd'";} ?>>Inactive
             <option value='Pending' <?php if($myrow->status  == "Pending"){ echo "selected= 'selectd'";} ?>>Pending
             <option value='Cancelled' <?php if($myrow->status  == "Cancelled"){ echo "selected= 'selectd'";} ?>>Cancelled
             </select>
          <td><span class="labeltext"><p align="left">Issue</p></font></td>
          <td><input type="text" size=25 name="issue" value="{{ $myrow->issue }}" style="background-color:#DDDDDD;" ></td>        
        </tr>

      @endif

    @endif


			<tr bgcolor="#DDDEDD">
				<td colspan=10><span class="heading"><center><b>PS Notes for Process Sheet</b></center></td>
			</tr>
			<tr >
				<td colspan=10>
					<textarea  rows="6" cols="81" style="background-color:#DDDDDD;" readonly="readonly" disabled>
						@foreach ($linotes as $myrow4notes)
							<?php 
								printf("\n");
                printf("********Added by $myrow4notes->userid on $myrow4notes->create_date*******");
                printf("\n");
                printf($myrow4notes->psnotes);
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
              <td ><input type="text" name="app_date"  id="app_date" size=20  readonly="readonly" value="{{ $myrow->app_date }}">
              <input type="hidden" name="tod_date" id="tod_date"  value="{{$today}}">
              </td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
               <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="{{ $myrow->qa_approved }}" onclick="return false">
                <input type="hidden" name="qa_approved_by" id="qa_approved_by" value="{{ $myrow->qa_approved_by }}">
                </td>
                <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
                <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="{{ $myrow->qa_app_date }}">
                <input type="hidden" name="tod_date1" id="tod_date1"  value="{{$today}}">
                </td>
          </tr>

        @else

          <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Approved By</p></font></td>
               <td ><input type="checkbox" name="approved" id="approved" <?php if ($myrow->approved == 'yes') echo "checked='checked'"; ?> value="{{$myrow->approved}}" onclick="javascript:setappval()">
                <input type="hidden" name="approved_by" id="approved_by" value="{{$myrow->approved_by}} ">
                </td>
                <td><span class="labeltext"><p align="left">Approved Date</p></font></td>
                <td ><input type="text" name="app_date"  id="app_date" size=20  readonly="readonly" value="{{ $myrow->app_date }}">
                <input type="hidden" name="tod_date" id="tod_date"  value="{{$today}}">
                </td>
          </tr>

          <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
               <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="{{ $myrow->qa_approved }}" onclick="javascript:setqaappval()">
                <input type="hidden" name="qa_approved_by" id="qa_approved_by" value="{{ $myrow->qa_approved_by }}">
                </td>
                <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
                <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="{{ $myrow->qa_app_date }}">
                <input type="hidden" name="tod_date1" id="tod_date1"  value="{{$today}}">
                </td>
          </tr>

        @endif

      @elseif($dept =='QAS' || $dept =='QAS')

          <input type="hidden" id="approved" name="approved" value="{{$myrow->approved}}">
          <input type="hidden" id="approved_by" name="approved_by" value="{{$myrow->approved_by}}">
          <input type="hidden" id="app_date" name="app_date" value="{{ $myrow->app_date }}">
          <input type="hidden" id="tod_date" name="tod_date" value="{{$today}}">
          @if($myrow->status == 'Active')

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
                 <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="{{ $myrow->qa_approved }}" onclick="return false">
                  <input type="hidden" name="qa_approved_by" id="qa_approved_by" value="{{ $myrow->qa_approved_by }}">
                  </td>
                  <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
                  <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="{{ $myrow->qa_app_date }}">
                  <input type="hidden" name="tod_date1" id="tod_date1"  value="{{$today}}">
                  </td>
            </tr>

          @else

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">QA Approved By</p></font></td>
              <td ><input type="checkbox" name="qa_approved" id="qa_approved" <?php if ($myrow->qa_approved == 'yes') echo "checked='checked'"; ?> value="{{ $myrow->qa_approved }}" onclick="javascript:setqaappval()">
                <input type="hidden" name="qa_approved_by" id="qa_approved_by" value="{{ $myrow->qa_approved_by }}">
                </td>
              <td><span class="labeltext"><p align="left">QA Approved Date</p></font></td>
              <td ><input type="text" name="qa_app_date"  id="qa_app_date" size=20  readonly="readonly" value="{{ $myrow->qa_app_date }}">
                <input type="hidden" name="tod_date1" id="tod_date1"  value="{{$today}}">
              </td>
            </tr>

          @endif

      @else

          <input type="hidden" id="approved" name="approved" value="{{$myrow->approved}}">
          <input type="hidden" id="approved_by" name="approved_by" value="{{$myrow->approved_by}}">
          <input type="hidden" id="app_date" name="app_date" value="{{ $myrow->app_date }}">
          <input type="hidden" id="tod_date" name="tod_date" value="{{$today}}">

          <input type="hidden" id="approved" name="approved" value="{{$myrow->qa_approved}}">
          <input type="hidden" id="approved_by" name="approved_by" value="{{$myrow->qa_approved_by}}">
          <input type="hidden" id="app_date" name="app_date" value="{{ $myrow->qa_app_date }}">
          <input type="hidden" id="tod_date" name="tod_date" value="{{$today}}">


      @endif

    
      <tr>
      	<td bgcolor="#EEEFEE"  colspan=5 align="center"><span class="heading"><b> Process LINE ITEMS</b></span></td>
      </tr>

      @if($userrole == 'AE' || $userid == 'eng')

        @if($myrow->status != 'Active')
          <tr bgcolor="#FFFFFF">
            <td><a href="javascript:addRow4edit('myTable',document.forms[0].index.value)" ><button type="button" class="btn btn-default" >AddRow</button></a>
            <td colspan=4><span class="tabletext">To delete line items - blankout line number</span></td></td>
          </tr>
        @endif
          
      @endif

      @if($userrole == 'SU')

        @if($myrow->status != 'Active')
          <tr bgcolor="#FFFFFF">
            <td><a href="javascript:addRow4edit('myTable',document.forms[0].index.value)" ><button type="button" class="btn btn-default" >AddRow</button></a>
            <td colspan=4><span class="tabletext">To delete line items - blankout line number</span></td></td>
          </tr>
        @endif
          
      @endif

      
    	<input type="hidden" name="quoterecnum" id="quoterecnum" value="{{$myrow->link2quote}}">
  		<input type="hidden" name= "serecnum" value="{{$myrow->bom2seowner}}">
  		<input type="hidden" name= "bomrecnum" value="{{$myrow->recnum}}">

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

				foreach($lidetails as $myrowli){
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
            else
            {
              $recnum = "";
              $tanknum = $myrowli->tank_num;
            }

			?>

      @if($userrole == 'SU' || $userrole == 'AE' || $userid == "eng")
        
          @if($myrow->status == "Active")

              <tr>
                <td ><span class="tabletext"><input type="text" id="{{ $linenumber }}"  name="{{ $linenumber }}"  value="{{ $myrowli->line_num }}" size="2%" style="background-color:#DDDDDD;"  readonly="readonly"></td>
                <td><input type="text" name="{{$itemdesc}}"  id="{{$itemdesc}}" size="40%" value="{{$myrowli->item_desc}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

                <td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="{{$myrowli->item_value}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>
                <td>

                <td><input type="text" name="{{$ps_tanknum}}" id="{{$ps_tanknum}}" size="10%" value="{{$myrowli->tank_num}}" style="background-color:#DDDDDD;"  readonly="readonly" ></td>

                <td><input type="text" name="{{$itemname}}" id="{{$itemname}}" size="15%" value="{{$myrowli->item_name}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

                <td><input type="text" name="{{$optemp_min}}" id="{{$optemp_min}}" size="4%" value="{{$myrowli->optemp_min}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

                <td><input type="text" name="{{$optemp_max}}" id="{{$optemp_max}}" size="4%" value="{{$myrowli->optemp_max}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

                <td><input type="text" name="{{$qty_check}}" id="{{$qty_check}}" size="4%" value="{{$myrowli->qty_check}}" style="background-color:#DDDDDD;"  readonly="readonly" >

                <td><input type="text" name="{{$paint_check}}" id="{{$paint_check}}" size="4%" value="{{$myrowli->paint_check}}" style="background-color:#DDDDDD;"  readonly="readonly" >

                <td><input type="text" name="{{$time_check}}" id="{{$time_check}}" size="4%" value="{{$myrowli->time_check}}" style="background-color:#DDDDDD;"  readonly="readonly" >
                
                <td><input type="text" name="{{$form2}}" id="{{$form2}}" size="4%" value="{{$myrowli->form2}}" style="background-color:#DDDDDD;"  readonly="readonly" >

                <td><input type="text" name="{{$workcenter}}" id="{{$workcenter}}" size="35%" value="{{$myrowli->workcenter}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

                <td><input type="text" name="{{$comments}}" id="{{$comments}}" size="40%" value="{{$myrowli->comments}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>


                <input type="hidden" name="{{$vendrecnum}}" id="{{$vendrecnum}}" value="{{$myrowli->link2vendor}}">
                <input type="hidden" name="{{$partrecnum}}" id="{{$partrecnum}}" value="{{$myrowli->link2parts}}">
                <input type="hidden" name="{{$prevlinenumber}}" id="{{$prevlinenumber}}" value="{{$myrowli->line_num}}">
                <input type="hidden" name="{{$lirecnum}}" id="{{$lirecnum}}" value="{{$myrowli->recnum}}">
              </tr>

          @else

              <tr>
                <td ><span class="tabletext"><input type="text" id="{{ $linenumber }}"  name="{{ $linenumber }}"  value="{{ $myrowli->line_num }}" size="2%" ></td>
                <td><input type="text" name="{{$itemdesc}}"  id="{{$itemdesc}}" size="40%" value="{{$myrowli->item_desc}}" ></td>

                <td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="{{$myrowli->item_value}}"></td>
                <td>
                  <select name="{{$ps_tanknum}}" id="{{$ps_tanknum}}" >
                    <option value={{$recnum}}  <?php if($recnum == "0"){ echo "selected='selected'";} ?> >{{ $tanknum }} </option>
                    @foreach ($list_tanks as $li_tank)
                      <option value='{{$li_tank->recnum}}' <?php if($li_tank->tank_num == $myrowli->tank_num){ echo "selected= 'selectd'"; } ?> >{{$li_tank->tank_num}}
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
              </tr>

          @endif

      @else

          <td ><span class="tabletext"><input type="text" id="{{ $linenumber }}"  name="{{ $linenumber }}"  value="{{ $myrowli->line_num }}" size="2%" style="background-color:#DDDDDD;"  readonly="readonly"></td>

          <td><input type="text" name="{{$itemdesc}}"  id="{{$itemdesc}}" size="40%" value="{{$myrowli->item_desc}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

          <td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="{{$myrowli->item_value}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>
          <td>

          <td><input type="text" name="{{$value}}" id="{{$value}}" size="15%" value="{{$myrowli->item_value}}"></td>
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

          <td><input type="text" name="{{$workcenter}}" id="{{$workcenter}}" size="35%" value="{{$myrowli->workcenter}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

          <td><input type="text" name="{{$comments}}" id="{{$comments}}" size="40%" value="{{$myrowli->comments}}" style="background-color:#DDDDDD;"  readonly="readonly"></td>

          <input type="hidden" name="{{$vendrecnum}}" id="{{$vendrecnum}}" value="{{$myrowli->link2vendor}}">
          <input type="hidden" name="{{$partrecnum}}" id="{{$partrecnum}}" value="{{$myrowli->link2parts}}">
          <input type="hidden" name="{{$prevlinenumber}}" id="{{$prevlinenumber}}" value="{{$myrowli->line_num}}">
          <input type="hidden" name="{{$lirecnum}}" id="{{$lirecnum}}" value="{{$myrowli->recnum}}">

      @endif 

		<?php 
			$i++;
			} 
		?>

    <input type="hidden" name="prevstatus" id="prevstatus" value ="{{$myrow->status}}">
    <input type="hidden" name="userid" id="userid" value ="{{$userid}}">
    <input type="hidden" name="index" id="index" value="{{$i}}">
		<input type="hidden" name="curindex" id="curindex" value="{{$i}}">
	</table>

	<input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields4Edit()"/>

	{!! Form::close() !!}
@stop