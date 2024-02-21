@extends('layouts.master')
@section('title', 'تعديل مستخدم')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">تعديل مستخدم</h4>
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                
                <!-- Add more fields for additional user information if needed -->
                
                <button type="submit" class="btn btn-primary btn-fw">حفظ التغييرات</button>
            </form>
        </div>
    </div>
</div>
@endsection
