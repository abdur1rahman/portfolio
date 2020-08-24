@extends('Layout.app')
@section('content')
<div id="mainDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="AddButton" class="btn-sm btn btn-danger mb-2">Add New</button>
            <table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                 <thead>
                     <tr>
                          <th class="th-sm">Image</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Description</th>
                          <th class="th-sm">Edit</th>
                          <th class="th-sm">Delete</th>
                     </tr>
                </thead>
                <tbody id='service_table'>

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="loding" class="container">
    <div class="row tex-center">
        <div class="col-md-12 p-5">
           <center> Lodding<img class="Lodding" src="{{asset('images/1.gif')}}"/> </center>
        </div>
    </div>
</div>

<div id="Wrong" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 tex-center">
           <h3 class="WrongText"> Somthing want wrong </h3>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <h4 class="WrongText">Do you Want to Delete </h4>
        <h5 id="ServiceDeleteId" class="WrongText d-none"> </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
        <button data-id=" " id='serviceDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5">
           <h5 class="WrongText d-none" id="serviceEditeId"> </h5>
            <h5 id="ServiceEdite" class="WrongText m-4">Service Edite </h5>
           <div id="EditeForm" class="d-none">
               <input type="text" id="serviceName" class="form-control mb-4" placeholder="Service Name">
               <input type="text" id="serveiceDescription" class="form-control mb-4" placeholder="Service Description|">
               <input type="text" id="serviceImg" class="form-control mb-4" placeholder="Service image Link">
            </div>
            <center><img id="LoddingID" class="Lodding" src="{{asset('images/1.gif')}}"/> </center>
           <h3 id="WrongID" class="WrongText d-none"> Somthing want wrong </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button data-id=" " id='serviceEditeConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5">
          <h4  class="text-center m-4">Do you Want to Add </h4>
           <div id="AddForm">
               <input type="text" id="AddName" class="form-control mb-4" placeholder="Service Name">
               <input type="text" id="AddDescription" class="form-control mb-4" placeholder="Service Description|">
               <input type="text" id="AddImg" class="form-control mb-4" placeholder="Service image Link">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button data-id=" " id='AddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type='text/javascript'>
    function getServiceData() {
        axios.get('/getServiceData')
            .then(function (response) {
                var dataJSON=response.data;
                if(response.status==200){
                    $('#mainDiv').removeClass('d-none');
                    $('#loding').addClass('d-none');

                   // $('#DataTable').dataTable().destroy();
                    $('#service_table').empty();

                    $.each(dataJSON, function(i, item) {
                        $('<tr>').html(
                            "<td>" + dataJSON[i].service_img + "</td>"+
                            "<td>" + dataJSON[i].service_name + "</td>" +
                            "<td>" + dataJSON[i].service_des + "</td>" +
                            "<td> <a class='ServiceEditeBtn'data-id="+ dataJSON[i].id+" ><i class='fas fa-edit'></i></a> </td>"+
                            "<td> <a class='serviceDeletBtn' data-id="+ dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                        ).appendTo('#service_table');

                    });

                    //Delete Modal/////////////

                    $('.serviceDeletBtn').click(function () {
                        var id = $(this).data('id');
                        //ServiceDelet(id);
                        //$('#serviceDeleteConfirmBtn').attr('data-id',id);
                        $('#ServiceDeleteId').html(id);
                        $('#deleteData').modal('show');
                    });

                    // Edite Modal ///////////////

                    $('.ServiceEditeBtn').click(function () {
                        var id= $(this).data('id');
                        ServiceDetails(id);
                        $('#serviceEditeId').html(id);
                        $('#EditModal').modal('show');
                    });
                        //Data Table///

                    $('#DataTable').dataTable({"order": false});
                    $('.dataTables_length').addClass('bs-select');
                }
                else {
                    $('#Wrong').removeClass('d-none');
                    $('#loding').addClass('d-none');
                }
            }).catch(function(error) {
            $('#Wrong').removeClass('d-none');
            $('#loding').addClass('d-none');
        });

    }//End get service function//

    //Service Delete confirm Button///

    $('#serviceDeleteConfirmBtn').click(function () {
        var id = $(this).data('id');
        var id = $('#ServiceDeleteId').html();
        ServiceDelet(id);
    })

