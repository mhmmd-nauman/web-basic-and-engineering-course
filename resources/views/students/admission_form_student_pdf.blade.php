@extends('layouts.app_pdf')
@section('content')
<style>
    .table_left_cell{
        text-align:  right;
        width: 30%;
    }
    .table_left_cell_without_width{
        text-align:  right;
        //width: 30%;
    }
    .table_right_cell_line{
        border-bottom:1px #000 solid; 
        padding-left: 5px;
    }
    .table_left_cell_inner{
        text-align:  left;
        width: 20%;
    }
</style>
        <div class=" container" >
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h2>National College of Business <br>Administration & Economics</h2>
                </div>
            </div>
            <div class="row" style="text-align: center; min-height: 300px;">
                <div class="col-md-12">
                    <h2>Logo</h2>
                </div>
            </div>
            <div class="row">
                <table class="table" style=" width: 100%; "  >
                    <tr>
                        <td class=" table_left_cell">
                            <h4>Program: </h4>
                        </td>
                        <td >
                            <div class="table_right_cell_line" >
                                <h4><?php echo $student->program; ?> </h4>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell">
                            <h4>Session: </h4>
                        </td>
                        <td >
                            <div class="table_right_cell_line" >
                                <h4><?php echo $student->semester; ?> 2014-2016 </h4>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell">
                            <h4>Name of Applicant: </h4>
                        </td>
                        <td >
                            <div class="table_right_cell_line" >
                                <h4><?php echo $student->first_name." ".$student->last_name; ?> </h4>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            
            <div class="row">
                <table class="table" style=" width: 100%;">
                    <tr>
                        <td  style=" width: 75%;">
                            <table class="table" style=" width: 100%;">
                                <tr>
                                    <td class="table_left_cell_inner">
                                        <label for = "firstname" class = "col-md-4 control-label">Program Applied For:</label>
                                    </td>
                                    <td >
                                        <div class="table_right_cell_line" >
                                            <?php echo $student->program; ?>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="table_left_cell_inner">
                                        <label for = "firstname" class = "col-md-4 control-label">Semester:</label>
                                    </td>
                                    <td  >
                                        <div class="table_right_cell_line" >
                                            <h4><?php echo $student->semester; ?> </h4>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table_left_cell_inner">
                                        <label for = "firstname" class = "col-md-4 control-label">Name:</label>

                                    </td>
                                    <td  >
                                        <div class="table_right_cell_line" >
                                            <h4><?php echo $student->first_name." ".$student->last_name; ?> </h4>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                        <td >
                            <div style=" border: 1px #000 solid; padding: 20px; min-height: 150px; min-width: 100px; text-align: center; font-size: 10px;">
                                &nbsp;<br><br><br>Please staple three photo<br><br><br>here<br><br><br>35mm long and 30mm
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                 <table style=" width: 100%; padding: 5px; margin: 5px;">
                     <tr>
                         <td class="table_left_cell_inner">
                             {{ Form::label('title','Occup. Fath./Gaurd.:')}}
                         </td>
                         <td class = "table_right_cell_line">
                             <?php echo $student->father_occupation;?>
                         </td>
                     </tr>
                     <tr>
                         <td class="table_left_cell_inner">
                             {{ Form::label('title','Email:')}}
                         </td>
                         <td class = "table_right_cell_line">
                             <?php echo $student->email;?>
                         </td>
                     </tr>
                     <tr>
                         <td class="table_left_cell_inner">
                             {{ Form::label('title','Address:')}}
                         </td>
                         <td class = "table_right_cell_line">
                             <?php echo $student->address;?>
                         </td>
                     </tr>
                    
                
                </table>
                <table   style=" width: 100%;" >
                <tr>
                    <td class="table_left_cell_inner">
                       {{ Form::label('title','Gender:')}}
                    </td>
                    <td class="table_right_cell_line">
                        <?php echo $student->gender;?>
                    </td>
                     
                    <td class="table_left_cell_inner">
                     {{ Form::label('title','Marital Status:')}}
                         
                    </td>
                    <td class="table_right_cell_line">
                        <?php echo $student->marital_status;?>
                    </td>
                </tr>
                <tr>
                    <td class="table_left_cell_inner">
                       {{ Form::label('title','Date of Birth:')}}
                    </td>
                    <td class="table_right_cell_line">
                        <?php echo $student->date_of_birth;?>
                    </td>
                     
                    <td class="table_left_cell_inner">
                     {{ Form::label('title','Country of Citizenship:')}}
                         
                    </td>
                    <td class="table_right_cell_line">
                        <?php echo $student->country_of_citizenship;?>
                    </td>
                </tr>
                 <tr>
                    <td class="table_left_cell_inner">
                       {{ Form::label('title','CNIC:')}}
                    </td>
                    <td class="table_right_cell_line">
                        <?php echo $student->cnic;?>
                    </td>
                     
                    <td class="table_left_cell_inner">
                     {{ Form::label('title','Phone:')}}
                         
                    </td>
                    <td class="table_right_cell_line">
                         <?php echo $student->phone;?>
                    </td>
                </tr>
                
                <tr>
                    <td class="table_left_cell_inner">
                        {{ Form::label('title','Postal Address:')}}
                    </td>
                  <td colspan="3" class="table_right_cell_line" >
                     <?php echo $student->postal_address;?>
                  </td>

                </tr>
            </table>
                <div style="text-align: center;">
                <h4>
                    Educational Background
                </h4>
                </div>
                <table  style="width: 100%; border:  1px #000 solid;">
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
                      ll
                  </td>
                  <td>
                    yy  
                  </td>
                  <td>
                      kk
                  </td>
                  <td>
                      ll
                  </td>
                  <td>
                    jj  
                  </td>
                  <td>
                      hh
                  </td>
                </tr>

                
          </table>
           <table style="width: 100%;" >
                <tr>
                    <td  class="table_left_cell_inner">
                       
                               {{ Form::label('title','If you are presently a candidate for any title, degree or diploma, name it')}}
                          
                    </td>
                </tr>
                <tr>
                    <td  class=" table_right_cell_line">
                        
                              <?php echo $student->candidate_for_any_degree_title;?>
                          
                    </td>
                </tr>
                <tr>
                <td style="width:100%" >
                    <table style="width:100%; text-align: center;">
                        <tr>
                            <td colspan="2"><b>College or University Majors(s):</b></td>
                        </tr>
                        <tr>
                            <td style="width:50%"><b>Major in Undergraduate Studies:</b></td>
                            <td ><b>Major in Graduate Studies:</b></td>
                        </tr>
                        <tr>
                            <td class=" table_right_cell_line">
                                 Sub one
                            </td>
                            <td class=" table_right_cell_line">
                                sub twoo
                            </td>
                        </tr>
                     </table>
                    </td>
                </tr>
            
            </table>
            <table style="width:100%" >
                <tr>
                    <td class=" table_left_cell_inner">
                    
                           {{ Form::label('title','Years of English Medium Schooling:')}}
                 </td>
                 <td class=" table_right_cell_line">
                           <?php echo $student->years_of_english_medium;?>
                       
                 </td>
               </tr>

                <tr>
                 <td class=" table_left_cell_inner">
                     
                         {{ Form::label('title','First Language:')}}
                 </td>
                 <td class=" table_right_cell_line">
                         <?php echo $student->first_language;?>
                    
                     
                 </td>
             </tr>


             <tr>
                 <td  colspan="2" >
                     <table  style="width:100%; text-align: center;" >
                         <tr>
                             <td colspan="5"><h4>(Rate yourself E-Excellent, G-Good, F-Fair, P-Poor)</h4></td>
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
                                 Urdu
                             </td>
                             <td class="col-md-2">
                                 E
                             </td>
                             <td class="col-md-2">
                                 E
                             </td>
                             <td class="col-md-2">
                                 E
                             </td>
                             <td class="col-md-2">
                                 E
                             </td>
                         </tr>
                         
                     </table>
                 </td>
             </tr>
             <tr>
                 <td class=" table_left_cell_inner">
                    {{ Form::label('title','Honors and Awards if any:')}}
                 </td>
                 <td class=" table_right_cell_line">
                    <?php echo $student->honors_awards;?>
                      
                 </td>
             </tr>

              <tr>
                  <td  class=" table_left_cell_inner">
                    
                            {{ Form::label('title','Favourite Activities:')}}
                  </td>
                  <td class=" table_right_cell_line">
                          <?php echo $student->fav_activities;?>
                      
                 </td>
               </tr>
               
               </table>
                <table  style="width:100%;">
                 <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Name of Applicant:')}}
                        </td>
                        <td class=" table_right_cell_line">
                                <?php echo $student->applicant_name;?>
                            
                      </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Privately Supported Student:')}}
                        </td>
                        <td class=" table_right_cell_line">
                                <?php echo $student->privately_supported_student;?>
                            
                      </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Name of Sponsor:')}}
                        </td>
                        <td class=" table_right_cell_line">
                                <?php echo $student->sponsor_name;?>
                            
                      </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Relationship to Sponsored Student:')}}
                        </td>
                        <td class=" table_right_cell_line">
                                <?php echo $student->sponsor_relation;?>
                            
                      </td>
                    </tr>
                    <tr>
                        
                        <td colspan="2">
                            <table style=" width: 100%;">
                                <tr>
                                    <td class=" table_left_cell_without_width">
                                        {{ Form::label('title','Signature of Sponsor:')}}
                                    </td>
                                    <td class=" table_right_cell_line">
                                        &nbsp;
                                    </td>
                                    <td class=" table_left_cell_without_width">
                                        Dated:
                                    </td>
                                    <td class=" table_right_cell_line">
                                       <?php echo $student->sponsor_sign_date;?>
                                    </td>
                                    <td class=" table_left_cell_without_width">
                                       Day of
                                    </td>
                                    <td class=" table_right_cell_line">
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                              
                         
                      </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <p>
                                I certify that the information provided
                            </p>
                        </td>
                    </tr>
                </table>
                <table style="width:100%;">
                    <tr>
                        <td style="width: 80%; text-align: right;">
                          {{ Form::label('title','Signature of Application:')}}
                       </td>
                       <td class="  table_right_cell_line">
                           &nbsp;
                      </td> 
                    </tr>
                    

              </table>
              <table style="width:100%;">
                    <tr>
                        <td class=" table_left_cell_inner">
                            {{ Form::label('title','Admission Status:')}}
                        </td>
                        <td class=" table_right_cell_line">
                         <?php echo $student->admission_status;?>
                        </td>
                        <td class=" table_left_cell_inner">
                          {{ Form::label('title','Dated:')}}
                        </td>
                        <td class=" table_right_cell_line">
                            <?php echo $student->admission_date;?>
                        </td>
                    </tr>
                </table>
                <table style="width:100%;">
                    <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Interviewd by:')}}
                        </td>
                        <td class=" table_right_cell_line">
                                <?php echo $student->interviewed_by;?>
                            
                      </td>
                    </tr>
                    <tr>
                        <td class=" table_left_cell_inner">
                          
                                 {{ Form::label('title','Chairman Admission Committee:')}}
                        </td>
                        <td class=" table_right_cell_line">
                            
                                <?php echo $student->chairman_admission_committee;?>
                            
                      </td>
                    </tr>
                    <tr>
                        
                        <td colspan="2">
                            <table style=" width: 100%;">
                                <tr>
                                    <td class=" table_left_cell_without_width">
                                        {{ Form::label('title','Fee Code:')}}
                                    </td>
                                    <td class=" table_right_cell_line">
                                        <?php echo $student->fee_code;?>
                                    </td>
                                    <td class=" table_left_cell_without_width">
                                        Signature:
                                    </td>
                                    <td class=" table_right_cell_line">
                                        &nbsp;
                                    </td>
                                    <td class=" table_left_cell_without_width">
                                       Dated: 
                                    </td>
                                    <td class=" table_right_cell_line">
                                        <?php echo $student->fee_code_date;?>
                                    </td>
                                </tr>
                            </table>
                              
                         
                      </td>
                    </tr>
                    

              </table> 
                                
        </div>

    </div>
@endsection



