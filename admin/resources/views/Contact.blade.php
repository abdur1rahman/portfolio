@extends('Layout.app')
@section('content')
    <div id="" class="container">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Phone</th>
                        <th class="th-sm">Emaile</th>
                        <th class="th-sm">Message</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="ContactTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="Loding" class="container text-center">
        <div class="row">
            <div class="col-md-12 mt-5">
                <img src=" {{asset('images/1.gif')}} "/>
            </div>
        </div>
    </div>

    <div id="Wrong" class="container text-center d-none">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1>Somthing Want Wrong!!!</h1>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ContactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center m-5">Do you Want to Delete </h4>
                    <h4 id="contactId"class="text-center m-5"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button data-id=" " id='ContactDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        function Contact() {
            axios.get('/getcontact').then(function (response) {
                var dataJSON = response.data;

                if(response.status==200){
                    $('#Loding').addClass('d-none');
                    $('#mainDiv').removeClass('d-none')
                    // $('#DataTable').dataTable.destroy();
                    $('#ContactTable').empty();
                    $.each(dataJSON, function (i, item) {
                        $("<tr>").html(
                            "<td>"+dataJSON[i].name+"</td>"+
                            "<td>"+dataJSON[i].phone+"</td>"+
                            "<td>"+dataJSON[i].Emaile+"</td>"+
                            "<td>"+dataJSON[i].msg+"</td>"+
                            "<td> <a class='ContactDelete' data-id="+ dataJSON[i].id +"><i class='fas fa-trash-alt'></i></a> </td>"

                        ).appendTo('#ContactTable');


                    })
                    $('.ContactDelete').click(function () {
                        var id  = $(this).data('id');
                        $('#contactId').html(id);
                        $('#ContactDeleteModal').modal('show');

                    })
                    $('#DataTable').dataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');
                }else {
                    $('#Loding').addClass('d-none');
                    $('#Wrong').removeClass('d-none');
                }


            }).catch(function (error) {
                $('#Loding').addClass('d-none');
                $('#Wrong').removeClass('d-none');
            })
        }

        $('#ContactDeleteConfirmBtn').click(function () {
            var id  = $(this).data('id');
            var id = $('#contactId').html();
            ContectDelete(id);
        });
        function ContectDelete(DeleteId) {
            axios.post('/ContactgetDelete',{
                id:DeleteId,
            })
                .then(function (response) {
                    if(response.status==200){
                        if(response.data == true){
                            $('#ContactDeleteModal').modal('hide');
                            toastr.success('Delete Success');
                            Contact();
                        }else {
                            $('#ContactDeleteModal').modal('hide');
                            toastr.error('Delete Error');
                            Contact();
                        }
                    }else {
                        alert('ni');
                    }
                }).catch(function (error) {
                $('#ContactDeleteModal').modal('hide');
                toastr.error('Delete Error');
            })
        }

        Contact();
    </script>
@endsection
