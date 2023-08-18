@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tiêu chuẩn danh hiệu: <span>{{ $stylized->name_stylized }}</span></h1>
    <a href="{{ route('criterias.create', ['id-stylized' => $stylized->id]) }}" class="btn btn-dark"><i class="fa-solid fa-circle-plus"></i> Thêm tiêu chuẩn</a>
  </div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="font-size: 16px;">
      <li class="breadcrumb-item"><a href="{{ route('stylized.index') }}">Danh hiệu</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tiêu chuẩn</li>
      <!-- <li class="breadcrumb-item">Tiêu chí</li> -->
    </ol>
  </nav>
  <div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card mb-4">
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>STT</th>
                        <th>Tiêu chuẩn</th>
                        <th>Tiêu chí cần đạt</th>
                        <th class="text-center">Quản lý</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($ceriterias->count() > 0)
                        @foreach($ceriterias as $key => $value)
                          <tr class="text-center">
                            <td>{{ $key += 1 }}</td>
                            <td>{{ $value->name_criter }}</td>
                            <td>{{ $value->number }}</td>
                            <td class="text-center" width="350">
                              <!-- <a href="{{ route('criterias-detail.index', ['id-criteria' => $value->id]) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-list-check"></i> Quản lý</a> -->
                              <a href="{{ route('criterias-detail.index', ['id-criteria' => $value->id, 'id-stylized' => $id_stylized]) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-list-check"></i> Quản lý</a>
                              <a href="{{ route('criterias.edit', [$value->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i> Cập nhật</a>
                              <button type="submit" class="btn btn-sm btn-danger" onclick="deleteCriter({{ $value->id }})"><i class="fa-solid fa-trash-can"></i> Xóa</button>
                            </td>
                          </tr>
                        @endforeach
                      @else
                      <tr class="text-center">
                        <td colspan="5">Hiện tại chưa có tiêu chuẩn của danh hiệu</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
            </div>
            <div class="card-footer"></div>
        </div>
        {{ $ceriterias->appends(Request::all())->links() }}
    </div>
  </div>
</div>
@endsection
