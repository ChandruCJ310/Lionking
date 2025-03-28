@extends('MasterAdmin.layout')

@section('content')


<div class="container">
<center><span class="fs-4 "  style="color: black;" >   Modify Member Rolls </span></center>


    <div class="d-flex justify-content-center">
        <div class="col-md-6">


        <select id="roleDropdown" class="form-control ">
            <option value="">Select Role</option>
            <option value="International officers">International Officers</option>
            <option value="DG Team">DG Team</option>
            <option value="District Governor">District Governor</option>
            <option value="Club Position">Club Position</option>
            <option value="Region member">Region Member</option>
            <option value="Past Governor">Past Governor</option>
            <option value="District Chairperson">District Chairperson</option>
        </select>
    </div>
      </div>


</div>



@endsection
