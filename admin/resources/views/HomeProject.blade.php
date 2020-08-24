@extends('Layout.app')
@section('content')

    <div id="mainDiv"  class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="AddShowModal" class="btn-sm btn btn-danger">AddNew</button>
                <table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Project Name</th>
                        <th class="th-sm">Project Description</th>
                        <th class="th-sm">Project Image</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="ProjecttTable">
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="loding" class="container text-center">
        <div class="row tex-center">
            <div class="col-md-12 p-5">
                <img class="Lodding" src="{{asset('images/1.gif')}}"/>
            </div>
        </div>
    </div>


    <div id="Wrong" class="container text-center d-none">
        <div class="row">
            <div class="col-md-12 p-5 tex-center">
                <h3> Somthing want wrong </h3>
            </div>
        </div>
    </div>


    <div class="modal fade" id="DeleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center m-5">Do you Want to Delete </h4>
                    <h4 id="Deletid"class="text-center m-5"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button data-id=" " id='deletesend' type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ProjectDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <h5 class="WrongText" id="ProjectEditeId"> </h5>
                    <div id="EditeForm" class="-none">
                        <input type="text" id="ProjectName" class="form-control mb-4" placeholder="project Name">
                        <input type="text" id="ProjectDescription" class="form-control mb-4" placeholder="project Description|">
                        <input type="text" id="ProjectImg" class="form-control mb-4" placeholder="project image Link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
                    <button data-id=" " id='ProjectEditeConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ProjectAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <h5 class="WrongText" id="ProjectAddId"> </h5>
                    <div id="EditeForm" class="-none">
                        <input type="text" id="ProjectAddName" class="form-control mb-4" placeholder="project Name">
                        <input type="text" id="ProjectAddDescription" class="form-control mb-4" placeholder="project Description|">
                        <input type="text" id="ProjectAddImg" class="form-control mb-4" placeholder="project image Link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
                    <button data-id=" " id='ProjectAddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script type="text/javascript">

        //Project function////

        function GetProject(){
            axios.get('/GetProject').then(function (response) {
                var dataJSON = response.data;
                if(response.status==200){
                    $('#mainDiv').removeClass('d-none');
                    $('#loding').addClass('d-none');
                    // $('#DataTable').dataTable().destroy();
                    $('#ProjecttTable').empty();
                    $.each(dataJSON,function (i,item) {
                        $('<tr>').html(
                            "<td>"+dataJSON[i].project_name+ "</td>"+
                            "<td>"+dataJSON[i].project_description  + "</td>"+
                            "<td>"+dataJSON[i].project_img + "</td>"+
                            "<td><a class='EditeBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-edit'></i></a></td>"+
                            "<td><a class='ProjectDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a> </td>"
                        ).appendTo('#ProjecttTable');
                    });
                    $('.ProjectDeleteBtn').click(function () {
                        var id = $(this).data('id');
                        $('#Deletid').html(id);
                        $('#DeleteModel').modal('show');
                    });

                    //project Edite//

                    $('.EditeBtn').click(function () {
                        var id = $(this).data('id');
                        DetailsProject(id);
                        $('#ProjectEditeId').html(id);
                        $('#ProjectDetailsModal').modal('show');
                    });
                    $('#DataTable').dataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');
                }else {
                    $('#loding').addClass('d-none');
                    $('#Wrong').removeClass('d-none');
                }
            }).catch(function (error) {
                $('#loding').addClass('d-none');
                $('#Wrong').removeClass('d-none');
            })

        }//end GetProject function////

        $('#deletesend').click(function () {
            var id = $(this).data('id');
            var id =$('#Deletid').html();
            projectdelete(id);

        });

        function projectdelete(deleteid) {
            axios.post('/projectDelete',{id:deleteid}).then(function (response) {
                if(response.status==200){
                    if(response.data==1){
                        $('#DeleteModel').modal('hide');
                        toastr.success('Delete Success');
                        GetProject();

                    }else {
                        $('#DeleteModel').modal('hide');
                        toastr.error('Delete Error');
                        GetProject();
                    }
                }else {
                    $('#DeleteModel').modal('hide');
                    toastr.error('Chaking internet connection');
                }

            }).catch(function (error) {
                $('#DeleteModel').modal('hide');
                toastr.error('Sumething Want worng');
            })
        }

        // Project Edite function//

        function DetailsProject(Details) {
            axios.post('/ProjectDetails', {id: Details}).then(function (response) {
                if(response.status==200){
                    var dataJSON = response.data;
                    $('#ProjectName').val(dataJSON[0].project_name);
                    $('#ProjectDescription').val(dataJSON[0].project_description);
                    $('#ProjectImg').val(dataJSON[0].project_img);
                }else {
                    alert('chacking error');
                }
            }).catch(function (error) {
                alert('network  error');
            })
        }//end project function//

        //Edite confirm button;///

        $('#ProjectEditeConfirmBtn').click(function () {
            var id =  $('#ProjectEditeId').html();
            var name = $('#ProjectName').val();
            var des = $('#ProjectDescription').val();
            var img = $('#ProjectImg').val();
            EditeProject(id,name,des,img);

        });

        //Edite function///]

        function EditeProject(EditeId,Editename,EditeDes,EditeImg) {
            axios.post('/ProjectEdite',{
                id:EditeId,
                name:Editename,
                desc:EditeDes,
                img:EditeImg,
            }).then(function (response) {
                if(response.status==200){
                    if(response.data==true){
                        $('#ProjectDetailsModal').modal('hide');
                        toastr.success('Edite success');
                        GetProject();
                    }else {
                        $('#ProjectDetailsModal').modal('hide');
                        toastr.error('Edite Error');
                        GetProject();
                    }
                }else {
                    $('#ProjectDetailsModal').modal('hide');
                    toastr.error('Network Error');
                }

            }).catch(function (error) {
                alert('dokkito');
            });

        }//End Edite function///
        //Add show modal//
        $('#AddShowModal').click(function () {
            $('#ProjectAddModal').modal('show');
        });

        // Add confirm button//

        $('#ProjectAddConfirmBtn').click(function () {
            var name = $('#ProjectAddName').val();
            var des = $('#ProjectAddDescription').val();
            var img = $('#ProjectAddImg').val();
            AddNew(name, des, img);
        })

        // Add new function//

        function AddNew(projectname,projectdesc,projectimg) {
            axios.post('/ProjectAdd',{
                name:projectname,
                desc:projectdesc,
                img:projectimg,
            }).then(function (response) {
                if(response.status==200){
                    if(response.data==true){
                        $('#ProjectAddModal').modal('hide');
                        toastr.success('Add success');
                        GetProject();
                    }else {
                        $('#ProjectAddModal').modal('hide');
                        toastr.error('Add Error');
                        GetProject();
                    }
                }else {
                    $('#ProjectAddModal').modal('hide');
                    toastr.error('Network Error');
                }
            }).catch(function (error) {
                $('#ProjectAddModal').modal('hide');
                toastr.error('Network chaking finde Error');
            });
        }

        GetProject();
    </script>
@endsection