//Service Delete fucntion

    function  ServiceDelet(DeleteID) {
        axios.post('/ServiceDelete',{
            id:DeleteID
        })
            .then(function (response) {
                if(response.status == 200){
                    if(response.data == 1){
                        $('#deleteData').modal('hide');
                        toastr.success('Delete success.');
                        getServiceData();

                    }else {
                        $('#deleteData').modal('hide');
                        toastr.error('Delete error.');
                        getServiceData();
                    }
                }else {
                    $('#deleteData').modal('hide');
                    toastr.error('Something Want Wrong Chacing you Data Connection.');
                }

            }).catch(function (error) {
            $('#deleteData').modal('hide');
            toastr.error('Something Want Wrong Chacing you Data Connection.');
        });
      }//End Delete function///

    //Service Details function///

    function ServiceDetails(DetailsID) {
        axios.post('/ServiceDetails',{id:DetailsID}).then(function (response) {
            if(response.status==200){
                var dataJSON=response.data;
                $('#EditeForm').removeClass('d-none');
                $('#LoddingID').addClass('d-none');
                $('#serviceName').val(dataJSON[0].service_name);
                $('#serveiceDescription').val(dataJSON[0].service_des);
                $('#serviceImg').val(dataJSON[0].service_img);
            }else {
                $('#WrongID').removeClass('d-none');
                $('#LoddingID').addClass('d-none');
            }
        }).catch(function (error) {
            $('#WrongID').removeClass('d-none');
            $('#LoddingID').addClass('d-none');
        });
    }//end service details//

    // Service Update confirm bUTTON ///////////

    $('#serviceEditeConfirmBtn').click(function () {
        var id = $('#serviceEditeId').html();
        var name =$('#serviceName').val();
        var des =$('#serveiceDescription').val();
        var img =$('#serviceImg').val();
        ServiceUpdate(id,name,des,img)

    })

    ////service Update//////////////

    function ServiceUpdate(serviceId,serviceName,serviceDes,serviceImg) {
        if(serviceName.length==0) {
            toastr.error('Emty Name.');
        }else if(serviceDes.length==0){
                toastr.error('Emty Description.');
            }else if(serviceImg.length==0){
                toastr.error('Emty image.');
            }else {
            axios.post('ServiceUpdate',{
                id:serviceId,
                name:serviceName,
                des:serviceDes,
                img:serviceImg

            }).then(function (response) {
                if(response.status == 200 ){
                    if(response.data == 1){
                        $('#EditModal').modal('hide');
                        toastr.success('update success.');
                        getServiceData()
                    }else {
                        $('#EditModal').modal('hide');
                        toastr.error('Somthing Want Wrong.');
                        getServiceData()
                    }
                }else {
                    $('#EditModal').modal('hide');
                    toastr.error('Somthing Want Wrong.');
                }

            }).catch(function (error) {
                $('#EditModal').modal('hide');
                toastr.error('Somthing Want Wrong Chaking internet connection.');
            });
        }
     }//End service Update function///

    //AddButton ///////////////////

    $('#AddButton').click(function () {
        $('#AddModal').modal('show');
    });

    $('#AddConfirmBtn').click(function () {
        var name =$('#AddName').val();
        var des =$('#AddDescription').val();
        var img =$('#AddImg').val();
        Add(name,des,img)
    });
    function Add(serviceName,serviceDes,serviceImg) {
        if(serviceName.length==0) {
            toastr.error('Emty Name.');
        }else if(serviceDes.length==0){
            toastr.error('Emty Description.');
        }else if(serviceImg.length==0){
            toastr.error('Emty image.');
        }else {
            axios.post('/ServiceAdd',{
                name:serviceName,
                des:serviceDes,
                img:serviceImg

            }).then(function (response) {
                if(response.status == 200 ){
                    if(response.data == 1){
                        $('#AddModal').modal('hide');
                        toastr.success('update success.');
                        getServiceData()
                    }else {
                        $('#AddModal').modal('hide');
                        toastr.error('Somthing Want Wrong.');
                        getServiceData()
                    }
                }else {
                    $('#AddModal').modal('hide');
                    toastr.error('Somthing Want Wrong.');
                }

            }).catch(function (error) {
                $('#AddModal').modal('hide');
                toastr.error('Somthing Want Wrong Chaking internet connection.');
            });
        }
    }

     getServiceData();
</script>
@endsection
