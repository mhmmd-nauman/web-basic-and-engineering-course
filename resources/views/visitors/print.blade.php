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
    <style>
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color:#d4d4d4;
          }  
      
    </style>

@section('content')
        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">Insert New Record</button>
        <div class=" container" >
             <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header" style=" background-color: #ac2925; color: white; font-size: 23px;  ">
                              <button type="button" class="close" data-dismiss="modal"><span class=" glyphicon glyphicon-remove"></span></button>
                          <h4 class="modal-title">Insert Bear Record</h4>
                        </div>
                          <div class="modal-body" style=" background-image: url(images/dd.jpg); backface-visibility: 20px;">

                            {!! Form::Open(array ('url' => '/submit')) !!}
                            {{ Form::label('title','Name:')}}
                            {{ Form::text('name',null,array('class' => 'form-control'))}}
                            {{ Form::label('title','Type:')}}
                            {{ Form::text('type',null,array('class' => 'form-control'))}}
                            {{ Form::label('title','Danger Level:')}}
                            {{ Form::text('level',null,array('class' => 'form-control'))}}
                            <br>
                            {{ Form::submit('Submit Record',array('class' => 'btn btn-circle btn-primary')) }}
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
                
                    <table style="margin-top: 5%; " class="table table-hover" >
                                <tr>
                                    <th >ID</th>
                                    <th >name</th>
                                    <th >Type</th>
                                    <th>Danger Level</th>
                                    <th>Edit / Delete</th>
                                </tr>
                            <?php foreach ($users as $user){?>
                                <tr id="show">
                                    <td><?php echo $user->id;?></td>
                                    <td><?php echo $user->name; ?></td>
                                    <td> <?php echo $user->type; ?></td>
                                    <td> <?php echo $user->danger_level;  ?></td>
                                    <td><button class="btn btn-danger btn-sm glyphicon glyphicon-refresh"> Edit </button> &nbsp;&nbsp;<form method="POST" action="http://example.com/admin/user/delete/12" accept-charset="UTF-8" style="display:inline">
                                        <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
                                            <i class="glyphicon glyphicon-trash"></i> Delete
                                        </button>
</form>

                                </tr>
                            <?php } ?>
                     </table>
           
        </div>
@endsection



