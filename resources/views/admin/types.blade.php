@extends('layouts.admin.app')

@section('content')
  <h2> الأنواع </h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h4 class="fw-bold">  إضافة نوع</h4>
          <form action="{{ route('admin.type.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">التصنيف: </label>
              <select name="catid" class="form-control form-control-lg border-2" required onchange="getSubcategories($(this).val(), '#add-subcategories');">
                <option value="">اختر التصنيف</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">التصنيف الفرعي: </label>
              <select name="subcatid" class="form-control form-control-lg border-2" id="add-subcategories" required>
                <option value="">اختر التصنيف الرئيسي أولا</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم </label>
              <input type="text" name="name" class="form-control border-2 form-control-lg" required />
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
          <h4 class="fw-bold">الانواع : </h4>
          <table class="table-one">
            <thead>
              <tr>
                <th>#</th>
                <th>النوع</th>
                <th>التصنيف الرئيسي</th>
                <th>التصنيف الفرعي</th>
                <th>خيارات</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($types as $type)
                  <tr id="tr{{ $type->id }}">
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ App\Models\Category::find($type->catid)->name_ar }}</td>
                    <td>{{ App\Models\Subcategory::find($type->subcatid)->name_ar }}</td>
                    <td>
                      <button class="btn btn-xs btn-success" data-bs-target="#editModal" data-bs-toggle="modal" data-type="{{ $type }}">
                        <ion-icon name="create-outline"></ion-icon>
                      </button>
                      <button class="btn btn-xs btn-danger" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="$('#id-for-destroy').val('{{ $type->id }}');">
                        <ion-icon name="trash-outline"></ion-icon>
                      </button>
                    </td>
                  </tr>
              @empty
                <tr>
                  <td colspan="6" align="center">لا توجد بيانات.</td>
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
          <h5 class="modal-title">تعديل التصنيف الفرعي</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.type.update') }}" method="POST">
          @csrf
          <div class="modal-body">
          @if($types === null)
          @else
          <div class="mb-3">
              <label class="form-label">التصنيف: </label>
              <select name="catid" class="form-control form-control-lg border-2" required onchange="getSubcategories($(this).val(), '#edit-subcategories');">
                <option value="">اختر التصنيف</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">التصنيف الفرعي: </label>
              <select name="subcatid" class="form-control form-control-lg border-2" id="edit-subcategories" required>
                <option value="">اختر التصنيف الرئيسي أولا</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم </label>
              <input type="text" name="name" class="form-control border-2 form-control-lg" required value="{{ $type->name ?? '' }}" />
            </div>
          </div>
          @endif
         
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
          <h5 class="modal-title">هل حقا تريد حذف التصنيف الفرعي؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="id-for-destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroytype();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END delete modal -->
@endsection

@section('scripts')
  <script type="text/javascript">
    function getSubcategories(id, select) {
      let url = "{{ route('admin.subcategory.for.select') }}";
      $.get(url+'/'+id, function(res) {
        $(select).html(res);
      });
    }
    function destroytype() {
      let id = $('#id-for-destroy').val();
      $.post('{{ route('admin.type.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).remove();
      }, 'json');
    }

    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var type = button.data('type');
      
      var modal = $(this);
      modal.find('#e-category_id').val(type.category_id);
      modal.find('#e-name_ar').val(type.name_ar);
      modal.find('#e-name_en').val(type.name_en);
      modal.find('#e-name_fr').val(type.name_fr);
      modal.find('#e-id').val(type.id);
    });
  </script>
@endsection