@extends('layouts.app')
@section('content')
<script>

$('#confirmDelete').on('show.bs.modal', function (e) {
      $message = $(e.relatedTarget).attr('data-message');
      $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);

      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
  });

  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
      $(this).data('form').submit();
  });
</script>
<style type="text/css">
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color:#d4d4d4;
          }  
        .modal-dialog {
            //width: 100%;
            //height: 100%;
            //padding: 0;
            //margin: 0;
            //display: inline-block;
            //text-align: left;
            //vertical-align: middle;
        }
        .modal-content {
            //height: 90%;
            //min-height: 90%;
            //height: auto;
            //border-radius: 0;
        }
    </style>


        
        <div class=" container" >
            <div class="row">
                <div class="col-md-7">
                    <div class = "dropdown">
   
                        <button type = "button" class = "btn dropdown-toggle" id = "dropdownMenu1" data-toggle = "dropdown">
                           View Report
                           <span class = "caret"></span>
                        </button>
                        <ul class = "dropdown-menu" role = "menu" aria-labelledby = "dropdownMenu1">
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student')}}">Today</a>
                            </li>

                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student?load=yesterday')}}">Yesterday</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student?load=last7day')}}">Last 7 Days</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student?load=last30day')}}">Last 30 Days</a>
                            </li>

                            <li role = "presentation" class = "divider"></li>

                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student')}}">Only Mine</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/student?load=viewalldata')}}">View All Data</a>
                            </li>
                         </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Insert New Student</button>
                    <a  href="{{url('/visitor-export-excel')}}" target="_blank" class="btn btn-success">Export to Excel</a>
                    <a  href="{{url('/visitor-export-pdf')}}" target="_blank" class="btn btn-success">Export to PDF</a>
                </div>
            </div>
            <div class="row">
                <h4>Student Information - {{$report_title}}</h4>
            </div>
            <div class="row">
               <table class="table table-hover" >
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Program</th>
                                    <th>Semester</th>
                                    <th>DealtBy</th>
                                    <th>Status</th>
                                    <th>Edit / Delete</th>
                                </tr>
                            <?php foreach ($students as $student){?>
                                <tr id="show">
                                    <td> <?php echo $student->id;?></td>
                                    <td><?php echo date("M d Y",  strtotime($student->created_at));?></td>
                                    <td> <?php echo $student->first_name." ".$student->last_name; ?></td>
                                    <td> <?php echo $student->mobile;  ?></td>
                                    <td><?php echo $student->program; ?></td>
                                    <td><?php echo $student->semester; ?></td>
                                    <td><?php echo $student->dealt_by; ?></td>
                                    <td><?php echo $student->admission_status; ?></td>
                                    <td><button class="btn btn-danger btn-sm glyphicon glyphicon-refresh"> Edit </button> &nbsp;&nbsp;<form method="POST" action="http://example.com/admin/user/delete/12" accept-charset="UTF-8" style="display:inline">
                                        <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
                                            <i class="glyphicon glyphicon-trash"></i> Delete
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                     </table>
            
            </div>
                    
        </div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#search_button").click(function(){
            var id =$("#search_text").val();
            $.getJSON( "visitor_in_json?id="+id, function( json ) {
                $("#visitor_id").val(json.id);
                $("#first_name").val(json.first_name);
                $("#last_name").val(json.last_name);
                $("#mobile").val(json.mobile);
                $("#program").val(json.program).change();
                //$.each( json, function( key, val ) {
                    //console.log( "JSON Data: " + json.id + " val "+ val );
                    
                  //});
                
           });
        });
    });
    
