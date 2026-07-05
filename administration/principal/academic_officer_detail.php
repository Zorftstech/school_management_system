<?php

include('header.php');

?>


<div class="container">
  
  <div class="card">


    <div class="card-header">
        <h3>Academic officer details</h3>
        <p id="error"></p>
    </div>


    <div class="card-body">

        <div id="table">

            <!-- load from database with ajax...............


                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td><button type="button" class="btn btn-primary edit_btn" id="id" data-id="id">Edit</button></td>
                        <td><button type="button" class="btn btn-danger delete_btn" id="id" data-id="id">Delete</button></td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td><button type="button" class="btn btn-primary" id="id" data-id="id">Edit</button></td>
                        <td><button type="button" class="btn btn-danger" id="id" data-id="id">Delete</button></td>
                    </tr>
                    <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                        <td><button type="button" class="btn btn-primary" id="id" data-id="id">Edit</button></td>
                        <td><button type="button" class="btn btn-danger" id="id" data-id="id">Delete</button></td>
                    </tr>
                </tbody>
            </table> -->

        </div>

    </div> 


    
  </div>

  <!--model-->

  

  <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Academic Officer Updata form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="form">
                
                    <!-- Modal body -->
                    <div class="modal-body">

                        

                            <div class="form-group">

                            <label for="user">User Name:</label>
                            <input type="text" class="form-control" placeholder="Enter user name" id="user">

                            </div>

                            <div class="form-group">
                                <label for="Status">Select Statua:</label>

                                <select class="form-control" id="status" name="status">

                                <option value="registered">registered</option>
                                <option value="not registered">Not registered</option>
                                
                                </select>
                            
                            </div>      
                        

                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <button type="button" class="btn btn-primary" id="update_btn">Update</button>
                    </div>

                </form>
        
            </div>
        </div>
  </div>

</div>




<script>


    $(document).ready(function(){

         // function to load academic officer detail,,,,,,,,,,

         function load_academic_data() {

            $.ajax({

                url: 'action_php/multipurpose_action.php',
                data: {action: 'load academic officer data'},
                method: 'POST',
                dataType: 'text',

                success: function(data){

                $('#table').html(data); 
                
                }
            })

        }


        //calling load academic officer detail function.........

        load_academic_data();





        // retriving academic officer data for update........

        $(document).on('click', '.edit_btn', function(event) {
           
           var id = event.target.getAttribute('data-id');

           $.ajax({
               url: 'action_php/multipurpose_action.php',
               data: {action: 'fetch academic officer data', id: id},
               method: 'POST',
               dataType: 'json',

               beforeSend: function(){

                   $('#edit'+id).text('Editing.....');
                   $('#edit'+id).attr('disabled', 'disabled');
               },

               success: function(data) {
                  
                   $('#edit'+id).text('Edit');
                   $('#edit'+id).attr('disabled', false);
                   $('#user').val(data.user_name);
                   $('#hidden_id').val(data.id);
                   $('#myModal').modal('show');

               }
           })
           
       })





       // updating academic officer data ..................


       $('#update_btn').click(function(event) {

           event.preventDefault();
          
           var id =  $('#hidden_id').val();
           var user =  $('#user').val();
           var status = $('#status').val();

          $.ajax({

               url: 'action_php/multipurpose_action.php',
               data: {action: 'update academic officer data', id: id, user: user, status: status},
               method: 'POST',
               dataType: 'text',
               beforeSend: function(){

                   $('#update_btn').text('Updating.........');
                   $('#update_btn').attr('disabled', 'disabled');
               },

               success: function(data){
                   
                   $('#update_btn').text('Updae');
                   $('#update_btn').attr('disabled', false);
                   $('#error').text(data);
                   $('#form')[0].reset();
                   $('#myModal').modal('hide');

                   load_academic_data();

                   setTimeout(function(){
                       
                       $('#error').text('');
                   }, 7000);

               }
          })
                  
       })





       // deleting academic officer data..........


       $(document).on('click', '.delete_btn', function(event) {

          

           if (confirm('do you want to delete')) {

               var id = event.target.getAttribute('data-id');
           
           $.ajax({
               url: 'action_php/multipurpose_action.php',
               data: {action: 'delete academic officer data', id: id},
               method: 'POST',
               dataType: 'text',
               beforeSend: function(){
                   
                   $('#delete'+id).text('Deleting.....');
                   $('#delete'+id).attr('disabled', 'disabled');
               },

               success: function(data) {

                   $('#delete'+id).text('Delete');
                   $('#delete'+id).attr('disabled', false);
                   $('#error').text(data);

                   load_academic_data();

                   setTimeout(function(){

                       $('#error').text('');
                   }, 7000);


               }
           })

               
           }

           

       })













    })


</script>




<?php

include('footer.php');

?>