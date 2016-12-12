<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
     <head>
      <meta charset = "utf-8">
      <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">
      
      <title>Send email to me</title>
      <link href='bootstrap/dist/css/bootstrap.css' rel='stylesheet'>
     
      
   </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="background-color: red;">
                    dsds
                </div>
                <div class="col-md-6">
                    dsds
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class = "table">
                        <caption>Basic Table Layout</caption>

                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>City</th>
                           </tr>
                        </thead>

                        <tbody>
                           <tr>
                              <td>Tanmay</td>
                              <td>Bangalore</td>
                           </tr>

                           <tr>
                              <td>Sachin</td>
                              <td>Mumbai</td>
                           </tr>
                        </tbody>

                     </table>
                </div>
            </div>
            <div class="row">
                <form role = "form">

                    <div class = "form-group">
                       <label for = "name">Name</label>
                       <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                    </div>

                    <div class = "form-group">
                       <label for = "inputfile">File input</label>
                       <input type = "file" id = "inputfile">
                       <p class = "help-block">Example block-level help text here.</p>
                    </div>

                    <div class = "checkbox">
                       <label><input type = "checkbox"> Check me out</label>
                    </div>

                    <button type = "submit" class = "btn btn-default">Submit</button>
                 </form>
                <form class = "form-horizontal" role = "form">
   
                    <div class = "form-group">
                       <label for = "firstname" class = "col-sm-2 control-label">First Name</label>

                       <div class = "col-sm-10">
                          <input type = "text" class = "form-control" id = "firstname" placeholder = "Enter First Name">
                       </div>
                    </div>

                    <div class = "form-group">
                       <label for = "lastname" class = "col-sm-2 control-label">Last Name</label>

                       <div class = "col-sm-10">
                          <input type = "text" class = "form-control" id = "lastname" placeholder = "Enter Last Name">
                       </div>
                    </div>

                    <div class = "form-group">
                       <div class = "col-sm-offset-2 col-sm-10">
                          <div class = "checkbox">
                             <label><input type = "checkbox"> Remember me</label>
                          </div>
                       </div>
                    </div>

                    <div class = "form-group">
                       <div class = "col-sm-offset-2 col-sm-10">
                          <button type = "submit" class = "btn btn-danger">Sign in</button>
                       </div>
                    </div>

                 </form>
                <!-- Standard button -->
                <button type = "button" class = "btn btn-default">Default Button</button>

                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <button type = "button" class = "btn btn-primary">Primary Button</button>

                <!-- Indicates a successful or positive action -->
                <button type = "button" class = "btn btn-success">Success Button</button>

                <!-- Contextual button for informational alert messages -->
                <button type = "button" class = "btn btn-info">Info Button</button>

                <!-- Indicates caution should be taken with this action -->
                <button type = "button" class = "btn btn-warning">Warning Button</button>

                <!-- Indicates a dangerous or potentially negative action -->
                <button type = "button" class = "btn btn-danger">Danger Button</button>

                <!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
                <button type = "button" class = "btn btn-link">Link Button</button>
            </div>
            <div>
                <img src = "/bootstrap/images/download.png" class = "img-rounded">

                <img src = "/bootstrap/images/download.png" class = "img-circle">

                <img src = "/bootstrap/images/download.png" class = "img-thumbnail">
            </div>
            
            
            
         </div>
    </body>
</html>