</script>
<div class="modal fade" id="myModal" role="dialog" style=" margin: 0px;">
    <div class="modal-dialog" style="width: 90%;height: 90%;display: inline-block;text-align: center;vertical-align: middle;">
              <!-- Modal content-->
              <div class="modal-content" style="height: 90%;min-height: 90%;height: auto;border-radius: 0;">
                  <div class="modal-header" style=" background-color: #ac2925; color: white; font-size: 23px;">
                      <button type="button" class="close" data-dismiss="modal"><span class=" glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title">Insert Student Record</h4>
                </div>
                  <div style="width:900px;">
                      {!! Form::Open(array ('url' => '/add_student','class'=>'form-horizontal')) !!}
                      <div class="row">
                      <div id="tabs">
                        <ul>
                          <li><a href="#tabs-1">Personal Information</a></li>
                          <li><a href="#tabs-2">Education</a></li>
                          <li><a href="#tabs-3">Languages,Honor & Awards</a></li>
                          <li><a href="#tabs-4">Applicant & Sponsor</a></li>
                          <li><a href="#tabs-5">Official Use Only</a></li>
                        </ul>
                        <div id="tabs-1">
                         <table class="table"  >
                          <tr>
                              <td >
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Visitor ID')}}
                                    </label>

                                   <div class = "col-md-5">
                                       {{ Form::text('search_text',null,array('id'=>'search_text','class' => 'form-control input-sm','placeholder'=>'Visitor ID'))}}
                                       <input type="hidden" name="visitor_id" value="" id="visitor_id">
                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "col-md-7">
                                       <button type = "button" class = "btn btn-default" name="search_button" id="search_button">Load Visitor ID</button> 
                                   </div>
                              </td>
                              
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','First Name:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('first_name',null,array('id'=>'first_name','class' => 'form-control input-sm','placeholder'=>'Enter First Name'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Last Name:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('last_name',null,array('id'=>'last_name','class' => 'form-control input-sm','placeholder'=>'Enter Last Name'))}}
                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Program:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       <select name="program" id="program" class="form-control input-sm">
                                           <option value="">Select One</option>
                                           <option value="BS Civil">BS Civil</option>
                                           <option value="MSC Math">MSC Math</option>
                                           <option value="MBA 1.5">MBA 1.5</option>
                                           <option value="MSCS">MSCS</option>
                                           <option value="M.Phil Edu">M.Phil Edu</option>
                                           <option value="MSBA">MSBA</option>
                                           <option value="M.phil Math">M.phil Math</option>
                                           <option value="M.Phil Pak-Study">M.Phil Pak-Study</option>
                                           <option value="MSC Math">MSC Math</option>
                                       </select>
                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Semester:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        <div class = "radio">
                                        <label>
                                           <input type = "radio" name = "semester" id = "semester" value = "fall" checked> Fall
                                        </label>
                                        <label>
                                           <input type = "radio" name = "semester" id = "semester" value = "spring">
                                           Spring
                                        </label>
                                     </div>

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Father/Gaurd. Name:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('father_name',null,array('id'=>'father_name','class' => 'form-control input-sm','placeholder'=>'Father/Gaurd. Name'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Contact:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('mobile',null,array('id'=>'mobile','class' => 'form-control input-sm','placeholder'=>'Contact'))}}

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2" style="text-align:left;">
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-2 control-label">
                                         {{ Form::label('title','Address:')}}
                                    </label>

                                   <div class = "col-md-10">
                                       {{ Form::textarea('address',null,array('id'=>'address','class' => 'form-control input-sm','placeholder'=>'Address','rows'=>'3'))}}

                                   </div>
                                </div>
                              </td>
                              
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Occup. Fath./Gaurd.:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('father_occupation',null,array('id'=>'father_occupation','class' => 'form-control input-sm','placeholder'=>'Occupation of Father/Gaurdian'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Email:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('email',null,array('id'=>'email','class' => 'form-control input-sm','placeholder'=>'Email'))}}

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Gender:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       <div class = "radio">
                                        <label>
                                           <input type = "radio" name = "gender" id = "gender" value = "male" checked> Male
                                        </label>
                                        <label>
                                           <input type = "radio" name = "gender" id = "gender" value = "female">
                                           Female
                                        </label>
                                        </div>
                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Marital Status:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        <div class = "radio">
                                        <label>
                                           <input type = "radio" name = "marital_status" id = "marital_status" value = "maried" checked> Married
                                        </label>
                                        <label>
                                           <input type = "radio" name = "marital_status" id = "marital_status" value = "unmaried">
                                           Unmaried
                                        </label>
                                        </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Date of Birth:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('date_of_birth',null,array('id'=>'date_of_birth','class' => 'form-control input-sm','placeholder'=>'Date of Birth'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Country of Citizenship:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('country_of_citizenship',null,array('id'=>'country_of_citizenship','class' => 'form-control input-sm','placeholder'=>'Country of Citizenship'))}}

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','CNIC:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('cnic',null,array('id'=>'cnic','class' => 'form-control input-sm','placeholder'=>'CNIC'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Phone:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('phone',null,array('id'=>'phone','class' => 'form-control input-sm','placeholder'=>'Phone'))}}

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2" style="text-align:left;">
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-2 control-label">
                                         {{ Form::label('title','Postal Address:')}}
                                    </label>

                                   <div class = "col-md-10">
                                       {{ Form::textarea('postal_address',null,array('id'=>'postal_address','class' => 'form-control input-sm','placeholder'=>'Postal Address','rows'=>'3'))}}

                                   </div>
                                </div>
                              </td>
                              
                          </tr>
                      </table>
                      
                        </div>
                        <div id="tabs-2">
                          
                            <table width="100%" class=" table-bordered table-condensed" style="font-size:10px; font-weight: bold;">
                                      <caption><span style="font-size:12px;">Educational Background</span></caption>
                                      <tr>
                                          <th>
                                             Name of Institution 
                                          </th>
                                          <th>Location</th>
                                          <th>Date of Entering</th>
                                          <th>Date of Leaving</th>
                                          <th>
                                              Certificate. Diploma<br>or Degree Received
                                          </th>
                                          <th>
                                              Grade or Division Secured
                                          </th>
                                          
                                      </tr>
                                      <tr>
                                        <td>
                                            <div class = " col-md-12">
                                                <input name="name_of_institution[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="location[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="date_of_entering[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="certificate_or_diploma[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                                <input name="grade_or_division[]" class = "form-control input-sm" type = "text" placeholder = "" >
                                           </div>
                                        </td>
                                      </tr>
                                       <tr>
                                        <td>
                                            <div class = " col-md-12">
                                                <input name="name_of_institution[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="location[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="date_of_entering[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="certificate_or_diploma[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                                <input name="grade_or_division[]" class = "form-control input-sm" type = "text" placeholder = "" >
                                           </div>
                                        </td>
                                      </tr>
                                       <tr>
                                        <td>
                                            <div class = " col-md-12">
                                                <input name="name_of_institution[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="location[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="date_of_entering[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="certificate_or_diploma[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                                <input name="grade_or_division[]" class = "form-control input-sm" type = "text" placeholder = "" >
                                           </div>
                                        </td>
                                      </tr>
                                       <tr>
                                        <td>
                                            <div class = " col-md-12">
                                                <input name="name_of_institution[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="location[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="date_of_entering[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="certificate_or_diploma[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                                <input name="grade_or_division[]" class = "form-control input-sm" type = "text" placeholder = "" >
                                           </div>
                                        </td>
                                      </tr>
                                       <tr>
                                        <td>
                                            <div class = " col-md-12">
                                                <input name="name_of_institution[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="location[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="date_of_entering[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                              <input name="certificate_or_diploma[]" class = "form-control input-sm" type = "text" placeholder = "">
                                           </div>
                                        </td>
                                        <td>
                                            <div class = "col-md-12">
                                                <input name="grade_or_division[]" class = "form-control input-sm" type = "text" placeholder = "" >
                                           </div>
                                        </td>
                                      </tr>
                                      
                                </table>
                            <div class="row">
                                <table style="width:100%;">
                                    <tr>
                                        <td  class="col-md-12">
                                           <div class = "form-group">
                                               <label for = "firstname" class = "col-md-11 control-label" style="text-align:left;">
                                                   {{ Form::label('title','If you are presently a candidate for any title, degree or diploma, name it')}}
                                              </label>


                                          </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="col-md-12">
                                            <div class = "form-group">
                                              <div class = "col-md-11">
                                                  {{ Form::text('candidate_for_any_degree_title',null,array('id'=>'candidate_for_any_degree_title','class' => 'form-control input-sm','placeholder'=>''))}}

                                              </div>
                                           </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td  class="col-md-12">
                                        <table style="width:100%" class="table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2">College or University Majors(s):</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">Major in Undergraduate Studies:</td>
                                                <td class="col-md-6">Major in Graduate Studies:</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">
                                                     <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 1">
                                                </td>
                                                <td class="col-md-6">
                                                    <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">
                                                     <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 2">
                                                </td>
                                                <td class="col-md-6">
                                                    <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">
                                                     <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 3">
                                                </td>
                                                <td class="col-md-6">
                                                    <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-6">
                                                     <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 4">
                                                </td>
                                                <td class="col-md-6">
                                                    <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Subject 4">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                </table>  
                            </div>
                              
                        </div>
                        <div id="tabs-3">
                            <table style="width:100%;">
                             <tr>
                              <td colspan="2">
                                 <div class = "form-group">
                                     <label for = "firstname" class = "col-md-4 control-label" style="text-align:left;">
                                         {{ Form::label('title','Years of English Medium Schooling:')}}
                                    </label>
                                    <div class = "col-md-8">
                                        {{ Form::text('years_of_english_medium',null,array('id'=>'years_of_english_medium','class' => 'form-control input-sm','placeholder'=>''))}}

                                    </div>
                                   
                                </div>
                              </td>
                            </tr>
                            
                             <tr>
                              <td class="col-md-12" colspan="2">
                                  <div class="col-md-2">
                                      {{ Form::label('title','First Language:')}}
                                  </div>
                                  <div class="col-md-2">
                                      Urdu&nbsp;<input type="radio" name="first_language" value="urdu" checked>
                                  </div>
                                  <div class="col-md-2">
                                      English&nbsp;<input type="radio" name="first_language" value="urdu">
                                  </div>
                                  <div class="col-md-2">
                                      Punjabi&nbsp;<input type="radio" name="first_language" value="urdu">
                                  </div>
                                  <div class="col-md-2">
                                      Saraiki&nbsp;<input type="radio" name="first_language" value="urdu">
                                  </div>
                                  <div class="col-md-2">
                                      Other&nbsp;<input type="radio" name="first_language" value="urdu">
                                  </div>
                              </td>
                          </tr>
                          
                          
                          <tr>
                              <td colspan="2" class="col-md-12">
                                  <table style="width:100%" class="table-bordered table-condensed">
                                      <tr>
                                          <td colspan="5">(Rate yourself E-Excellent, G-Good, F-Fair, P-Poor)</td>
                                      </tr>
                                      <tr>
                                          <td class="col-md-4">Language</td>
                                          <td class="col-md-2">Reading</td>
                                          <td class="col-md-2">Writing</td>
                                          <td class="col-md-2">Speaking</td>
                                          <td class="col-md-2">Listening</td>
                                      </tr>
                                      <tr>
                                          <td class="col-md-4">
                                               <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Language 1">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="col-md-4">
                                               <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Language 2">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="col-md-4">
                                               <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "Language 3">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                          <td class="col-md-2">
                                              <input name="name_of_leaving[]" class = "form-control input-sm" type = "text" placeholder = "">
                                          </td>
                                      </tr>
                                      
                                  </table>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2" style="text-align:left; padding-top: 10px;">
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-3 control-label">
                                         {{ Form::label('title','Honors and Awards if any:')}}
                                    </label>

                                   <div class = "col-md-9">
                                       {{ Form::textarea('honors_awards',null,array('id'=>'honors_awards','class' => 'form-control input-sm','placeholder'=>'Honors and Awards','rows'=>'3'))}}

                                   </div>
                                </div>
                              </td>
                            </tr>
                           <tr>
                              <td colspan="2" style="text-align:left;">
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-3 control-label">
                                         {{ Form::label('title','Favourite Activities:')}}
                                    </label>

                                   <div class = "col-md-9">
                                       {{ Form::textarea('fav_activities',null,array('id'=>'fav_activities','class' => 'form-control input-sm','placeholder'=>'Favourite Activities','rows'=>'3'))}}

                                   </div>
                                </div>
                              </td>
                            </tr>
                            </table>
                        </div>
                        <div id="tabs-4">
                            <table style="width:100%;">
                          
                          
                          
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Name of Applicant:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('applicant_name',null,array('id'=>'applicant_name','class' => 'form-control input-sm','placeholder'=>'Name of Applicant'))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Privately Supported Student:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('privately_supported_student',null,array('id'=>'privately_supported_student','class' => 'form-control input-sm','placeholder'=>'Privately Supported Student'))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Name of Sponsor:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('sponsor_name',null,array('id'=>'sponsor_name','class' => 'form-control input-sm','placeholder'=>'Name of Sponsor'))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Relationship to Sponsored Student:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('sponsor_relation',null,array('id'=>'sponsor_relation','class' => 'form-control input-sm','placeholder'=>'Relationship to Sponsored Student'))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Signature of Sponsor:')}}
                                    </label>

                                      <div class = "col-md-2" style="border-bottom:1px #000 solid; ">&nbsp;</div>
                                      <div class = "col-md-1 control-label">Dated</div>
                                      <div class = "col-md-2">{{ Form::text('sponsor_sign_date',null,array('id'=>'sponsor_sign_date','class' => 'form-control input-sm','placeholder'=>''))}}</div>
                                      <div class = "col-md-1 control-label">Day of</div>
                                      <div class = "col-md-1" style="border-bottom:1px #000 solid; ">&nbsp;</div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p>
                                        I certify that the information provided
                                    </p>
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-10 control-label">
                                         {{ Form::label('title','Signature of Application:')}}
                                    </label>
                                    <div class = "col-md-2" style="border-bottom:1px #000 solid; ">&nbsp;</div>
                                 </div>
                              </td> 
                            </tr>
                            
                          
                      </table> 
                        </div>
                      
                      <div id="tabs-5">
                            <table style="width:100%;">
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Admission Status:')}}
                                    </label>

                                    <div class = "col-md-2">
                                        <input type="radio"  name="admission_status" value="accepted" checked>&nbsp;Accepted

                                    </div>
                                      <div class="col-md-2">
                                          <input type="radio"  name="admission_status" value="rejected">&nbsp;Rejected
                                      </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Dated:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('admission_date',null,array('id'=>'admission_date','class' => 'form-control input-sm','placeholder'=>''))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Interviewd by:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('interviewed_by',null,array('id'=>'interviewed_by','class' => 'form-control input-sm','placeholder'=>''))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Chairman Admission Committee:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('chairman_admission_committee',null,array('id'=>'chairman_admission_committee','class' => 'form-control input-sm','placeholder'=>''))}}

                                    </div>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Fee Code:')}}
                                    </label>

                                      <div class = "col-md-2" >{{ Form::text('fee_code',null,array('id'=>'fee_code','class' => 'form-control input-sm','placeholder'=>''))}}</div>
                                      <div class = "col-md-1 control-label">Signature:&nbsp;</div>
                                      <div class = "col-md-1" style="border-bottom:1px #000 solid; margin-left: 5px; ">&nbsp;</div>
                                      <div class = "col-md-1 control-label">Dated:</div>
                                      <div class = "col-md-2" >{{ Form::text('fee_code_date',null,array('id'=>'fee_code_date','class' => 'form-control input-sm','placeholder'=>''))}}</div>
                                 </div>
                              </td>
                            </tr>
                          
                      </table> 
                        </div>
                      <!-- end of tabs -->
                      </div>
                      </div>
                        <div class="row">
                            <div class = "col-md-offset-5 col-md-5">
                                {{ Form::submit('Save Student',array('class' => 'btn btn-circle btn-primary')) }}
                            </div>
                        </div>
                      
                    {!! Form::Close()!!}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
        </div>
        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
             <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Delete Parmanently</h4>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure about this ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger" id="confirm">Delete</button>
                    </div>
                </div>
              </div>
         </div>
        <script type="text/javascript">
          $(function() {
            $( "#tabs" ).tabs();
            $( "#date_of_birth" ).datepicker({
              changeMonth: true,
              changeYear: true,
              yearRange: "-60:+0",
            });
            $( "#admission_date" ).datepicker({
              changeMonth: true,
              changeYear: true,
              yearRange: "-60:+0",
            });
            $( "#fee_code_date" ).datepicker({
              changeMonth: true,
              changeYear: true,
              yearRange: "-60:+0",
            });
            $( "#sponsor_sign_date" ).datepicker({
              changeMonth: true,
              changeYear: true,
              yearRange: "-60:+0",
            });
            
          });
          </script>
@endsection




