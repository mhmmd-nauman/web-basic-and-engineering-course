@extends('layouts.app')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bear Record</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
function myFunction() {
    confirm("Press a button!");
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
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }
        .modal-content {
            height: 90%;
            min-height: 90%;
            height: auto;
            border-radius: 0;
        }
    </style>

@section('content')
        
        <div class=" container" >
            <div class="row">
                <div class=" col-md-8">
                    &nbsp;
                </div>
                <div class=" col-md-4">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Insert New Visitor</button>
                    <a  href="{{url('/visitor-export-excel')}}" target="_blank" class="btn btn-success">Export to Excel</a>
                </div>
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
               <table class="table table-hover" >
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Program</th>
                                    <th>Call/Visit</th>
                                    <th>Edit / Delete</th>
                                </tr>
                            <?php foreach ($students as $student){?>
                                <tr id="show">
                                    <td><?php echo $student->id;?></td>
                                    <td> <?php echo $student->first_name." ".$student->last_name; ?></td>
                                    <td> <?php echo $student->mobile;  ?></td>
                                    <td><?php echo $student->program; ?></td>
                                    <td><?php echo $student->visit_type; ?></td>
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
<div class="modal fade" id="myModal" role="dialog" style=" margin: 0px;">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content" style="width:1000px;">
                  <div class="modal-header" style=" background-color: #ac2925; color: white; font-size: 23px;">
                      <button type="button" class="close" data-dismiss="modal"><span class=" glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title">Insert Visitor Record</h4>
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

@endsection



