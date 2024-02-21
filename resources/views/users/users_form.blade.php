
@extends('layouts.master')
@section('title')

اضافة مستخدم
@endsection




@section('content')
<script>
    function deleteUser(userId) {
        if (confirm('هل تريد حقًا حذف هذا المستخدم؟')) {
            // Send an AJAX request to delete the user
            // You can use JavaScript frameworks like Axios or jQuery for this
            // Example using Axios:
            axios.delete(`/admin/delete-user/${userId}`)
                .then(response => {
                    if (response.data.success) {
                        alert('تم حذف المستخدم بنجاح');
                        // Optionally, remove the row from the table
                        // This depends on your implementation
                        // Example: $(`#user-row-${userId}`).remove();
                    } else {
                        alert('فشل في حذف المستخدم');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('حدث خطأ أثناء محاولة حذف المستخدم');
                });
        }
    }
</script>
                
<div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                  <div class="card-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                  <form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div class="form-group">
    <label for="exampleInputName1">اسم</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required class="form-control" placeholder="اسم">
    </div>

    <div class="form-group">
    <label for="exampleInputEmail3">بريد الكتروني</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="بريد الكتروني">
    </div>

    <div class="form-group">
    <label for="exampleInputPassword4">كلمة مرور</label> 
        <input id="password" type="password" name="password" required class="form-control" placeholder="كلمة مرور">
    </div>

    <button type="submit" class="btn btn-inverse-info btn-fw">اضافة</button>
</form>
                  
                  </div>
                </div>
              </div>
                  
              
              

@endsection