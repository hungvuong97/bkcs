@extends('page_admin.layout.index')
@section('content')
 <div class='content-wrapper'>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 class="page-header">Phân quyền thiết bị cho sysAmdin
                            
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                       <div class="col-lg-4" align="cneter">
                           <label>Người quản lý</label>
                           <select class="form-control" name="fullname" id="fullname">
                                
                                <option >{{$user}}</option>  
                            
                           </select>
                   
                        </div>
                        <thead>
                            <tr align="center">

                                <th>Tên thiết bị</th>
                                <<th>Phiên bản</th>
                                <th>Địa chỉ IP</th>
                                <th>Nơi quản lý</th>
                                <th>Phân quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($device as $dev)
                            <tr class="odd gradeX" align="center">
                                <td>{{$dev->sysName}}</td>
                                <td>{{$dev->sysDescr}}</td>
                                <td>{{$dev->IP}}</td>
                                <td>{{$dev->sysContact}}</td>
                                <td><input type="checkbox" name="checkbox[]"></td>
                            </tr>
                            @endforeach
                            <div align="center">
                            <button  type="submit" class="btn btn-default">Thêm</button>
                        </div>
                        </tbody>
                       
                    </table>
        </div></div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("$fullname").change(function(){
                var 
            })
        });
    </script>
@e