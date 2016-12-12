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
      
        <title>Tabs Example</title>
        <link href='bootstrap/dist/css/bootstrap.css' rel='stylesheet'>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
      
   </head>
    <body>
        <div class="container">
            
            <ul id = "myTab" class = "nav nav-tabs">
                <li class = "active">
                   <a href = "#home" data-toggle = "tab">
                      Tutorial Point Home
                   </a>
                </li>
   
                <li><a href = "#ios" data-toggle = "tab">iOS</a></li>

                <li class = "dropdown">
                   <a href = "#" id = "myTabDrop1" class = "dropdown-toggle" data-toggle = "dropdown">
                      Java 
                      <b class = "caret"></b>
                   </a>

                   <ul class = "dropdown-menu" role = "menu" aria-labelledby = "myTabDrop1">
                      <li><a href = "#jmeter" tabindex = "-1" data-toggle = "tab">jmeter</a></li>
                      <li><a href = "#ejb" tabindex = "-1" data-toggle = "tab">ejb</a></li>
                   </ul>

                </li>

            </ul>

            <div id = "myTabContent" class = "tab-content">

               <div class = "tab-pane fade in active" id = "home">
                   <p style="color: red;">Tutorials Point is a place for beginners in all technical areas.
                     This website covers most of the latest technologies and explains each of
                     the technology with simple examples. You also have a 
                     <b>tryit</b> editor, wherein you can edit your code and 
                     try out different possibilities of the examples.</p>
                   <p style="color: red;">Tutorials Point is a place for beginners in all technical areas.
                     This website covers most of the latest technologies and explains each of
                     the technology with simple examples. You also have a 
                     <b>tryit</b> editor, wherein you can edit your code and 
                     try out different possibilities of the examples.</p>
                   <p style="color: red;">Tutorials Point is a place for beginners in all technical areas.
                     This website covers most of the latest technologies and explains each of
                     the technology with simple examples. You also have a 
                     <b>tryit</b> editor, wherein you can edit your code and 
                     try out different possibilities of the examples.</p>
               </div>

               <div class = "tab-pane fade" id = "ios">
                   <p style="color:green;">iOS is a mobile operating system developed and distributed 
                     by Apple Inc. Originally released in 2007 for the iPhone, iPod Touch,
                     and Apple TV. iOS is derived from OS X, with which it shares the 
                     Darwin foundation. iOS is Apple's mobile version of the OS X 
                     operating system used on Apple computers.</p>
               </div>

               <div class = "tab-pane fade" id = "jmeter">
                  <p>jMeter is an Open Source testing software. It is 100% pure Java 
                     application for load and performance testing.</p>
               </div>

               <div class = "tab-pane fade" id = "ejb">
                  <p>Enterprise Java Beans (EJB) is a development architecture for 
                     building highly scalable and robust enterprise level applications to be 
                     deployed on J2EE compliant Application Server such as JBOSS, Web Logic etc.</p>
               </div>

            </div>
            
            
         </div>
    </body>
</html>
