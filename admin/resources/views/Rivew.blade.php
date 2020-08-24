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
                    <tbody id='RivewTable'>

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
                    <h5 id="RivewDeleteId" class="WrongText d-none"> </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">NO</button>
                    <button data-id=" " id='RivewDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <h5 class="WrongText d-none" id="RivewEditeId"> </h5>
                    <h5 id="RivewEdite" class="WrongText m-4">Service Edite </h5>
                    <div id="EditeForm" class="d-none">
                        <input type="text" id="RivewName" class="form-control mb-4" placeholder="Rivew Name">
                        <input type="text" id="RivewDescription" class="form-control mb-4" placeholder="Rivew Description|">
                        <input type="text" id="RivewImg" class="form-control mb-4" placeholder="Rivew image Link">
                    </div>
                    <center><img id="LoddingID" class="Lodding" src="{{asset('images/1.gif')}}"/> </center>
                    <h3 id="WrongID" class="WrongText d-none"> Somthing want wrong </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
                    <button data-id=" " id='RivewEditeConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
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
                        <input type="text" id="AddName" class="form-control mb-4" placeholder="Rivew Name">
                        <input type="text" id="AddDescription" class="form-control mb-4" placeholder="Rivew Description|">
                        <input type="text" id="AddImg" class="form-control mb-4" placeholder="Rivew image Link">
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
    <script type="text/javascript">
        getRivewData();
    </script>
@endsection
