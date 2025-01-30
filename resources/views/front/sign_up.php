<!DOCTYPE html>  
<html lang="en">  
<head>
@if(any_errors())
<div class="alert alert-danger" style="position: fixed;
            top: 0;
            left: 40%;
            padding: 5px; 
            background-color: #f8d7da; color: #721c24;
            border: 3px solid #f5c6cb; border-radius: 4px;">
    <ol>
            @foreach(all_errors() as $error) 
                    <li><?php echo $error ?></li> 
            @endforeach  
    </ol>

</div>
@endif  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Registration Form</title>  
    <link rel="stylesheet" href="styles.css">  
</head>  


<body>  
    <div class="container">  
        <h2>Register Here</h2>  
        <form action="{{url('submit_registration')}}" method="post">
            <input type="hidden" name="_method" value="post" />  
            <label for="name"><b> Name</b></label>  
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required  
            class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }} " />  
  
            <label for="email"><b>Email</b></label>  
            <input type="email" id="email" name="email" placeholder="Enter Email" required>  
  
            <label for="psw"><b>Password</b></label>  
            <input type="password" id="psw" name="password" placeholder="Enter Password" required>  
  
            <!-- <label for="psw-repeat"><b>Repeat Password</b></label>  
            <input type="password" id="psw-repeat" name="psw-repeat" placeholder="Repeat Password" required>   -->
  
            <label for="mobile"><b>Contact</b></label>  
            <input type="text" id="mobile" name="mobile" maxlength="11" placeholder="Enter Contact Number" required>  
 
  
            <button type="submit" class="btn btn-success">{{trans('main.register')}}</button>  
        </form>  
    </div>
    
    <style>
    body {  
    font-family: Arial, sans-serif;  
    background-color: #f3f3f3;  
    margin: 0;  
    padding: 0;  
    display: flex;  
    justify-content: center;  
    align-items: center;  
    height: 100vh;  
}  
  
.container {  
    background-color: #fff;  
    border-radius: 15px;  
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);  
    padding: 20px;  
    width: 300px;  
}  
  
.container h2 {  
    color: #4caf50;  
    margin-bottom: 20px;  
}  
  
label {  
    display: block;  
    margin-bottom: 5px;  
    color: #555;  
    font-weight: bold;  
}  
  
input[type="text"],  
input[type="email"],  
input[type="password"],  
select {  
    width: 100%;  
    margin-bottom: 15px;  
    padding: 10px;  
    box-sizing: border-box;  
    border: 1px solid #ddd;  
    border-radius: 5px;  
}  
  
button[type="submit"] {  
    padding: 15px;  
    border-radius: 10px;  
    border: none;  
    background-color: #4caf50;  
    color: white;  
    cursor: pointer;  
    width: 100%;  
    font-size: 16px;  
}  
</style>
</body>  
</html>  
@php
end_errors();
@endphp