
@extends('layouts.master')
@section('title')

تعيين مستخدم
@endsection




@section('content')

                
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

<table class="table table-bordered">
                <thead>
                    <tr>
                        <th> مستخدم </th>
                        <th> email </th>
                    </tr>
                </thead>
                <tbody>
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            
        </tr>
</tbody>


            </table>
            <br/>

                  <form method="POST" action="{{ route('users.store.permission', $user->id) }}">
    @csrf

    <div class="form-group">
                                <table class="table table-bordered" style="text-align:center">
                                 
                                    <tr>
                                        <th></th>
                                        <th>غير مسموح</th>
                                        <th>مراجعة</th>
                                        <th>تعدييل</th>
                                    </tr>
                                    <tr>
                                        <td>مستخدمين</td>
                                        <td><input type="radio" class="form-check-input" name="users" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="users" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="users" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>موظفين</td>
                                        <td><input type="radio" class="form-check-input" name="employee" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="employee" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="employee" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>الوظائف</td>
                                        <td><input type="radio" class="form-check-input" name="type_employee" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="type_employee" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="type_employee" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>حالة الموظفين</td>
                                        <td><input type="radio" class="form-check-input" name="etat_employee" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="etat_employee" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="etat_employee" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>نيابات</td>
                                        <td><input type="radio" class="form-check-input" name="gare" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="gare" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="gare" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>حافلات</td>
                                        <td><input type="radio" class="form-check-input" name="bus" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="bus" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="bus" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>الخطوط</td>
                                        <td><input type="radio" class="form-check-input" name="ligne" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="ligne" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="ligne" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>المحطات</td>
                                        <td><input type="radio" class="form-check-input" name="station" value="0"></td>
                                        <td><input type="radio" class="form-check-input" name="station" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="station" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>الرحلات</td>
                                        <td><input type="radio" class="form-check-input" name="voyage" value="0"> </td>
                                        <td><input type="radio" class="form-check-input" name="voyage" value="1"> </td>
                                        <td><input type="radio" class="form-check-input" name="voyage" value="2"></td>
                                    </tr>
                                   
                                </table>
                            </div>

    <button type="submit" class="btn btn-inverse-info btn-fw">اضافة</button>
</form>
                  
                  </div>
                </div>
              </div>
                  
              
              

@endsection