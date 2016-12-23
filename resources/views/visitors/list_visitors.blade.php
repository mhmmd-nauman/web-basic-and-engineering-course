@extends('layouts.app')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project-A3I Visitor Records</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
function crearform(){
    $("#visitor_edit_id").val("");
    $("#visitor_id").val("");
    $("#first_name").val("");
    $("#last_name").val("");
    $("#mobile").val("");
    $("#program").val("BS Civil").change();
    $("#information_source").val("");
    $('input[name="visit_type"][value="call"]').attr('checked',true);
}
function myFunction(visitor_id) {
    $("#visitor_id").val(visitor_id);
    $("#visitor_edit_id").val(visitor_id);
    //alert(visitor_id);
}
function setDelete(visitor_id){
    $("#visitor_id").val(visitor_id);
}
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

@section('content')
        
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
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor')}}">Today</a>
                            </li>

                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor?load=yesterday')}}">Yesterday</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor?load=last7day')}}">Last 7 Days</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor?load=last30day')}}">Last 30 Days</a>
                            </li>

                            <li role = "presentation" class = "divider"></li>

                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor')}}">Only Mine</a>
                            </li>
                            <li role = "presentation">
                               <a role = "menuitem" tabindex = "-1" href = "{{url('/visitor?load=viewalldata')}}">View All Data</a>
                            </li>
                         </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <button type="button" class="btn btn-danger" onclick="crearform()" data-toggle="modal" data-target="#myModal">Insert New Visitor</button>
                    <a  href="{{url('/visitor-export-excel')}}" target="_blank" class="btn btn-success">Export to Excel</a>
                    <a  href="{{url('/visitor-export-pdf')}}" target="_blank" class="btn btn-success">Export to PDF</a>
                </div>
            </div>
            <div class="row">
                <h4>Visitors Information - {{$report_title}}</h4>
            </div>
            <div class="row">
               <table class="table table-hover" >
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Program</th>
                                    <th>Call/Visit</th>
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
                                    <td><?php echo $student->visit_type; ?></td>
                                    <td><?php echo $student->dealt_by; ?></td>
                                    <td><?php echo $student->status; ?></td>
                                    <td><button class="btn btn-danger btn-sm glyphicon glyphicon-refresh" id="edit_button" onclick="myFunction(<?php echo $student->id;?>)"  data-toggle="modal" data-target="#myModal" > Edit </button> &nbsp;&nbsp;
                                            <button class="btn btn-sm btn-danger" type="button" onclick="setDelete(<?php echo $student->id;?>);" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
                                            <i class="glyphicon glyphicon-trash"></i> Delete
                                        </button>
                                        
                                    </td>
                                </tr>
                            <?php } ?>
                     </table>
            
            </div>
                    
        </div>
<script type="text/javascript">
    $(document).ready(function(){
        function setVisitor(visitor_id){
            $("#visitor_edit_id").val(visitor_id);
        }
        $("#edit_button").click(function(){
            var id = $("#visitor_id").val();
            $.getJSON( "visitor_in_json?id="+id, function( json ) {
                //$("#visitor_id").val(json.id);
                $("#first_name").val(json.first_name);
                $("#last_name").val(json.last_name);
                $("#mobile").val(json.mobile);
                $("#program").val(json.program).change();
                $("#information_source").val(json.information_source);
                $('input[name="visit_type"][value="' + json.visit_type + '"]').attr('checked',true);
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
                  <h4 class="modal-title">Manage Visitor Record</h4>
                </div>
                  <div style="width:900px;">
                      {!! Form::Open(array ('url' => '/add_visitor','class'=>'form-horizontal')) !!}
                      <table class="table"  >
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','First Name:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       <input type="hidden" name="visitor_edit_id" id="visitor_edit_id" value="">
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
                                         {{ Form::label('title','Call/Visit:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        <div class = "radio">
                                        <label>
                                           <input type = "radio" name = "visit_type" id = "visit_type" value = "call" checked> Call
                                        </label>
                                        <label>
                                           <input type = "radio" name = "visit_type" id = "visit_type" value = "visit">
                                           Visit
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
                                         {{ Form::label('title','Information Source:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       {{ Form::text('information_source',null,array('id'=>'information_source','class' => 'form-control input-sm','placeholder'=>'Information Source'))}}

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
                              <td class="col-md-12" colspan="2">
                                  <div class = "col-md-offset-5 col-md-5">
                                  {{ Form::submit('Save Visitor',array('class' => 'btn btn-circle btn-primary')) }}
                                  </div>
                              </td>
                          </tr>
                      </table> 
                      
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
                    {!! Form::Open(array ('url' => '/remove_visitor','class'=>'form-horizontal')) !!}
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Delete Parmanently</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure about this ?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <input type="hidden" name="visitor_id" id="visitor_id" value=""/>
                          {{ Form::submit('Delete',array('class' => 'btn btn-circle btn-danger')) }}
                          
                        </div>
                    {!! Form::Close()!!}
                </div>
              </div>
         </div>

@endsection



