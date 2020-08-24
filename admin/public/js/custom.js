function getRivewData() {
    axios.get('/getRivewData')
        .then(function (response) {
            var dataJSON=response.data;
            if(response.status==200){
                $('#mainDiv').removeClass('d-none');
                $('#loding').addClass('d-none');

                // $('#DataTable').dataTable().destroy();
                $('#RivewTable').empty();

                $.each(dataJSON, function(i, item) {
                    $('<tr>').html(
                        "<td>" + dataJSON[i].images + "</td>"+
                        "<td>" + dataJSON[i].RivewName + "</td>" +
                        "<td>" + dataJSON[i].description + "</td>" +
                        "<td> <a class='RivewEditeBtn'data-id="+ dataJSON[i].id+" ><i class='fas fa-edit'></i></a> </td>"+
                        "<td> <a class='RivewDeleteBtn' data-id="+ dataJSON[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#RivewTable');

                });

                //Delete Modal/////////////

                $('.RivewDeleteBtn').click(function () {
                    var id = $(this).data('id');
                    //ServiceDelet(id);
                    //$('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $('#RivewDeleteId').html(id);
                    $('#deleteData').modal('show');
                });

                // Edite Modal ///////////////

                $('.RivewEditeBtn').click(function () {
                    var id= $(this).data('id');
                    RivewDetails(id);
                    $('#RivewEditeId').html(id);
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

$('#RivewDeleteConfirmBtn').click(function () {
    var id = $(this).data('id');
    var id = $('#RivewDeleteId').html();
    RivewDelete(id);
})

//Service Delete fucntion

function  RivewDelete(DeleteID) {
    axios.post('/RivewDelete',{
        id:DeleteID
    })
        .then(function (response) {
            if(response.status == 200){
                if(response.data == 1){
                    $('#deleteData').modal('hide');
                    toastr.success('Delete success.');
                    getRivewData();

                }else {
                    $('#deleteData').modal('hide');
                    toastr.error('Delete error.');
                    getRivewData();
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

function RivewDetails(DetailsID) {
    axios.post('/RivewDetails',{id:DetailsID}).then(function (response) {
        if(response.status==200){
            var dataJSON=response.data;
            $('#EditeForm').removeClass('d-none');
            $('#LoddingID').addClass('d-none');
            $('#RivewName').val(dataJSON[0].RivewName);
            $('#RivewDescription').val(dataJSON[0].description);
            $('#RivewImg').val(dataJSON[0].images);
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

$('#RivewEditeConfirmBtn').click(function () {
    var id = $('#RivewEditeId').html();
    var name =$('#RivewName').val();
    var des =$('#RivewDescription').val();
    var img =$('#RivewImg').val();
    RivewUpdate(id,name,des,img)

})

////service Update//////////////

function RivewUpdate(serviceId,serviceName,serviceDes,serviceImg) {
    if(serviceName.length==0) {
        toastr.error('Emty Name.');
    }else if(serviceDes.length==0){
        toastr.error('Emty Description.');
    }else if(serviceImg.length==0){
        toastr.error('Emty image.');
    }else {
        axios.post('RivewUpdate',{
            id:serviceId,
            name:serviceName,
            des:serviceDes,
            img:serviceImg

        }).then(function (response) {
            if(response.status == 200 ){
                if(response.data == 1){
                    $('#EditModal').modal('hide');
                    toastr.success('update success.');
                    getRivewData();
                }else {
                    $('#EditModal').modal('hide');
                    toastr.error('Somthing Want Wrong.');
                    getRivewData();
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
        axios.post('/RivewAdd',{
            name:serviceName,
            des:serviceDes,
            img:serviceImg

        }).then(function (response) {
            if(response.status == 200 ){
                if(response.data == 1){
                    $('#AddModal').modal('hide');
                    toastr.success('update success.');
                    getRivewData();
                }else {
                    $('#AddModal').modal('hide');
                    toastr.error('Somthing Want Wrong.');
                    getRivewData();
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
