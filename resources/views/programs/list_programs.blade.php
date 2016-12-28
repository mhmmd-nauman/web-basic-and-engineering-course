@extends('layouts.app')
@section('content')
<script>
function crearform(){
    $("#program_edit_id").val("");
    $("#program_id").val("");
    $("#program_name").val("");
    $("#duration").val("1").change();
    
}
function myFunction(program_id) {
    $("#program_id").val(program_id);
    $("#program_edit_id").val(program_id);
    //alert($("#program_id").val());
}
function setDelete(program_id){
    $("#program_id").val(program_id);
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
<script type="text/javascript">
    $(document).ready(function(){
        function setVisitor(program_id){
            $("#program_edit_id").val(program_id);
        }
        $(".edit_button").click(function(){
            var id = $("#program_edit_id").val();
            //console.log( "JSON Data: " + id + " val "+ id );
            $.getJSON( "program_in_json?id="+id, function( json ) {
                //$("#program_id").val(json.id);
                $("#program_name").val(json.program_name);
                $("#duration").val(json.duration).change();
                $("#department").val(json.department_id).change();
                //$.each( json, function( key, val ) {
                    //console.log( "JSON Data: " + json.id + " val "+ val );
                    
                  //});
                
           });
        });
        $("#visitor_table").dataTable();
    });
</script>
<style type="text/css">
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color:#d4d4d4;
          }  
</style>


        
        <div class=" container" >
            <div class="row" style="margin: 0 0 0 0px;">
                <div class=" col-md-6">
                    <h3>{{$report_title}}</h3>
                </div>
                <div class="col-md-6">
                    <div class = "dropdown pull-right">
                        <button type="button" class="btn btn-danger pull-right" onclick="crearform()" data-toggle="modal" data-target="#myModal">Insert New Program</button>
                    </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                
                <table class=" display" id="visitor_table" >
                <thead>            
                <tr>
                            <th style=" width: 10%;">ID</th>
                            
                            <th>Name</th>
                            <th>Department</th>
                            <th style=" width: 15%;">Duration</th>
                            
                            <th style=" width: 10%;">Status</th>
                            <th style=" width: 15%;">Edit / Delete</th>
                        </tr>
                </thead>
                    <tbody>
                    <?php foreach ($programs as $program){?>
                        <tr >
                            <td> <?php echo $program->id;?></td>
                            <td> <?php echo $program->program_name; ?></td>
                            <td> <?php echo $program->department->department_name; ?></td>
                            <td> <?php echo $program->duration; ?> Year(s)</td>
                            
                            <td><?php echo $program->status; ?></td>
                            <td><button class="btn btn-danger btn-sm glyphicon glyphicon-refresh edit_button"  onclick="myFunction(<?php echo $program->id;?>)"  data-toggle="modal" data-target="#myModal" > Edit </button> &nbsp;&nbsp;
                                    <button class="btn btn-sm btn-danger" type="button" onclick="setDelete(<?php echo $program->id;?>);" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Program" data-message="Are you sure you want to delete this Program ?">
                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                </button>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
             </table>

            </div>
                    
        </div>

<div class="modal fade" id="myModal" role="dialog" style=" margin: 0px;">
    <div class="modal-dialog" style="width: 90%;height: 90%;display: inline-block;text-align: center;vertical-align: middle;">
              <!-- Modal content-->
              <div class="modal-content" style="height: 90%;min-height: 90%;height: auto;border-radius: 0;">
                  <div class="modal-header" style=" background-color: #ac2925; color: white; font-size: 23px;">
                      <button type="button" class="close" data-dismiss="modal"><span class=" glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title">Manage Program Record</h4>
                </div>
                  <div style="width:900px;">
                      {!! Form::Open(array ('url' => '/add_program','class'=>'form-horizontal')) !!}
                      <table class="table"  >
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Program Name:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       <input type="hidden" name="program_edit_id" id="program_edit_id" value="">
                                       {{ Form::text('program_name',null,array('id'=>'program_name','class' => 'form-control input-sm','placeholder'=>'Enter Program Name','required'=>'true'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Duration:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        <select name="duration" id="duration" class="form-control input-sm">
                                           <option value="1" selected="selected">One Year</option>
                                           <option value="1.5">1.5 Years</option>
                                           <option value="2">2 Years</option>
                                           <option value="3">3 Years</option>
                                           <option value="4">4 Years</option>
                                           
                                       </select>
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
                                       <select name="department" id="department" class="form-control input-sm">
                                           <option value="1">Computer Science</option>
                                           <option value="2">MBA</option>
                                           
                                       </select>
                                   </div>
                                </div>
                              </td>
                              <td >
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Status:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        <div class = "radio">
                                        <label>
                                           <input type = "radio" name = "status" id = "status" value = "Active" checked> Active
                                        </label>
                                        <label>
                                           <input type = "radio" name = "status" id = "status" value = "Disabled">
                                           Disabled
                                        </label>
                                     </div>

                                    </div>
                                 </div>
                              </td>
                          </tr>
                          
                          <tr>
                              <td class="col-md-12" colspan="2">
                                  <div class = "col-md-offset-5 col-md-5">
                                  {{ Form::submit('Save Program',array('class' => 'btn btn-circle btn-primary')) }}
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
                    {!! Form::Open(array ('url' => '/remove_program','class'=>'form-horizontal')) !!}
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Delete Parmanently</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure about this ?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <input type="hidden" name="program_id" id="program_id" value=""/>
                          {{ Form::submit('Delete',array('class' => 'btn btn-circle btn-danger')) }}
                          
                        </div>
                    {!! Form::Close()!!}
                </div>
              </div>
         </div>

@endsection