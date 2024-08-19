@extends('layouts.admin.app')

@section('content')
  <h2>الأسعار</h2>
  <div class="card">
    <div class="card-header">
      <button class="btn btn-success" data-bs-target="#addModal" data-bs-toggle="modal">إضافة عرض</button>
    </div>
    <div class="card-body">
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>الإسم</th>
            <th>سعر الشهر</th>
            <th>سعر السنة</th>
            <th>عدد العناوين</th>
            <th>عدد المستخدمين</th>
            <th>إعدادات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($packages as $package)
            <tr id="tr{{ $package->id }}">
              <td>{{ $package->id }}</td>
              <td>{{ $package->name_ar }}</td>
              <td>{{ $package->monthly_price }} DZD</td>
              <td>{{ $package->yearly_price }} DZD</td>
              <td>{{ $package->max_locations }}</td>
              <td>{{ $package->max_users }}</td>
              <td>
                <button class="btn btn-success btn-xs" data-bs-target="#editModal" data-bs-toggle="modal" data-package="{{ $package }}">
                  <ion-icon name="create-outline"></ion-icon>
                </button>
                <button class="btn btn-danger btn-xs" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="$('#id-for-destroy').val('{{ $package->id }}');">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" align="center">لا توجد بيانات</td>
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
          <h5 class="modal-title">إضافة عرض</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.package.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">الإسم (AR):<span class="text-danger">*</span></label>
              <input type="text" name="name_ar" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (EN):<span class="text-danger">*</span></label>
              <input type="text" name="name_en" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (FR):<span class="text-danger">*</span></label>
              <input type="text" name="name_fr" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">السعر الشهري:<span class="text-danger">*</span> </label>
                  <input type="number" name="monthly_price" class="form-control form-control-lg border-2" required />
                </div>
                <div class="col-6">
                  <label class="form-label">السعر السنوي: </label>
                  <input type="number" name="yearly_price" class="form-control form-control-lg border-2" />
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">عدد المستخدمين: </label>
                  <input type="number" name="max_users" class="form-control form-control-lg border-2" />
                </div>
                <div class="col-6">
                  <label class="form-label">عدد العناوين: </label>
                  <input type="number" name="max_locations" class="form-control form-control-lg border-2" />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-lg btn-dark w-100">حفظ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END add modal -->

  <!-- START edit modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">تعديل عرض</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.package.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">الإسم (AR):<span class="text-danger">*</span></label>
              <input type="text" name="name_ar" class="form-control form-control-lg border-2" id="e-name_ar" required />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (EN):<span class="text-danger">*</span></label>
              <input type="text" name="name_en" class="form-control form-control-lg border-2" id="e-name_en"  required />
            </div>
            <div class="mb-3">
              <label class="form-label">الإسم (FR):<span class="text-danger">*</span></label>
              <input type="text" name="name_fr" class="form-control form-control-lg border-2" id="e-name_fr"  required />
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">السعر الشهري:<span class="text-danger">*</span> </label>
                  <input type="number" name="monthly_price" class="form-control form-control-lg border-2" id="e-monthly_price"  required />
                </div>
                <div class="col-6">
                  <label class="form-label">السعر السنوي: </label>
                  <input type="number" name="yearly_price" class="form-control form-control-lg border-2" id="e-yearly_price"  />
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <label class="form-label">عدد المستخدمين: </label>
                  <input type="number" name="max_users" class="form-control form-control-lg border-2" id="e-max_users"  />
                </div>
                <div class="col-6">
                  <label class="form-label">عدد العناوين: </label>
                  <input type="number" name="max_locations" class="form-control form-control-lg border-2" id="e-max_locations"  />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="e-id" />
            <button type="submit" class="btn btn-lg btn-dark w-100">حفظ</button>
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
          <h5 class="modal-title">هل حقا تريد حذف العرض؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="id-for-destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroyPackage();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END delete modal -->
@endsection

@section('scripts')
  <script type="text/javascript">
    function destroyPackage() {
      let id = $('#id-for-destroy').val();
      $.post('{{ route('admin.package.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).remove();
      }, 'json');
    }

    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var package = button.data('package');
      
      var modal = $(this);
      modal.find('#e-name_ar').val(package.name_ar);
      modal.find('#e-name_en').val(package.name_en);
      modal.find('#e-name_fr').val(package.name_fr);
      modal.find('#e-monthly_price').val(package.monthly_price);
      modal.find('#e-yearly_price').val(package.yearly_price);
      modal.find('#e-max_users').val(package.max_users);
      modal.find('#e-max_locations').val(package.max_locations);
      modal.find('#e-id').val(package.id);
    });
  </script>
@endsection