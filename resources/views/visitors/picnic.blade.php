@extends('layouts.app')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #ac2925;
             
          }  
    </style>
@section('content')
                <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">Insert Picnic Record</button>

    <div class=" container">
            <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Insert Picnic Record</h4>
                            </div>
                            <div class="modal-body">

                                {!! Form::Open(array ('url' => '/submit')) !!}
                                {{ Form::label('title','Name:')}}
                                {{ Form::text('name',null,array('class' => 'form-control'))}}
                                {{ Form::label('title','Tast Level:')}}
                                {{ Form::text('type',null,array('class' => 'form-control'))}}

                                <br>
                                {{ Form::submit('Submit',array('class' => 'btn btn-large btn-primary openbutton')) }}
                                {!! Form::Close()!!}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
            </div>
            <table style="margin-top: 5%; " class="table table-hover" >
                        <tr>
                            <th >ID</th>
                            <th >Name</th>
                            <th >Taste_level</th>
                            <th>Edit / Delete</th>
                        </tr>
                    <?php foreach ($users as $user):?>
                        <tr>
                            <td><?php echo $user->id;?></td>
                            <td><?php echo $user->name; ?></td>
                            <td> <?php echo $user->taste_level	; ?></td>
                            <td><button class="btn btn-danger glyphicon glyphicon-refresh">Edit</button> &nbsp;&nbsp;<button class="btn btn-danger glyphicon glyphicon-remove">Remove</button>

                        </tr>
                        
                    <?php endforeach; ?>
             </table>
    
</div>
@endsection

