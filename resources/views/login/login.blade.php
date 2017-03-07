@extends('login.temp')
@section('content')
	<table cellspacing="0" cellpadding="6" border="0" width=100%>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="2" border="0" width=100%>
					<tr>
		        <td><span class="welcome"><b><font color="black" >Welcome to ATPL ERP</font></b></span></td>
		    	</tr>
		    	<tr><td>&nbsp;</td></tr>
		    	<tr>
		    		<td>
		    			{!!  Form::open(['route'=>'checkuser' , 'class'=>'form']) !!}
		    			<table border=0  bgcolor="#E2E2E2" cellpadding="6" cellspacing="1" align="center" width="300">
		    				<tr>
    							<td bgcolor="DEDEDE" align=left colspan="2"><span class="heading"><b><font color="black" >Login</font></b></span></td>
    						</tr>

    						<tr bgcolor="#FFFFFF">
    							<td><span class="tabletext">User Name: </span></td>
    							<td><input type="text" name="userid" maxlength="32"></td>
    						</tr>

    						<tr bgcolor="#FFFFFF">
    						 	<td><span class="tabletext">Password: </span></td>
    						 	<td><input type="password" name="password" maxlength="32"></td>
    						</tr>

    						<tr bgcolor="#FFFFFF">
    							<td><span class="tabletext">Site ID: </span></td>
    							<td><input type="text" name="siteid" maxlength="32"></td>
    						</tr>

    						<tr bgcolor="#FFFFFF">
    							<td>&nbsp;</td>
    							<td ><span class="tabletext"><input type="submit" size="60" value="Submit" onclick="javascript: return check_req_fields()"/></span>
    							</td>
    						</tr>

    						<tr bgcolor="#F5F6F5">
    							<td colspan=2>
								    @if (Session::has('validate'))
								      <span class="tabletext"><font color="red" >{!! Session::get('validate') !!}</font>
								    @endif
									</td>
								</tr>

		    			</table>
		    			{!! Form::close() !!}

		    		</td>
		    	</tr>
				</table>
			</td>
		</tr>
	</table>
@stop
