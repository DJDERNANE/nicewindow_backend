@extends('layouts.admin.app')

@section('content')
  <h2>البروفيلات</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if(session()->has('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div>
  @endif
  @if(session()->has('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h4 class="fw-bold">البروفيلات</h4>
        </div>
        <div class="col-6 text-end">
          <button class="btn btn-success" data-bs-target="#addModal" data-bs-toggle="modal">+ إضافة بروفايل</button>
        </div>
      </div>
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>الأيقونة</th>
            <th>التصنيف</th>
            <th>التصنيف الفرعي</th>
            <th>Ref</th>
            <th>الإسم</th>
            <th>الطول</th>
            <th>الوزن</th>
            <th>سعر المتر</th>
            <th>سعر الإطار</th>
            <th>خيارات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($profiles as $profile)
            <tr id="tr{{ $profile->id }}">
              <td>{{ $profile->id }}</td>
              <td><img src="{{   $profile->icon }}" width="25px" height="25px" /></td>

              <td>{{ $profile->category->name_ar }}</td>
              <td>{{ $profile->subcategory->name_ar }}</td>
              
              <td>{{ $profile->ref }}</td>
              <td>{{ $profile->name }}</td>
              <td>{{ $profile->height }}</td>
              <td>{{ $profile->weight }}</td>
              <td>{{ $profile->price_m }}</td>
              <td>{{ $profile->price_bar }}</td>
              <td>
                <button class="btn btn-xs btn-success" data-bs-target="#editModal" data-bs-toggle="modal" data-profile="{{ $profile }}">
                  <ion-icon name="create-outline"></ion-icon>
                </button>
                <button class="btn btn-xs btn-danger" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="$('#id-for-destroy').val('{{ $profile->id }}');">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="11" align="center">لا توجد بيانات</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- START add modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">إضافة بروفايل</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">التصنيف: </label>
              <select name="category_id" class="form-control form-control-lg border-2" required onchange="getSubcategories($(this).val(), '#add-subcategories');">
                <option value="">اختر التصنيف</option>
                @foreach (App\Models\Category::all() as $category)
                  <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                @endforeach
              </select>
            </div>
            
            <div class="mb-3">
              <label class="form-label">التصنيف الفرعي: </label>
              <select name="subcategory_id" class="form-control form-control-lg border-2" id="add-subcategories" required onchange="getTypes($(this).val(), '#add-types');">
                <option value="">اختر التصنيف الرئيسي أولا</option>
              </select>
            </div>
           
            <div class="mb-3">
              <label class="form-label">الأيقونة: </label>
              <input type="file" name="icon" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Ref: </label>
              <input type="text" name="ref" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم: </label>
              <input type="text" name="name" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">الوزن (Kg/Ml): </label>
              <input type="text" name="weight" class="form-control form-control-lg border-2" />
            </div>
            <div class="mb-3">
              <label class="form-label">الطول (mm): </label>
              <input type="text" name="height" class="form-control form-control-lg border-2" />
            </div>
            <div class="mb-3">
              <label class="form-label">السعر (m): </label>
              <input type="text" name="price_m" class="form-control form-control-lg border-2" />
            </div>
            <div class="mb-3">
              <label class="form-label">السعر (Bar): </label>
              <input type="text" name="price_bar" class="form-control form-control-lg border-2" />
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-dark w-100 btn-lg">حفظ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END add modal -->

  <!-- START edit modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">تعديل البروفايل</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.profile.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">التصنيف: </label>
              <select name="category_id" class="form-control form-control-lg border-2" required id="e-category_id" onchange="getSubcategories($(this).val(), '#e-subcategories');">
                <option value="">اختر التصنيف</option>
                @foreach (App\Models\Category::all() as $category)
                  <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">التصنيف الفرعي: </label>
              <select name="subcategory_id" class="form-control form-control-lg border-2" id="e-subcategories" required>
                @foreach (App\Models\Subcategory::all() as $subcategory)
                  <option value="{{ $subcategory->id }}">{{ $subcategory->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">الأيقونة: </label>
              <input type="file" name="icon" class="form-control form-control-lg border-2" />
            </div>
            <div class="mb-3">
              <label class="form-label">Ref: </label>
              <input type="text" name="ref" class="form-control form-control-lg border-2" required id="e-ref" />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم: </label>
              <input type="text" name="name" class="form-control form-control-lg border-2" required id="e-name" />
            </div>
            <div class="mb-3">
              <label class="form-label">الوزن (Kg/Ml): </label>
              <input type="text" name="weight" class="form-control form-control-lg border-2" id="e-weight" />
            </div>
            <div class="mb-3">
              <label class="form-label">الطول (mm): </label>
              <input type="text" name="height" class="form-control form-control-lg border-2" id="e-height" />
            </div>
            <div class="mb-3">
              <label class="form-label">السعر (m): </label>
              <input type="text" name="price_m" class="form-control form-control-lg border-2" id="e-price_m" />
            </div>
            <div class="mb-3">
              <label class="form-label">السعر (Bar): </label>
              <input type="text" name="price_bar" class="form-control form-control-lg border-2" id="e-price_bar" />
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" value="" id="e-id" />
            <button type="submit" class="btn btn-dark w-100 btn-lg">حفظ</button>
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
          <h5 class="modal-title">هل حقا تريد حذف البروفايل؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="id-for-destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroyProfile();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END delete modal -->
@endsection

@section('scripts')
  <script type="text/javascript">
    // function getTypes(id, select) {
      
    //   let url = "{{ route('admin.type.for.select') }}";
    //   $.get(url+'/'+id, function(res) {
    //     //$(select).html(res);
    //     console.log('ok')
    //   });
    // }
    function getSubcategories(id, select) {
      let url = "{{ route('admin.subcategory.for.select') }}";
      $.get(url+'/'+id, function(res) {
        
        $(select).html(res);
      });
    }

    function destroyProfile() {
      let id = $('#id-for-destroy').val();
      $.post('{{ route('admin.profile.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).remove();
      }, 'json');
    }

    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var profile = button.data('profile');
      
      var modal = $(this);
      modal.find('#e-category_id').val(profile.category_id);
      modal.find('#e-subcategories').val(profile.subcategory_id);
      modal.find('#e-ref').val(profile.ref);
      modal.find('#e-name').val(profile.name);
      modal.find('#e-weight').val(profile.weight);
      modal.find('#e-height').val(profile.height);
      modal.find('#e-price_m').val(profile.price_m);
      modal.find('#e-price_bar').val(profile.price_bar);
      modal.find('#e-id').val(profile.id);
    });
  </script>
@endsection