@extends('Layout.app')
@section('content')
    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button id="AddButton" class="btn-sm btn btn-danger"><a data-id="+ dataJSON[i].id + ">AddNew</a></button>
                <table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">CourseName</th>
                        <th class="th-sm">CourseDescription</th>
                        <th class="th-sm">CourseFee</th>
                        <th class="th-sm">CourseEnroll</th>
                        <th class="th-sm">TotalClass</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="CourseTable">
                    <tr>

                    </tr>
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

    <div class="modal fade" id="CoursDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center m-5">Do you Want to Delete </h4>
                    <h4 id="DeleteId" class="text-center m-5"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button data-id=" " id='CourseDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CoursEditeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4  class="text-center m-4">Do you Want to Edite </h4>
                    <h4 id="CourseEditeId" class="text-center m-4 d-none"></h4>
                    <div id="CourseEditeForm" class="d-none">
                        <input type="text" id="CourseName" class="form-control mb-4" placeholder="Course Name">
                        <input type="text" id="CourseDescription" class="form-control mb-4" placeholder="Course Description">
                        <input type="text" id="CourseImg" class="form-control mb-4" placeholder="Course image Link">
                        <input type="text" id="CourseFee" class="form-control mb-4" placeholder="Course Fee">
                        <input type="text" id="CourseEnroll" class="form-control mb-4" placeholder="Course Enroll">
                        <input type="text" id="CourseTotlacls" class="form-control mb-4" placeholder="Course totla class">
                        <input type="text" id="CourseLink" class="form-control mb-4" placeholder="Course LInk">
                    </div>
                    <img id="CourseLoging" src=" {{asset('images/1.gif')}} "/>
                    <h5 id="SomethingWrong" class="text-center d-none">Somthing Want Wrong!!!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button data-id=" " id='CourseEditeConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CoursAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 id="CourseAddId" class="text-center m-4">Do you Want to Add </h4>
                    <div id="CourseAddForm">
                        <input type="text" id="AddName" class="form-control mb-4" placeholder="Course Name">
                        <input type="text" id="AddDescription" class="form-control mb-4" placeholder="Course Description">
                        <input type="text" id="AddImg" class="form-control mb-4" placeholder="Course image Link">
                        <input type="text" id="AddFee" class="form-control mb-4" placeholder="Course Fee">
                        <input type="text" id="AddEnroll" class="form-control mb-4" placeholder="Course Enroll">
                        <input type="text" id="AddTotlacls" class="form-control mb-4" placeholder="Course totla class">
                        <input type="text" id="AddLink" class="form-control mb-4" placeholder="Course LInk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button  id='CourseAddConfirmBtn' type="button" class="btn btn-sm btn-danger">AddNew</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type='text/javascript'>
        function GetCourse() {
            axios.get('/GetCourse')
                .then(function (response) {

                    var dataJSON = response.data;
                    if(response.status == 200){
                        $('#Loding').addClass('d-none');
                        $('#mainDiv').removeClass('d-none');
                        // $('#DataTable').dataTable().destroy();
                        $('#CourseTable').empty();
                        $.each(dataJSON, function (i, item) {
                            $("<tr>").html(
                                "<td>" +dataJSON[i].course_name + "</td>"+
                                "<td>" +dataJSON[i].course_des + "</td>"+
                                "<td>" +dataJSON[i].course_fee + "</td>"+
                                "<td>" +dataJSON[i].course_totalenroll + "</td>"+
                                "<td>" +dataJSON[i].course_totalclass + "</td>"+
                                "<td> <a class='EditeBtn' data-id="+ dataJSON[i].id +" ><i class='fas fa-edit'></i></a>"+
                                "<td> <a class='DeleteBtn' data-id="+ dataJSON[i].id +"><i class='fas fa-trash-alt'></i></a></td></td>"

                            ).appendTo('#CourseTable');
                        });
                        //CourseDeleteModal Show function//

                        $('.DeleteBtn').click(function () {
                            var id = $(this).data('id');
                            $('#DeleteId').html(id);
                            $('#CoursDeleteModal').modal('show');
                        });

                        //CourseEditeModalShow function///

                        $('.EditeBtn').click(function () {
                            var id= $(this).data('id');
                            $('#CourseEditeId').html(id);
                            CourseUpdateDetails(id);
                            $('#CoursEditeModal').modal('show');
                        });

                        //Data Table///

                        //$('#DataTable').dataTable({"order":false});
                        //$('.dataTables_length').addClass('bs-select');

                    }else {
                        $('#Loding').addClass('d-none');
                        $('#Wrong').removeClass('d-none');
                    }
                });
        }  //get function

        // Delete Confirm Button ///

        $('#CourseDeleteConfirmBtn').click(function () {
            var id = $(this).data('id');
            var id = $('#DeleteId').html();
            GetCourseDelete(id)
        });

        function GetCourseDelete(DeleteID) {
            axios.post('/Coursedelete',{
                id:DeleteID,
            })
                .then(function (response) {
                    if(response.data == true){
                        $('#CoursDeleteModal').modal('hide');
                        toastr.success('Delete Success');
                        GetCourse();
                    }else {
                        $('#CoursDeleteModal').modal('hide');
                        toastr.error('Delete Error');
                        GetCourse();
                    }

                }).catch(function (error) {
                $('#CoursDeleteModal').modal('hide');
                toastr.error('Cathc Error');
            });
        }//End Delete function////////

        //Course update Details function ///

        function CourseUpdateDetails(detailsID){
            axios.post('/CourseDetails',{
                id:detailsID,
            })
                .then(function (response) {
                    if(response.status==200){
                        $('#CourseEditeForm').removeClass('d-none');
                        $('#CourseLoging').addClass('d-none');

                        var jsonData = response.data;
                        $('#CourseName').val(jsonData[0].course_name);
                        $('#CourseDescription').val(jsonData[0].course_des);
                        $('#CourseFee').val(jsonData[0].course_fee);
                        $('#CourseEnroll').val(jsonData[0].course_totalenroll);
                        $('#CourseTotlacls').val(jsonData[0].course_totalclass);
                        $('#CourseLink').val(jsonData[0].course_link);
                        $('#CourseImg').val(jsonData[0].course_img);

                    }else {
                        $('#CourseLoging').addClass('d-none');
                        $('#SomethingWrong').removeClass('d-none');
                    }

                }).catch(function (error) {
                $('#CourseLoging').addClass('d-none');
                $('#SomethingWrong').removeClass('d-none');
            });
        }//end Details function///

        //Course update Confirme EditeButton function//

        $('#CourseEditeConfirmBtn').click(function () {
            var id= $('#CourseEditeId').html();
            var name= $('#CourseName').val();
            var des= $('#CourseDescription').val();
            var img= $('#CourseImg').val();
            var fee= $('#CourseFee').val();
            var emroll= $('#CourseEnroll').val();
            var totlaclas= $('#CourseTotlacls').val();
            var corselink= $('#CourseLink').val();
            CourseUpdate(id,name,des,img,fee,emroll,totlaclas,corselink);
        });

        //Course Update function ////////////

        function CourseUpdate(UpdateID,CourseName,CourseDescription,CourseImg,CourseFee,CourseEnroll,Totlacls,CourseLink) {

            axios.post('/CourseUpdate',{
                id:UpdateID,
                name:CourseName,
                des:CourseDescription,
                courseimg:CourseImg,
                fee:CourseFee,
                totalenroll:CourseEnroll,
                totalclass:Totlacls,
                courselink:CourseLink,
            })
                .then(function (response) {
                    var jsonData = response.data;
                    if(response.data==true){
                        $('#CoursEditeModal').modal('hide');
                        toastr.success('Edite Success');
                        GetCourse();



                    }else {
                        $('#CoursEditeModal').modal('hide');
                        toastr.error('Edite Error');
                        GetCourse();
                    }

                }).catch(function (error) {
                $('#CoursEditeModal').modal('hide');
                toastr.error('Edite Error');
            });

        }//Course Update function ///

        //Course Add Modal Show ////////

        $('#AddButton').click(function () {
            $('#CoursAddModal').modal('show');
        });

        //Course Add Confirme EditeButton function//

        $('#CourseAddConfirmBtn').click(function () {
            var name= $('#AddName').val();
            var des= $('#AddDescription').val();
            var img= $('#AddImg').val();
            var fee= $('#AddFee').val();
            var emroll= $('#AddEnroll').val();
            var totlaclas= $('#AddTotlacls').val();
            var corselink= $('#AddLink').val();
            CourseAdd(name,des,img,fee,emroll,totlaclas,corselink);
        });

        //AddNew Button show Modal function //////

        function CourseAdd(CourseName,CourseDescription,CourseImg,CourseFee,CourseEnroll,Totlacls,CourseLink) {

            axios.post('/CourseAdd',{
                name:CourseName,
                des:CourseDescription,
                courseimg:CourseImg,
                fee:CourseFee,
                totalenroll:CourseEnroll,
                totalclass:Totlacls,
                courselink:CourseLink,
            })
                .then(function (response) {
                    if(response.data==true){
                        $('#CoursAddModal').modal('hide');
                        toastr.success('Add Success');
                        GetCourse();
                    }else {
                        $('#CoursAddModal').modal('hide');
                        toastr.error('Add Error');
                        GetCourse();
                    }

                }).catch(function (error) {
                $('#CoursAddModal').modal('hide');
                toastr.error('Something Data Add Error');
            });

        }



        GetCourse()
    </script>
@endsection
