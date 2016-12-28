@extends('layouts.app')
@section('content')
<script>
function crearform(){
    $("#department_edit_id").val("");
    $("#department_id").val("");
    $("#department_name").val("");
    $("#contact").val("");
    
}
function myFunction(department_id) {
    $("#department_id").val(department_id);
    $("#department_edit_id").val(department_id);
    //alert($("#department_id").val());
}
function setDelete(department_id){
    $("#department_id").val(department_id);
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
        function setVisitor(department_id){
            $("#department_edit_id").val(department_id);
        }
        $(".edit_button").click(function(){
            var id = $("#department_edit_id").val();
            //console.log( "JSON Data: " + id + " val "+ id );
            $.getJSON( "department_in_json?id="+id, function( json ) {
                //$("#department_id").val(json.id);
                $("#department_name").val(json.department_name);
                $("#contact").val(json.contact);
                
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
                        <button type="button" class="btn btn-danger pull-right" onclick="crearform()" data-toggle="modal" data-target="#myModal">Insert New Department</button>
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
                            <th style=" width: 15%;">Contact</th>
                            
                            <th style=" width: 10%;">Status</th>
                            <th style=" width: 15%;">Edit / Delete</th>
                        </tr>
                </thead>
                    <tbody>
                    <?php foreach ($departments as $dpt){?>
                        <tr >
                            <td> <?php echo $dpt->id;?></td>
                            <td> <?php echo $dpt->department_name; ?></td>
                            <td> <?php echo $dpt->contact; ?></td>
                            
                            <td><?php echo $dpt->status; ?></td>
                            <td><button class="btn btn-danger btn-sm glyphicon glyphicon-refresh edit_button"  onclick="myFunction(<?php echo $dpt->id;?>)"  data-toggle="modal" data-target="#myModal" > Edit </button> &nbsp;&nbsp;
                                    <button class="btn btn-sm btn-danger" type="button" onclick="setDelete(<?php echo $dpt->id;?>);" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this Department ?">
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
                  <h4 class="modal-title">Manage Department Record</h4>
                </div>
                  <div style="width:900px;">
                      {!! Form::Open(array ('url' => '/add_department','class'=>'form-horizontal')) !!}
                      <table class="table"  >
                          <tr>
                              <td>
                                 <div class = "form-group">
                                    <label for = "firstname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Department Name:')}}
                                    </label>

                                   <div class = "col-md-7">
                                       <input type="hidden" name="department_edit_id" id="department_edit_id" value="">
                                       {{ Form::text('department_name',null,array('id'=>'department_name','class' => 'form-control input-sm','placeholder'=>'Enter Department Name','required'=>'true'))}}

                                   </div>
                                </div>
                              </td>
                              <td>
                                  <div class = "form-group">
                                    <label for = "lastname" class = "col-md-4 control-label">
                                         {{ Form::label('title','Contact:')}}
                                    </label>

                                    <div class = "col-md-7">
                                        {{ Form::text('contact',null,array('id'=>'contact','class' => 'form-control input-sm','placeholder'=>'Enter Department Contact'))}}
                                    </div>
                                 </div>
                              </td>
                          </tr>
                          <tr>
                              
                              <td colspan="2">
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
                                  {{ Form::submit('Save Department',array('class' => 'btn btn-circle btn-primary')) }}
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
                    {!! Form::Open(array ('url' => '/remove_department','class'=>'form-horizontal')) !!}
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Delete Parmanently</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure about this ?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <input type="hidden" name="department_id" id="department_id" value=""/>
                          {{ Form::submit('Delete',array('class' => 'btn btn-circle btn-danger')) }}
                          
                        </div>
                    {!! Form::Close()!!}
                </div>
              </div>
         </div>

@endsection