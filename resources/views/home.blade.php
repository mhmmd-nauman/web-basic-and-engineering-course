@extends('layouts.app')
@section('content')
<div class="container">
  <div class="jumbotron">
    <h3>Welcome to NCBA&E Administration</h3> 
  </div>
    <h3>Visitors</h3>
  <div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 25%"></div>
  <div class="progress-bar progress-bar-warning" style="width: 20%"></div>
  <div class="progress-bar progress-bar-danger" style="width: 10%"></div>
</div>
      <h3>Sessions</h3>
  <div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 30%"></div>
  <div class="progress-bar progress-bar-warning" style="width: 20%"></div>
  <div class="progress-bar progress-bar-danger" style="width: 40%"></div>
</div>
        <h3>Other Things</h3>
  <div class="progress">
  <div class="progress-bar progress-bar-success" style="width: 20%"></div>
  <div class="progress-bar progress-bar-warning" style="width: 20%"></div>
  <div class="progress-bar progress-bar-danger" style="width: 30%"></div>
</div>
</div>

@endsection