@extends('layouts.admin.app')

@section('content')
  <h2>التصنيفات</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h4 class="fw-bold">إضافة تصنيف</h4>
          <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">الإسم (AR): </label>
              <input type="text" name="name_ar" class="form-control border-2 form-control-lg" />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (FR): </label>
              <input type="text" name="name_fr" class="form-control border-2 form-control-lg" />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (EN): </label>
              <input type="text" name="name_en" class="form-control border-2 form-control-lg" />
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-lg w-100 btn-dark">حفظ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h4 class="fw-bold">التصنيفات</h4>
          <table class="table-one">
            <thead>
              <tr>
                <th>#</th>
                <th>الإسم (AR)</th>
                <th>الإسم (EN)</th>
                <th>الإسم (FR)</th>
                <th>خيارات</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $category)
                <tr id="tr{{ $category->id }}">
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name_ar }}</td>
                  <td>{{ $category->name_en }}</td>
                  <td>{{ $category->name_fr }}</td>
                  <td>
                    <button class="btn btn-xs btn-success" data-bs-target="#editModal" data-bs-toggle="modal" data-category="{{ $category }}">
                      <ion-icon name="create-outline"></ion-icon>
                    </button>
                    <button class="btn btn-xs btn-danger" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="$('#id-for-destroy').val('{{ $category->id }}');">
                      <ion-icon name="trash-outline"></ion-icon>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" align="center">لا توجد بيانات.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- START edit modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">تعديل التصنيف</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.category.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">الإسم (AR): </label>
              <input type="text" name="name_ar" class="form-control border-2 form-control-lg" id="e-name_ar" />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (FR): </label>
              <input type="text" name="name_fr" class="form-control border-2 form-control-lg" id="e-name_fr" />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (EN): </label>
              <input type="text" name="name_en" class="form-control border-2 form-control-lg" id="e-name_en" />
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" value="" id="e-id" />
            <button type="submit" class="btn btn-dark w-100 btn-lg" data-bs-dismiss="modal">حفظ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END edit modal -->

  <!-- START delete modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">هل حقا تريد حذف التصنيف؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="id-for-destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroyCategory();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END delete modal -->
@endsection

@section('scripts')
  <script type="text/javascript">
    function destroyCategory() {
      let id = $('#id-for-destroy').val();
      $.post('{{ route('admin.category.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).remove();
      }, 'json');
    }

    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var category = button.data('category');
      
      var modal = $(this);
      modal.find('#e-name_ar').val(category.name_ar);
      modal.find('#e-name_en').val(category.name_en);
      modal.find('#e-name_fr').val(category.name_fr);
      modal.find('#e-id').val(category.id);
    });
  </script>
@endsection