<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>Login Admin</title>
    <link rel="stylesheet" href="{{asset('storage/app/public/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('storage/app/public/assets/css/bootstrap.min.css')}}">
    
</head>
<body>
    <div class="container p-3">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3 class="text-center">Admin Login</h3>
                <form id="login" name="login">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" autocomplete="off">
                      <label id="error-email" class="error-message"></label>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="**********" autocomplete="off">
                      <label id="error-password" class="error-message"></label>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </div>
                  </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="{{asset('storage/app/public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('storage/app/public/assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('storage/app/public/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('storage/app/public/assets/js/additional-methods.min.js')}}"></script>
</body>
<script type="text/javascript">
// start Validation For Login Form
$("#login").validate({
    rules: {
        email:{ 
            required:true,
            email: true
        },
        password:"required"
    },
    messages: {
        email:{
            required:'This field is required',
            email:'Enter Valid email'
        },
        password:{
            required:'This field is required'
        }
    }
});
// End Validation For login form

// Start Login
$('body').on('click','#login',function(e){
    e.preventDefault();
    if($("#login").valid()){
        const form_data =new FormData(this);
        $.ajax({
            url:'{{ route("admin.login") }}',
            type:'POST',
            dataType:'JSON',
            data:form_data,
            contentType: false,
            cache:false,
            processData: false,
            success:function(data){
                if (data.response.ResponseStatus == 422 && data.response.ResponseCode == 0) {
                    $('#error-email').text(data.response.ResponseText);
                    setTimeout(() => {
                        $('#error-email').text('');
                    }, 1000);
                }else{
                    alert('login successfully.');
                }
            },
            error:function(errors){
                for (const error in errors.responseJSON.errors) {
                    $('#error-'+error).text(errors.responseJSON.errors[error]);
                }
            }
        });
    }
});

// End Login

</script> 
</html>