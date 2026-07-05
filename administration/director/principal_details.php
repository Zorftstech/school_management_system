<?php

include('action_php/header.php');
?>


<div class="container">
  <div class="card" style="margin-top: 40px;">
        <div class="card-header"><h3>Principal Details</h3>
            <span id="error" style="font-size: 15px;" class="text-primary"></span>
        </div>
            <div class="card-body" style="overflow-x: scroll;">

                <div id="table">

                        <!-- fetch from database......

                            <table class="table table-striped">
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
                                <td><button type="button" class="btn btn-primary edit_btn" id="id">Edit</button></td>
                                <td><button type="button" class="btn btn-danger delete_btn" id="id">Delete</button></td>
                            </tr>
                            </tbody>
                        </table>-->
                        
                        <button data-id=""></button>

                    </div>

        </div> 

    </div>


    
  

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" id="form">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Principal Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                
                        <div class="form-group">
                          <label for="user">User Name:</label>
                          <input type="text" class="form-control" id="user" placeholder="User Name" name="user">
                        </div>

                        <div class="form-group">
                            <label for="status">Select Status:</label>
                            <select class="form-control" id="status" name="status">
                              <option value="registered">registered</option>
                              <option value="not registered">not registered</option>
                            </select>
                          </div>

                        <input type="hidden" name="id" id="hidden_id">

                        
                
                      
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="update_btn">Update</button>
                </div>
                </form>
                
            </div>
        </div>
  </div>


</div>



<script>

    $(document).ready(function(){

        
        // funtion to load principal detail.............

        function load_principal_details() {

            $.ajax({
                url: 'action_php/principal_detail_action.php',
                data: {action: 'load'},
                method: 'POST',
                dataType: 'text',

                success: function(data) {
                    
                    $('#table').html(data);
                }
            })
        }


        load_principal_details();


        // selecting principal detail for editing.....

        $(document).on('click', '.edit_btn', function(event) {

            var id = event.target.getAttribute('data-id');

        
            $.ajax({

                url: 'action_php/principal_detail_action.php',
                data: {action: 'fetch', id: id},
                method: 'POST',
                dataType: 'json',
                beforeSend: function() {

                    $('#id'+id).text('Editing.....');

                    $('#id'+id).attr('disabled', 'disabled');
    
                },

                success: function(data) {

                    $('#id'+id).text('Edit');

                    $('#id'+id).attr('disabled', false);

                    $('#user').val(data.user_name);
                    $('#hidden_id').val(data.id);
                    $('#myModal').modal('show');

                }

            })
        })




        // updating principal details.....

        $('#update_btn').click(function(){

           var id = $('#hidden_id').val();
           var user_name = $('#user').val();
           var status = $('#status').val();

           $.ajax({
               url: 'action_php/principal_detail_action.php',
               data: {action: 'update', id: id, user_name: user_name, status: status},
               method: 'POST',
               dataType: 'text',

               beforeSend: function(){

                $('#update_btn').text('Updating.....');
                $('#update_btn').attr('disabled', 'disabled');

               },

               success: function(data) {

                $('#update_btn').text('Updae');
                $('#update_btn').attr('disabled', false);
                $('#error').text(data);
                $('#form')[0].reset();
                $('#myModal').modal('hide');
                load_principal_details();

                setTimeout(function(){
                    $('#error').text('');
                }, 5000);

               }
           })
        })



        // deleting principal details.....

        /*$(document).on('click', '.delete_btn', function(event) {

            var id = event.target.getAttribute('data-id');
            
            $.ajax({
                url: 'action_php/principal_detail_action.php',
                data: {action: 'delete', id: id},
                method: 'POST',
                dataType: 'text',

                beforeSend: function(){
                
                    $('#ide'+id).text('Deleting.....');
                    $('#ide'+id).attr('disabled', 'diaabled');
                },

                success: function(data){

                    $('#ide'+id).text('Delete');
                    $('#ide'+id).attr('disabled', false);
                    $('#error').text(data);

                    load_principal_details();

                    setTimeout(function(){
                        $('#error').text('');
                    }, 5000);

                }
            })
        
        })*/





    })

</script>




<?php

    include('action_php/footer.php');

?>