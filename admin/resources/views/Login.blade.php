@extends('Layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 m-auto">
                <form  action="" class="loginForm">

                    <p class="h4 mb-4 mt-5">Log in</p>

                    <input type="text" value=" " name='name' required="" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="User Name">

                    <input type="password" name="password" required=""value="" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

                    <button class="btn btn-info btn-block my-4" name="submit" type="submit">Login in</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
       $('.loginForm').on('submit',function (event) {
            event.preventDefault();
            let fromData = $(this).serializeArray();
            let name =fromData[0]['value'];
           let password =fromData[1]['value'];
           let url = '/onLogin'
           axios.post(url,{
               name:name,
               pass:password
           }).then(function (response) {
               if(response.status==200 && response.data==1){
                    window.location.href="{{url('/')}}"
               }
           }).catch(function (error) {
               toastr.error('login falile');
           })
       })

    </script>
@endsection
